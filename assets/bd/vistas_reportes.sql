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
-- Name: vistas_reportes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.vistas_reportes (
    id_vista_reporte integer NOT NULL,
    vista character varying(30) NOT NULL,
    alias_vista character varying(30) NOT NULL,
    campo character varying(30) NOT NULL,
    alias_campo character varying(70) NOT NULL,
    tipo character varying(30) NOT NULL,
    alias_tipo character varying(15) NOT NULL,
    color character(8),
    activo boolean DEFAULT true,
    fecha_registro timestamp(6) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.vistas_reportes OWNER TO postgres;

--
-- Data for Name: vistas_reportes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vistas_reportes (id_vista_reporte, vista, alias_vista, campo, alias_campo, tipo, alias_tipo, color, activo, fecha_registro) FROM stdin;
64	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	id_investigacion_actual	INVESTIGACIÓN ACTUAL.ID INVESTIGACIÓN ACTUAL	integer	ENTERO	#ffd6fd 	t	2020-07-27 13:43:33.476
65	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	ci_investigador	INVESTIGACIÓN ACTUAL.CÉDULA INVESTIGACIÓN	integer	ENTERO	#ffd6fd 	t	2020-07-27 13:43:33.476
66	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	titulo_investigacion	INVESTIGACIÓN ACTUAL.TÍTULO DE LA INVESTIGACIÓN	text	TEXTO	#ffd6fd 	t	2020-07-27 13:43:33.476
67	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	tipo_institucion	INVESTIGACIÓN ACTUAL.TIPO DE INSTITUCIÓN	character varying	CARACTER	#ffd6fd 	t	2020-07-27 13:43:33.476
5	v_investigadores	INVESTIGADORES	id_investigador	INVESTIGADORES.ID INVESTIGADOR	integer	ENTERO	#a6f78b 	t	2020-07-27 13:43:33.476
80	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	fecha_registro	INVESTIGACIÓN ACTUAL.FECHA REGISTRO	timestamp without time zone	FECHA HORA	#ffd6fd 	t	2020-07-27 13:43:33.476
21	v_investigadores	INVESTIGADORES	profesion	INVESTIGADORES.PROFESIÓN	text	TEXTO	#a6f78b 	t	2020-07-27 13:43:33.476
6	v_investigadores	INVESTIGADORES	ci_investigador	INVESTIGADORES.CÉDULA INVESTIGADOR	integer	ENTERO	#a6f78b 	t	2020-07-27 13:43:33.476
7	v_investigadores	INVESTIGADORES	pnombre	INVESTIGADORES.PRIMER NOMBRE	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
8	v_investigadores	INVESTIGADORES	snombre	INVESTIGADORES.SEGUNDO NOMBRE	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
9	v_investigadores	INVESTIGADORES	papellido	INVESTIGADORES.PRIMER APELLIDO	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
10	v_investigadores	INVESTIGADORES	sapellido	INVESTIGADORES.SEGUNDO APELLIDO	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
11	v_investigadores	INVESTIGADORES	nombre_genero	INVESTIGADORES.GÉNERO	text	TEXTO	#a6f78b 	t	2020-07-27 13:43:33.476
12	v_investigadores	INVESTIGADORES	fecha_nac	INVESTIGADORES.FECHA NACIMIENTO	date	FECHA	#a6f78b 	t	2020-07-27 13:43:33.476
13	v_investigadores	INVESTIGADORES	nombre_estado	INVESTIGADORES.ESTADO CIVIL	text	TEXTO	#a6f78b 	t	2020-07-27 13:43:33.476
14	v_investigadores	INVESTIGADORES	estado	INVESTIGADORES.ESTADO CIVIL	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
15	v_investigadores	INVESTIGADORES	municipio	INVESTIGADORES.MUNICIPIO	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
16	v_investigadores	INVESTIGADORES	parroquia	INVESTIGADORES.PARROQUIA	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
17	v_investigadores	INVESTIGADORES	codigo_postal	INVESTIGADORES.CÓDIGO POSTAL	integer	ENTERO	#a6f78b 	t	2020-07-27 13:43:33.476
18	v_investigadores	INVESTIGADORES	telefono	INVESTIGADORES.TELÉFONO LOCAL	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
19	v_investigadores	INVESTIGADORES	celular	INVESTIGADORES.CELULAR	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
20	v_investigadores	INVESTIGADORES	correo	INVESTIGADORES.CORREO	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
22	v_investigadores	INVESTIGADORES	tipo_institucion	INVESTIGADORES.TIPO DE INSTITUCIÓN	text	TEXTO	#a6f78b 	t	2020-07-27 13:43:33.476
23	v_investigadores	INVESTIGADORES	nombre_institucion	INVESTIGADORES.NOMBRE INSTITUCIÓN	character varying	CARACTER	#a6f78b 	t	2020-07-27 13:43:33.476
24	v_investigadores	INVESTIGADORES	modo_investigacion	INVESTIGADORES.MODO INVESTIGACIÓN	text	TEXTO	#a6f78b 	t	2020-07-27 13:43:33.476
25	v_investigadores	INVESTIGADORES	activo	INVESTIGADORES.ACTIVO	text	TEXTO	#a6f78b 	t	2020-07-27 13:43:33.476
26	v_investigadores	INVESTIGADORES	fecha_creacion	INVESTIGADORES.FECHA REGISTRO	timestamp without time zone	FECHA HORA	#a6f78b 	t	2020-07-27 13:43:33.476
27	vperfil_investigador	PERFIL DEL INVESTIGADOR	id_perfil_investigador	PERFIL DEL INVESTIGADOR.ID PERFIL INVESTIGADOR	integer	ENTERO	#acf2fa 	t	2020-07-27 13:43:33.476
28	vperfil_investigador	PERFIL DEL INVESTIGADOR	ci_investigador	PERFIL DEL INVESTIGADOR.CÉDULA DEL INVESTIGADOR	integer	ENTERO	#acf2fa 	t	2020-07-27 13:43:33.476
29	vperfil_investigador	PERFIL DEL INVESTIGADOR	pnombre	PERFIL DEL INVESTIGADOR.PRIMER NOMBRE	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
30	vperfil_investigador	PERFIL DEL INVESTIGADOR	snombre	PERFIL DEL INVESTIGADOR.SEGUNDO NOMBRE	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
31	vperfil_investigador	PERFIL DEL INVESTIGADOR	papellido	PERFIL DEL INVESTIGADOR.PRIMER APELLIDO	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
32	vperfil_investigador	PERFIL DEL INVESTIGADOR	sapellido	PERFIL DEL INVESTIGADOR.SEGUNDO APELLIDO	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
33	vperfil_investigador	PERFIL DEL INVESTIGADOR	rif_investigador	PERFIL DEL INVESTIGADOR.RIF	character	character	#acf2fa 	t	2020-07-27 13:43:33.476
34	vperfil_investigador	PERFIL DEL INVESTIGADOR	nivel_academico	PERFIL DEL INVESTIGADOR.NIVEL ACADÉMICO	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
35	vperfil_investigador	PERFIL DEL INVESTIGADOR	estatus_academico	PERFIL DEL INVESTIGADOR.ESTATUS ACADÉMICO	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
36	vperfil_investigador	PERFIL DEL INVESTIGADOR	nombre_institucion_educativa	PERFIL DEL INVESTIGADOR.INSTITUCIÓN ACADÉMICA	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
37	vperfil_investigador	PERFIL DEL INVESTIGADOR	nombre_especialidad_salud	PERFIL DEL INVESTIGADOR.ESPECIALIDAD SALUD	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
38	vperfil_investigador	PERFIL DEL INVESTIGADOR	area_conocimiento	PERFIL DEL INVESTIGADOR.ÁREA DE COMOCIMIENTO	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
39	vperfil_investigador	PERFIL DEL INVESTIGADOR	sub_area	PERFIL DEL INVESTIGADOR.SUB ÁREA DE CONOCIMIENTO	character varying	CARACTER	#acf2fa 	t	2020-07-27 13:43:33.476
40	vperfil_investigador	PERFIL DEL INVESTIGADOR	consigno_cedula	PERFIL DEL INVESTIGADOR.CONSIGNO CÉDULA	text	TEXTO	#acf2fa 	t	2020-07-27 13:43:33.476
41	vperfil_investigador	PERFIL DEL INVESTIGADOR	consigno_rif	PERFIL DEL INVESTIGADOR.CONSIGNO RIF	text	TEXTO	#acf2fa 	t	2020-07-27 13:43:33.476
42	vperfil_investigador	PERFIL DEL INVESTIGADOR	consigno_foto	PERFIL DEL INVESTIGADOR.CONSIGNO FOTO	text	TEXTO	#acf2fa 	t	2020-07-27 13:43:33.476
43	vperfil_investigador	PERFIL DEL INVESTIGADOR	consigno_titulo	PERFIL DEL INVESTIGADOR.CONSIGNO TÍTULO	text	TEXTO	#acf2fa 	t	2020-07-27 13:43:33.476
44	vperfil_investigador	PERFIL DEL INVESTIGADOR	activo	PERFIL DEL INVESTIGADOR.ACTIVO	text	TEXTO	#acf2fa 	t	2020-07-27 13:43:33.476
45	vperfil_investigador	PERFIL DEL INVESTIGADOR	fecha_creacion	PERFIL DEL INVESTIGADOR.FECHA REGISTRO	timestamp without time zone	FECHA HORA	#acf2fa 	t	2020-07-27 13:43:33.476
46	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	id_perfil_investigacion	PERFIL DE LA INVESTIGACIÓN.ID PERFIL INVESTIGACIÓN	integer	ENTERO	#fadbac 	t	2020-07-27 13:43:33.476
47	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	ci_investigador	PERFIL DE LA INVESTIGACIÓN.CÉDULA DEL INVESTIGADOR	integer	ENTERO	#fadbac 	t	2020-07-27 13:43:33.476
48	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	impacto_politica_publica	PERFIL DE LA INVESTIGACIÓN.INCIDE EN ALGUNA POLÍTICA PÚBLICA	text	TEXTO	#fadbac 	t	2020-07-27 13:43:33.476
49	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	politica_publica	PERFIL DE LA INVESTIGACIÓN.POLÍTICA PÚBLICA	character varying	CARACTER	#fadbac 	t	2020-07-27 13:43:33.476
50	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	linea_investigacion	PERFIL DE LA INVESTIGACIÓN.LÍNEA DE INVESTIGACIÓN	character varying	CARACTER	#fadbac 	t	2020-07-27 13:43:33.476
51	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	tipo_investigacion	PERFIL DE LA INVESTIGACIÓN.TIPO DE INVESTIGACIÓN	character varying	CARACTER	#fadbac 	t	2020-07-27 13:43:33.476
52	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	fase	PERFIL DE LA INVESTIGACIÓN.FASE DE LA INVESTIGACIÓN	character varying	CARACTER	#fadbac 	t	2020-07-27 13:43:33.476
53	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	tipo_institucion	PERFIL DE LA INVESTIGACIÓN.TIPO DE INSTITUCIÓN	character varying	CARACTER	#fadbac 	t	2020-07-27 13:43:33.476
54	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	centro	PERFIL DE LA INVESTIGACIÓN.INSTITUCIÓN	character varying	CARACTER	#fadbac 	t	2020-07-27 13:43:33.476
55	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	titulo_investigacion	PERFIL DE LA INVESTIGACIÓN.TÍTULO DE LA INVESTIGACIÓN	text	TEXTO	#fadbac 	t	2020-07-27 13:43:33.476
56	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	fecha_culminacion	PERFIL DE LA INVESTIGACIÓN.FECHA CULMINACIÓN	date	FECHA	#fadbac 	t	2020-07-27 13:43:33.476
57	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	objetivo_investigacion	PERFIL DE LA INVESTIGACIÓN.OBJETIVO DE LA INVESTIGACIÓN	text	TEXTO	#fadbac 	t	2020-07-27 13:43:33.476
58	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	resultado_investigacion	PERFIL DE LA INVESTIGACIÓN.RESULTADO DE LA INVESTIGACIÓN	text	TEXTO	#fadbac 	t	2020-07-27 13:43:33.476
59	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	publicada	PERFIL DE LA INVESTIGACIÓN.INVESTIGACIÓN PUBLICADA	text	TEXTO	#fadbac 	t	2020-07-27 13:43:33.476
60	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	link_publicacion	PERFIL DE LA INVESTIGACIÓN.ENLACE DE PUBLICACIÓN	character varying	CARACTER	#fadbac 	t	2020-07-27 13:43:33.476
61	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	tiempo_investigacion	PERFIL DE LA INVESTIGACIÓN.TIEMPO DE LA INVESTIGACIÓN	text	TEXTO	#fadbac 	t	2020-07-27 13:43:33.476
62	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	activo	PERFIL DE LA INVESTIGACIÓN.ACTIVO	text	TEXTO	#fadbac 	t	2020-07-27 13:43:33.476
63	vperfil_investigacion	PERFIL DE LA INVESTIGACIÓN	fecha_registro	PERFIL DE LA INVESTIGACIÓN.FECHA REGISTRO	timestamp without time zone	FECHA HORA	#fadbac 	t	2020-07-27 13:43:33.476
1	vinteres_investigacion	INTERÉS INVESTIGACIÓN	ci_investigador	INTERÉS INVESTIGACIÓN.CÉDULA INVESTIGADOR	integer	ENTERO	#f2f2b6 	t	2020-07-27 13:43:33.476
2	vinteres_investigacion	INTERÉS INVESTIGACIÓN	linea_inv1	INTERÉS INVESTIGACIÓN.LÍNEA INVESTIGACIÓN 1	text	TEXTO	#f2f2b6 	t	2020-07-27 13:43:33.476
3	vinteres_investigacion	INTERÉS INVESTIGACIÓN	linea_inv2	INTERÉS INVESTIGACIÓN.LÍNEA INVESTIGACIÓN 2	text	TEXTO	#f2f2b6 	t	2020-07-27 13:43:33.476
4	vinteres_investigacion	INTERÉS INVESTIGACIÓN	linea_inv3	INTERÉS INVESTIGACIÓN.LÍNEA INVESTIGACIÓN 3	text	TEXTO	#f2f2b6 	t	2020-07-27 13:43:33.476
68	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	centro	INVESTIGACIÓN ACTUAL.INSTITUCIÓN	character varying	CARACTER	#ffd6fd 	t	2020-07-27 13:43:33.476
69	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	linea_investigacion	INVESTIGACIÓN ACTUAL.LÍNEA DE INVESTIGACIÓN	character varying	CARACTER	#ffd6fd 	t	2020-07-27 13:43:33.476
70	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	resultado_investigacion	INVESTIGACIÓN ACTUAL.RESULTADO DE LA INVESTIGACIÓN	text	TEXTO	#ffd6fd 	t	2020-07-27 13:43:33.476
71	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	tipo_investigacion	INVESTIGACIÓN ACTUAL.TIPO DE INVESTIGACIÓN	character varying	CARACTER	#ffd6fd 	t	2020-07-27 13:43:33.476
72	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	fase	INVESTIGACIÓN ACTUAL.FASE DE LA INVESTIGACIÓN	character varying	CARACTER	#ffd6fd 	t	2020-07-27 13:43:33.476
73	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	tiempo_investigacion	INVESTIGACIÓN ACTUAL.TIEMPO DE LA INVESTIGACIÓN	text	TEXTO	#ffd6fd 	t	2020-07-27 13:43:33.476
74	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	objetivo_investigacion	INVESTIGACIÓN ACTUAL.OBJETIVO DE LA INVESTIGACIÓN	text	TEXTO	#ffd6fd 	t	2020-07-27 13:43:33.476
75	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	institucion_etica	INVESTIGACIÓN ACTUAL.INSTITUCIÓN ÉTICA	character varying	CARACTER	#ffd6fd 	t	2020-07-27 13:43:33.476
76	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	impacto_investigacion	INVESTIGACIÓN ACTUAL.IMPACTO DE LA INVESTIGACIÓN	text	TEXTO	#ffd6fd 	t	2020-07-27 13:43:33.476
77	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	publicado	INVESTIGACIÓN ACTUAL.PUBLICADO	text	TEXTO	#ffd6fd 	t	2020-07-27 13:43:33.476
78	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	enlace_publicacion	INVESTIGACIÓN ACTUAL.ENLACE DE PUBLICACIÓN	text	TEXTO	#ffd6fd 	t	2020-07-27 13:43:33.476
79	vinvestigacion_actual	INVESTIGACIÓN ACTUAL	activo	INVESTIGACIÓN ACTUAL.ACTIVO	text	TEXTO	#ffd6fd 	t	2020-07-27 13:43:33.476
\.


--
-- Name: vistas_reportes_id_vista_reporte; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.vistas_reportes
    ADD CONSTRAINT vistas_reportes_id_vista_reporte PRIMARY KEY (id_vista_reporte);


--
-- PostgreSQL database dump complete
--

