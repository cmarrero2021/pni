--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: investigacion_actual; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.investigacion_actual (
    id_investigacion_actual integer NOT NULL,
    ci_investigador integer NOT NULL,
    titulo_investigacion text NOT NULL,
    id_tipo_institucion integer NOT NULL,
    id_centro integer NOT NULL,
    id_tipo_comuna integer,
    id_comuna integer,
    id_linea_investigacion integer NOT NULL,
    resultado_investigacion text NOT NULL,
    id_tipo_investigacion integer NOT NULL,
    id_fase integer NOT NULL,
    tiempo_investigacion integer,
    id_unidad_tiempo integer,
    resultado_esperado text,
    id_com_etica integer,
    id_inst_etica integer,
    impacto_investigacion text,
    publicado boolean,
    enlace_publicacion text
);


ALTER TABLE public.investigacion_actual OWNER TO postgres;

--
-- Name: investigacion_actual_id_investigacion_actual_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.investigacion_actual_id_investigacion_actual_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.investigacion_actual_id_investigacion_actual_seq OWNER TO postgres;

--
-- Name: investigacion_actual_id_investigacion_actual_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.investigacion_actual_id_investigacion_actual_seq OWNED BY public.investigacion_actual.id_investigacion_actual;


--
-- Name: id_investigacion_actual; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.investigacion_actual ALTER COLUMN id_investigacion_actual SET DEFAULT nextval('public.investigacion_actual_id_investigacion_actual_seq'::regclass);


--
-- Data for Name: investigacion_actual; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.investigacion_actual (id_investigacion_actual, ci_investigador, titulo_investigacion, id_tipo_institucion, id_centro, id_tipo_comuna, id_comuna, id_linea_investigacion, resultado_investigacion, id_tipo_investigacion, id_fase, tiempo_investigacion, id_unidad_tiempo, resultado_esperado, id_com_etica, id_inst_etica, impacto_investigacion, publicado, enlace_publicacion) FROM stdin;
\.


--
-- Name: investigacion_actual_id_investigacion_actual_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.investigacion_actual_id_investigacion_actual_seq', 1, false);


--
-- Name: pkey_investigacion_actual_id_investigacion_actual; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.investigacion_actual
    ADD CONSTRAINT pkey_investigacion_actual_id_investigacion_actual PRIMARY KEY (id_investigacion_actual);


--
-- Name: investigacion_actual_ci_investigador_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.investigacion_actual
    ADD CONSTRAINT investigacion_actual_ci_investigador_fkey FOREIGN KEY (ci_investigador) REFERENCES public.investigadores(ci_investigador);


--
-- Name: investigacion_actual_id_fase_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.investigacion_actual
    ADD CONSTRAINT investigacion_actual_id_fase_fkey FOREIGN KEY (id_fase) REFERENCES public.fases(id_fase);


--
-- Name: investigacion_actual_id_linea_investigacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.investigacion_actual
    ADD CONSTRAINT investigacion_actual_id_linea_investigacion_fkey FOREIGN KEY (id_linea_investigacion) REFERENCES public.lineas_investigacion(id_linea_investigacion);


--
-- Name: investigacion_actual_id_tipo_institucion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.investigacion_actual
    ADD CONSTRAINT investigacion_actual_id_tipo_institucion_fkey FOREIGN KEY (id_tipo_institucion) REFERENCES public.tipo_institucion(id_tipo_institucion);


--
-- Name: investigacion_actual_id_tipo_investigacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.investigacion_actual
    ADD CONSTRAINT investigacion_actual_id_tipo_investigacion_fkey FOREIGN KEY (id_tipo_investigacion) REFERENCES public.tipo_investigacion(id_tipo_investigacion);


--
-- Name: investigacion_actual_id_unidad_tiempo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.investigacion_actual
    ADD CONSTRAINT investigacion_actual_id_unidad_tiempo_fkey FOREIGN KEY (id_unidad_tiempo) REFERENCES public.unidades_tiempo(id_unidad_tiempo);


--
-- PostgreSQL database dump complete
--

