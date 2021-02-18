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
-- Name: menus; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.menus (
    id_menu integer NOT NULL,
    icono character varying(30),
    cod_menu character varying(20) NOT NULL,
    titulo_menu character varying(30) NOT NULL,
    precedencia character varying(50),
    destino character varying(50),
    nivel integer NOT NULL,
    orden integer NOT NULL,
    activo boolean DEFAULT true,
    fecha_registro timestamp(6) without time zone DEFAULT now(),
    grupo integer DEFAULT 2 NOT NULL,
    jerarquia integer
);


ALTER TABLE public.menus OWNER TO postgres;

--
-- Name: menus_id_menu_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menus_id_menu_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.menus_id_menu_seq OWNER TO postgres;

--
-- Name: menus_id_menu_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menus_id_menu_seq OWNED BY public.menus.id_menu;


--
-- Name: id_menu; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus ALTER COLUMN id_menu SET DEFAULT nextval('public.menus_id_menu_seq'::regclass);


--
-- Data for Name: menus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.menus (id_menu, icono, cod_menu, titulo_menu, precedencia, destino, nivel, orden, activo, fecha_registro, grupo, jerarquia) FROM stdin;
12	fa-industry	aux	Empresa		empresa	2	11	f	2020-01-04 19:40:39.314	2	\N
14	fa-times-circle	rep	Vencida		cor_ven	2	13	f	2020-01-04 19:41:34.938	2	\N
15	fa-exclamation-circle 	rep	Por Vencer		cor_ven	2	14	f	2020-01-04 19:41:58.728	2	\N
16	fa-inbox	rep	Corr. Recibida		cor_rec	2	15	f	2020-01-04 19:42:23.001	2	\N
13	fa-newspaper-o	rep	Reportes			1	12	f	2020-01-04 19:41:11.314	2	\N
9	fa fa-newspaper-o	per_act	 Investigación Actual	per	perfil/investigacion_actual	3	8	t	2020-01-04 19:31:33.384	1	2
8	fa fa-graduation-cap	per_inv	 Perfil del Investigador	per	perfil/perfil_investigador	3	3	t	2020-01-04 19:31:13.345	1	2
7	fa fa-briefcase	per_pro	 Perfil de la Investigación	per	perfil/perfil_investigacion	3	4	t	2020-01-04 19:30:44.105	1	2
1	fa fa-user	per_gen	 Perfil General	per	perfil/perfil_general	3	2	t	2020-01-04 19:25:46.732	1	2
2	fa fa-file-o	rep	 Reportes		reportes/registros	2	5	t	2020-01-04 19:26:12.747	2	1
3	fa fa-user-o	rol	 Roles		usuarios/roles	1	6	t	2020-01-04 19:28:22.442	3	1
4	fa fa-eye-slash 	aud	 Auditoría Ingresos		auditoria/ingreso	1	8	t	2020-01-04 19:28:51.53	4	1
5	\N	per	 Perfiles		\N	3	1	t	2020-06-23 13:47:32.599	1	1
6	fa fa-road	aud	 Auditoria Eventos		auditoria/eventos	1	7	t	2020-01-04 19:29:31.73	5	1
10	fa-puzzle-piece	vistas	Vistas		vistas	2	10	t	2020-01-04 19:31:54.944	2	1
11	fa-sitemap	inv	Investigadores		perfil/investigadores	2	9	t	2020-01-04 19:40:20.866	2	1
\.


--
-- Name: menus_id_menu_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.menus_id_menu_seq', 5, true);


--
-- Name: pkey_menus_id_menu; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.menus
    ADD CONSTRAINT pkey_menus_id_menu PRIMARY KEY (id_menu);


--
-- PostgreSQL database dump complete
--

