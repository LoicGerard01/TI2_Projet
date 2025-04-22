--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2025-04-15 14:25:10

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
-- TOC entry 4900 (class 0 OID 24597)
-- Dependencies: 222
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.admin (id_admin, nom_admin, login_admin, password_admin) VALUES (2, 'Admin2', 'admin2', 'adminpass2');
INSERT INTO public.admin (id_admin, nom_admin, login_admin, password_admin) VALUES (1, 'admin', 'admin', 'admin');


--
-- TOC entry 4898 (class 0 OID 24586)
-- Dependencies: 220
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'mdp123', '0601020304');
INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (2, 'Martin', 'Sophie', 'sophie.martin@example.com', 'mdp456', '0605060708');
INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (3, 'Durand', 'Paul', 'paul.durand@example.com', 'mdp789', '0608091011');


--
-- TOC entry 4902 (class 0 OID 24606)
-- Dependencies: 224
-- Data for Name: representation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.representation (id_representation, titre, type, date_representation, image, salle) VALUES (1, 'Concert Rock', 'Musique', '2025-04-15', NULL, 1);
INSERT INTO public.representation (id_representation, titre, type, date_representation, image, salle) VALUES (2, 'Pièce de Théâtre', 'Théâtre', '2025-05-20', NULL, 2);
INSERT INTO public.representation (id_representation, titre, type, date_representation, image, salle) VALUES (3, 'Ballet Classique', 'Danse', '2025-06-10', NULL, 3);


--
-- TOC entry 4904 (class 0 OID 24613)
-- Dependencies: 226
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (1, '2025-03-09 18:07:36.566308', 1, 1, 1);
INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (2, '2025-03-09 18:07:36.566308', 2, 2, 2);
INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (3, '2025-03-09 18:07:36.566308', 3, 3, 3);


--
-- TOC entry 4896 (class 0 OID 24577)
-- Dependencies: 218
-- Data for Name: salle; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (1, '101', 100);
INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (2, '102', 150);
INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (3, '103', 200);
INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (4, '201', 120);


--
-- TOC entry 4915 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 2, true);


--
-- TOC entry 4916 (class 0 OID 0)
-- Dependencies: 219
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_id_client_seq', 3, true);


--
-- TOC entry 4917 (class 0 OID 0)
-- Dependencies: 223
-- Name: representation_id_representation_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.representation_id_representation_seq', 4, true);


--
-- TOC entry 4918 (class 0 OID 0)
-- Dependencies: 225
-- Name: reservation_id_reservation_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reservation_id_reservation_seq', 3, true);


--
-- TOC entry 4919 (class 0 OID 0)
-- Dependencies: 217
-- Name: salle_id_salle_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.salle_id_salle_seq', 4, true);


-- Completed on 2025-04-15 14:25:10

--
-- PostgreSQL database dump complete
--

