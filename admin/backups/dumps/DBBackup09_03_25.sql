--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2025-03-09 18:11:45

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
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- TOC entry 4901 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 222 (class 1259 OID 24597)
-- Name: admin; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.admin (
    id_admin integer NOT NULL,
    nom_admin character varying(50) NOT NULL,
    login_admin character varying(50) NOT NULL,
    password_admin character varying(50) NOT NULL
);


--
-- TOC entry 221 (class 1259 OID 24596)
-- Name: admin_id_admin_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.admin_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4902 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_id_admin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.admin_id_admin_seq OWNED BY public.admin.id_admin;


--
-- TOC entry 220 (class 1259 OID 24586)
-- Name: client; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.client (
    id_client integer NOT NULL,
    nom_client character varying(50) NOT NULL,
    prenom_client character varying(50),
    email character varying(50) NOT NULL,
    password character varying(50),
    mobile character varying(50)
);


--
-- TOC entry 219 (class 1259 OID 24585)
-- Name: client_id_client_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.client_id_client_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4903 (class 0 OID 0)
-- Dependencies: 219
-- Name: client_id_client_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.client_id_client_seq OWNED BY public.client.id_client;


--
-- TOC entry 224 (class 1259 OID 24606)
-- Name: representation; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.representation (
    id_representation integer NOT NULL,
    titre character varying(50) NOT NULL,
    type character varying(50),
    date_representation character varying(50)
);


--
-- TOC entry 223 (class 1259 OID 24605)
-- Name: representation_id_representation_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.representation_id_representation_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4904 (class 0 OID 0)
-- Dependencies: 223
-- Name: representation_id_representation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.representation_id_representation_seq OWNED BY public.representation.id_representation;


--
-- TOC entry 226 (class 1259 OID 24613)
-- Name: reservation; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.reservation (
    id_reservation integer NOT NULL,
    date_reservation timestamp without time zone NOT NULL,
    id_client integer NOT NULL,
    id_representation integer NOT NULL,
    id_salle integer NOT NULL
);


--
-- TOC entry 225 (class 1259 OID 24612)
-- Name: reservation_id_reservation_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.reservation_id_reservation_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4905 (class 0 OID 0)
-- Dependencies: 225
-- Name: reservation_id_reservation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.reservation_id_reservation_seq OWNED BY public.reservation.id_reservation;


--
-- TOC entry 218 (class 1259 OID 24577)
-- Name: salle; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.salle (
    id_salle integer NOT NULL,
    num_salle character varying(50) NOT NULL,
    nb_sieges integer NOT NULL
);


--
-- TOC entry 217 (class 1259 OID 24576)
-- Name: salle_id_salle_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.salle_id_salle_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4906 (class 0 OID 0)
-- Dependencies: 217
-- Name: salle_id_salle_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.salle_id_salle_seq OWNED BY public.salle.id_salle;


--
-- TOC entry 4717 (class 2604 OID 24600)
-- Name: admin id_admin; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin ALTER COLUMN id_admin SET DEFAULT nextval('public.admin_id_admin_seq'::regclass);


--
-- TOC entry 4716 (class 2604 OID 24589)
-- Name: client id_client; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client ALTER COLUMN id_client SET DEFAULT nextval('public.client_id_client_seq'::regclass);


--
-- TOC entry 4718 (class 2604 OID 24609)
-- Name: representation id_representation; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.representation ALTER COLUMN id_representation SET DEFAULT nextval('public.representation_id_representation_seq'::regclass);


--
-- TOC entry 4719 (class 2604 OID 24616)
-- Name: reservation id_reservation; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation ALTER COLUMN id_reservation SET DEFAULT nextval('public.reservation_id_reservation_seq'::regclass);


--
-- TOC entry 4715 (class 2604 OID 24580)
-- Name: salle id_salle; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle ALTER COLUMN id_salle SET DEFAULT nextval('public.salle_id_salle_seq'::regclass);


--
-- TOC entry 4891 (class 0 OID 24597)
-- Dependencies: 222
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.admin VALUES (1, 'Admin1', 'admin1', 'adminpass1');
INSERT INTO public.admin VALUES (2, 'Admin2', 'admin2', 'adminpass2');


--
-- TOC entry 4889 (class 0 OID 24586)
-- Dependencies: 220
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.client VALUES (1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'mdp123', '0601020304');
INSERT INTO public.client VALUES (2, 'Martin', 'Sophie', 'sophie.martin@example.com', 'mdp456', '0605060708');
INSERT INTO public.client VALUES (3, 'Durand', 'Paul', 'paul.durand@example.com', 'mdp789', '0608091011');


--
-- TOC entry 4893 (class 0 OID 24606)
-- Dependencies: 224
-- Data for Name: representation; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.representation VALUES (1, 'Concert Rock', 'Musique', '2025-04-15');
INSERT INTO public.representation VALUES (2, 'Pièce de Théâtre', 'Théâtre', '2025-05-20');
INSERT INTO public.representation VALUES (3, 'Ballet Classique', 'Danse', '2025-06-10');


--
-- TOC entry 4895 (class 0 OID 24613)
-- Dependencies: 226
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.reservation VALUES (1, '2025-03-09 18:07:36.566308', 1, 1, 1);
INSERT INTO public.reservation VALUES (2, '2025-03-09 18:07:36.566308', 2, 2, 2);
INSERT INTO public.reservation VALUES (3, '2025-03-09 18:07:36.566308', 3, 3, 3);


--
-- TOC entry 4887 (class 0 OID 24577)
-- Dependencies: 218
-- Data for Name: salle; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.salle VALUES (1, '101', 100);
INSERT INTO public.salle VALUES (2, '102', 150);
INSERT INTO public.salle VALUES (3, '103', 200);


--
-- TOC entry 4907 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 2, true);


--
-- TOC entry 4908 (class 0 OID 0)
-- Dependencies: 219
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.client_id_client_seq', 3, true);


--
-- TOC entry 4909 (class 0 OID 0)
-- Dependencies: 223
-- Name: representation_id_representation_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.representation_id_representation_seq', 3, true);


--
-- TOC entry 4910 (class 0 OID 0)
-- Dependencies: 225
-- Name: reservation_id_reservation_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reservation_id_reservation_seq', 3, true);


--
-- TOC entry 4911 (class 0 OID 0)
-- Dependencies: 217
-- Name: salle_id_salle_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.salle_id_salle_seq', 3, true);


--
-- TOC entry 4731 (class 2606 OID 24604)
-- Name: admin admin_login_admin_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_login_admin_key UNIQUE (login_admin);


--
-- TOC entry 4733 (class 2606 OID 24602)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 4725 (class 2606 OID 24593)
-- Name: client client_email_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_email_key UNIQUE (email);


--
-- TOC entry 4727 (class 2606 OID 24595)
-- Name: client client_mobile_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_mobile_key UNIQUE (mobile);


--
-- TOC entry 4729 (class 2606 OID 24591)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- TOC entry 4735 (class 2606 OID 24611)
-- Name: representation representation_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.representation
    ADD CONSTRAINT representation_pkey PRIMARY KEY (id_representation);


--
-- TOC entry 4737 (class 2606 OID 24618)
-- Name: reservation reservation_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_pkey PRIMARY KEY (id_reservation);


--
-- TOC entry 4721 (class 2606 OID 24584)
-- Name: salle salle_num_salle_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle
    ADD CONSTRAINT salle_num_salle_key UNIQUE (num_salle);


--
-- TOC entry 4723 (class 2606 OID 24582)
-- Name: salle salle_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle
    ADD CONSTRAINT salle_pkey PRIMARY KEY (id_salle);


--
-- TOC entry 4738 (class 2606 OID 24619)
-- Name: reservation reservation_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- TOC entry 4739 (class 2606 OID 24624)
-- Name: reservation reservation_id_representation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_representation_fkey FOREIGN KEY (id_representation) REFERENCES public.representation(id_representation);


--
-- TOC entry 4740 (class 2606 OID 24629)
-- Name: reservation reservation_id_salle_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_salle_fkey FOREIGN KEY (id_salle) REFERENCES public.salle(id_salle);


-- Completed on 2025-03-09 18:11:45

--
-- PostgreSQL database dump complete
--

