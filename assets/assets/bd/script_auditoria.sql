CREATE EXTENSION hstore;
CREATE SCHEMA audit;
CREATE TABLE audit.auditoria_acceso (id_auditoria_acceso serial NOT NULL,id_sesion character varying(32) NOT NULL,login_usuario character(50) NOT NULL,ingreso timestamp(6) without time zone NOT NULL DEFAULT now(),ingresado boolean,salida timestamp(6) without time zone,expirado boolean,status character varying(15) NOT NULL,CONSTRAINT pkey_auditoria_acceso_id_auditoria_acceso PRIMARY KEY (id_auditoria_acceso));
CREATE TABLE audit.logged_actions (
  event_id bigserial NOT NULL, -- Unique identifier for each auditable event
  schema_name text NOT NULL, -- Database schema audited table for this event is in
  table_name text NOT NULL, -- Non-schema-qualified table name of table event occured in
  relid oid NOT NULL, -- Table OID. Changes with drop/create. Get with 'tablename'::regclass
  session_user_name text, -- Login / session user whose statement caused the audited event
  ci_usuario integer,
  nombre_usuario text,
  action_tstamp_tx timestamp with time zone NOT NULL, -- Transaction start timestamp for tx in which audited event occurred
  action_tstamp_stm timestamp with time zone NOT NULL, -- Statement start timestamp for tx in which audited event occurred
  action_tstamp_clk timestamp with time zone NOT NULL, -- Wall clock time at which audited event's trigger call occurred
  transaction_id bigint, -- Identifier of transaction that made the change. May wrap, but unique paired with action_tstamp_tx.
  application_name text, -- Application name set when this audit event occurred. Can be changed in-session by client.
  client_addr inet, -- IP address of client that issued query. Null for unix domain socket.
  client_port integer, -- Remote peer IP port address of client that issued query. Undefined for unix socket.
  client_query text, -- Top-level query that caused this auditable event. May be more than one statement.
  action text NOT NULL, -- Action type; I = insert, D = delete, U = update, T = truncate
  row_data hstore, -- Record value. Null for statement-level trigger. For INSERT this is the new tuple. For DELETE and UPDATE it is the old tuple.
  changed_fields hstore, -- New values of fields changed by UPDATE. Null except for row-level UPDATE events.
  statement_only boolean NOT NULL, -- 't' if audit event is from an FOR EACH STATEMENT trigger, 'f' for FOR EACH ROW
  CONSTRAINT logged_actions_pkey PRIMARY KEY (event_id),
  CONSTRAINT logged_actions_action_check CHECK (action = ANY (ARRAY['I'::text, 'D'::text, 'U'::text, 'T'::text]))
)
WITH (
	OIDS=FALSE
);
ALTER TABLE audit.logged_actions
OWNER TO postgres;
COMMENT ON TABLE audit.logged_actions
IS 'History of auditable actions on audited tables, from audit.if_modified_func()';
COMMENT ON COLUMN audit.logged_actions.event_id IS 'Unique identifier for each auditable event';
COMMENT ON COLUMN audit.logged_actions.schema_name IS 'Database schema audited table for this event is in';
COMMENT ON COLUMN audit.logged_actions.table_name IS 'Non-schema-qualified table name of table event occured in';
COMMENT ON COLUMN audit.logged_actions.relid IS 'Table OID. Changes with drop/create. Get with ''tablename''::regclass';
COMMENT ON COLUMN audit.logged_actions.session_user_name IS 'Login / session user whose statement caused the audited event';
COMMENT ON COLUMN audit.logged_actions.action_tstamp_tx IS 'Transaction start timestamp for tx in which audited event occurred';
COMMENT ON COLUMN audit.logged_actions.action_tstamp_stm IS 'Statement start timestamp for tx in which audited event occurred';
COMMENT ON COLUMN audit.logged_actions.action_tstamp_clk IS 'Wall clock time at which audited event''s trigger call occurred';
COMMENT ON COLUMN audit.logged_actions.transaction_id IS 'Identifier of transaction that made the change. May wrap, but unique paired with action_tstamp_tx.';
COMMENT ON COLUMN audit.logged_actions.application_name IS 'Application name set when this audit event occurred. Can be changed in-session by client.';
COMMENT ON COLUMN audit.logged_actions.client_addr IS 'IP address of client that issued query. Null for unix domain socket.';
COMMENT ON COLUMN audit.logged_actions.client_port IS 'Remote peer IP port address of client that issued query. Undefined for unix socket.';
COMMENT ON COLUMN audit.logged_actions.client_query IS 'Top-level query that caused this auditable event. May be more than one statement.';
COMMENT ON COLUMN audit.logged_actions.action IS 'Action type; I = insert, D = delete, U = update, T = truncate';
COMMENT ON COLUMN audit.logged_actions.row_data IS 'Record value. Null for statement-level trigger. For INSERT this is the new tuple. For DELETE and UPDATE it is the old tuple.';
COMMENT ON COLUMN audit.logged_actions.changed_fields IS 'New values of fields changed by UPDATE. Null except for row-level UPDATE events.';
COMMENT ON COLUMN audit.logged_actions.statement_only IS '''t'' if audit event is from an FOR EACH STATEMENT trigger, ''f'' for FOR EACH ROW';
CREATE INDEX logged_actions_action_idx ON audit.logged_actions USING btree
(action COLLATE pg_catalog."default");
CREATE INDEX logged_actions_action_tstamp_tx_stm_idx ON audit.logged_actions USING btree
(action_tstamp_stm);
CREATE INDEX logged_actions_relid_idx ON audit.logged_actions USING btree
(relid);
CREATE OR REPLACE FUNCTION audit.if_modified_func()
RETURNS trigger AS
$BODY$
DECLARE
audit_row audit.logged_actions;
include_values boolean;
log_diffs boolean;
h_old hstore;
h_new hstore;
excluded_cols text[] = ARRAY[]::text[];
BEGIN
IF TG_WHEN <> 'AFTER' THEN
RAISE EXCEPTION 'audit.if_modified_func() may only run as an AFTER trigger';
END IF;
audit_row = ROW(
        nextval('audit.logged_actions_event_id_seq'), -- event_id
        TG_TABLE_SCHEMA::text,                        -- schema_name
        TG_TABLE_NAME::text,                          -- table_name
        TG_RELID,                                     -- relation OID for much quicker searches
        current_setting('pni.user'),                  -- session_user_name
        current_setting('pni.ci_usuario'),	      -- ci del usuario logueado
        current_setting('pni.nombre_usuario'),	      -- nombre completo del usuario logueado
        current_timestamp,                            -- action_tstamp_tx
        statement_timestamp(),                        -- action_tstamp_stm
        clock_timestamp(),                            -- action_tstamp_clk
        txid_current(),                               -- transaction ID
        current_setting('application_name'),          -- client application
        current_setting('pni.ip'),                    -- client_addr
        inet_client_port(),                           -- client_port
        current_query(),                              -- top-level query or queries (if multistatement) from client
        substring(TG_OP,1,1),                         -- action
        NULL, 					      -- row_data 
        NULL,                                         -- changed_fields
        'f'                                           -- statement_only
        );

IF NOT TG_ARGV[0]::boolean IS DISTINCT FROM 'f'::boolean THEN
audit_row.client_query = NULL;
END IF;

IF TG_ARGV[1] IS NOT NULL THEN
excluded_cols = TG_ARGV[1]::text[];
END IF;

IF (TG_OP = 'UPDATE' AND TG_LEVEL = 'ROW') THEN
audit_row.row_data = hstore(OLD.*) - excluded_cols;
audit_row.changed_fields =  (hstore(NEW.*) - audit_row.row_data) - excluded_cols;
IF audit_row.changed_fields = hstore('') THEN
            -- All changed fields are ignored. Skip this update.
            RETURN NULL;
            END IF;
            ELSIF (TG_OP = 'DELETE' AND TG_LEVEL = 'ROW') THEN
            audit_row.row_data = hstore(OLD.*) - excluded_cols;
            ELSIF (TG_OP = 'INSERT' AND TG_LEVEL = 'ROW') THEN
            audit_row.row_data = hstore(NEW.*) - excluded_cols;
            ELSIF (TG_LEVEL = 'STATEMENT' AND TG_OP IN ('INSERT','UPDATE','DELETE','TRUNCATE')) THEN
            audit_row.statement_only = 't';
            ELSE
            RAISE EXCEPTION '[audit.if_modified_func] - Trigger func added as trigger for unhandled case: %, %',TG_OP, TG_LEVEL;
            RETURN NULL;
            END IF;
            if (TG_OP <> 'SET')  then
            INSERT INTO audit.logged_actions VALUES (audit_row.*);
            end if;
            RETURN NULL;
            END;
            $BODY$
            LANGUAGE plpgsql VOLATILE SECURITY DEFINER
            COST 100;
            ALTER FUNCTION audit.if_modified_func() SET search_path=pg_catalog, public;
            ALTER FUNCTION audit.if_modified_func()
            OWNER TO postgres;
            ;

            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.auditoria_accesoFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.correosFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.fuente_financieraFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.proyectoFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.areaFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.ciudadesFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.configuracionFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.empresaFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.especialidadFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.estado_civilFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.estado_propuestaFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.estadosFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.generoFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.lineas_investigacionFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.v_investigadoresFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.vinteres_investigacionFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.vinvestigacion_actualFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.lineas_presidencialesFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON audit.logged_actionsFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON audit.vrecienteFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.menusFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.modalidadFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.modo_investigacionFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.motoresFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.municipiosFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.parroquiasFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.participacionFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.participantesFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.personaFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.profesionesFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.representanteFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.sub_areaFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.tipo_institucionFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.tipo_proyectoFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.usuariosFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.zonasFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.renacFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.rolesFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON public.investigadoresFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;
            CREATE TRIGGER auditar AFTER INSERT OR UPDATE OR DELETE ON audit.auditoria_accesoFOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();;