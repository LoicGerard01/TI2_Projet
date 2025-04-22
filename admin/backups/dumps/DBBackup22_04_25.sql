--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2025-04-22 15:21:08

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 4990 (class 0 OID 16835)
-- Dependencies: 239
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.admin (id_admin, nom_admin, login_admin, password_admin) VALUES (1, 'Superadmin', 'admin', 'admin');


--
-- TOC entry 4974 (class 0 OID 16680)
-- Dependencies: 218
-- Data for Name: departement; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.departement (id_departement, nom_departement, image_resp) VALUES (1, 'Medical', 'Isaline.jpg');
INSERT INTO public.departement (id_departement, nom_departement, image_resp) VALUES (2, 'Logistique', 'Michael.jpg');
INSERT INTO public.departement (id_departement, nom_departement, image_resp) VALUES (3, 'Finances', 'Laura.jpg');


--
-- TOC entry 4986 (class 0 OID 16759)
-- Dependencies: 230
-- Data for Name: galerie; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4980 (class 0 OID 16713)
-- Dependencies: 224
-- Data for Name: materiel; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4976 (class 0 OID 16691)
-- Dependencies: 220
-- Data for Name: mission; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.mission (id_mission, nom_mission, date_debut, date_fin, description, rapport_fin, photo_personnel, id_ville) VALUES (2, 'Mission Modifiée', '2025-04-02', '2025-04-12', 'Nouvelle description', NULL, NULL, 2);
INSERT INTO public.mission (id_mission, nom_mission, date_debut, date_fin, description, rapport_fin, photo_personnel, id_ville) VALUES (5, 'misson2', '2025-04-09', '2025-04-24', 'adzadazdazdzadzad', NULL, NULL, 5);
INSERT INTO public.mission (id_mission, nom_mission, date_debut, date_fin, description, rapport_fin, photo_personnel, id_ville) VALUES (7, 'Mission3', '2025-04-08', '2025-04-23', 'azdazkdnazoidjaozjdoiazjdaz', NULL, NULL, 7);
INSERT INTO public.mission (id_mission, nom_mission, date_debut, date_fin, description, rapport_fin, photo_personnel, id_ville) VALUES (8, 'misson 2', '2025-04-16', '2025-04-17', 'azdazdazdazdaz', NULL, NULL, 5);


--
-- TOC entry 4988 (class 0 OID 16792)
-- Dependencies: 232
-- Data for Name: mission_materiel; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4987 (class 0 OID 16777)
-- Dependencies: 231
-- Data for Name: mission_personnel; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4978 (class 0 OID 16702)
-- Dependencies: 222
-- Data for Name: pays; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.pays (id_pays, nom_pays) VALUES (2, 'Grèce');
INSERT INTO public.pays (id_pays, nom_pays) VALUES (5, 'France');
INSERT INTO public.pays (id_pays, nom_pays) VALUES (6, 'Espagne');


--
-- TOC entry 4984 (class 0 OID 16738)
-- Dependencies: 228
-- Data for Name: personnel; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4982 (class 0 OID 16724)
-- Dependencies: 226
-- Data for Name: ville; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.ville (id_ville, nom_ville, id_pays) VALUES (1, 'Annecy', 5);
INSERT INTO public.ville (id_ville, nom_ville, id_pays) VALUES (2, 'Attique', 2);
INSERT INTO public.ville (id_ville, nom_ville, id_pays) VALUES (3, 'Valence', 6);
INSERT INTO public.ville (id_ville, nom_ville, id_pays) VALUES (4, 'Alicante', 6);
INSERT INTO public.ville (id_ville, nom_ville, id_pays) VALUES (5, 'Thessalie', 2);
INSERT INTO public.ville (id_ville, nom_ville, id_pays) VALUES (6, 'Santorin', 2);
INSERT INTO public.ville (id_ville, nom_ville, id_pays) VALUES (7, 'Gironde', 5);
INSERT INTO public.ville (id_ville, nom_ville, id_pays) VALUES (8, 'Catalogne', 6);


--
-- TOC entry 5005 (class 0 OID 0)
-- Dependencies: 238
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 1, true);


--
-- TOC entry 5006 (class 0 OID 0)
-- Dependencies: 217
-- Name: departement_id_departement_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.departement_id_departement_seq', 3, true);


--
-- TOC entry 5007 (class 0 OID 0)
-- Dependencies: 229
-- Name: galerie_id_galerie_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.galerie_id_galerie_seq', 1, false);


--
-- TOC entry 5008 (class 0 OID 0)
-- Dependencies: 223
-- Name: materiel_id_materiel_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.materiel_id_materiel_seq', 1, false);


--
-- TOC entry 5009 (class 0 OID 0)
-- Dependencies: 219
-- Name: mission_id_mission_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mission_id_mission_seq', 9, true);


--
-- TOC entry 5010 (class 0 OID 0)
-- Dependencies: 221
-- Name: pays_id_pays_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pays_id_pays_seq', 19, true);


--
-- TOC entry 5011 (class 0 OID 0)
-- Dependencies: 227
-- Name: personnel_id_personnel_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personnel_id_personnel_seq', 1, false);


--
-- TOC entry 5012 (class 0 OID 0)
-- Dependencies: 225
-- Name: ville_id_ville_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ville_id_ville_seq', 1, false);


-- Completed on 2025-04-22 15:21:08

--
-- PostgreSQL database dump complete
--

