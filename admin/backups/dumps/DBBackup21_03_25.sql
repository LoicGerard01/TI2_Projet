--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2025-03-21 11:44:45

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
-- TOC entry 238 (class 1255 OID 24676)
-- Name: ajouter_admin(character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajouter_admin(p_nom_admin character varying, p_login_admin character varying, p_password_admin character varying) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    INSERT INTO Admin (nom_admin, login_admin, password_admin)
    VALUES (p_nom_admin, p_login_admin, p_password_admin);
END;
';


--
-- TOC entry 234 (class 1255 OID 24672)
-- Name: ajouter_client(character varying, character varying, character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajouter_client(p_nom_client character varying, p_prenom_client character varying, p_email character varying, p_password character varying, p_mobile character varying) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    INSERT INTO Client (nom_client, prenom_client, email, password, mobile)
    VALUES (p_nom_client, p_prenom_client, p_email, p_password, p_mobile);
END;
';


--
-- TOC entry 232 (class 1255 OID 24670)
-- Name: ajouter_reservation(integer, integer, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajouter_reservation(p_id_client integer, p_id_representation integer, p_id_salle integer) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    INSERT INTO Reservation (date_reservation, id_client, id_representation, id_salle) 
    VALUES (NOW(), p_id_client, p_id_representation, p_id_salle);
END;
';


--
-- TOC entry 229 (class 1255 OID 24667)
-- Name: ajouter_salle(character varying, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajouter_salle(p_num_salle character varying, p_nb_sieges integer) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    INSERT INTO Salle (num_salle, nb_sieges) 
    VALUES (p_num_salle, p_nb_sieges);
END;
';


--
-- TOC entry 245 (class 1255 OID 24697)
-- Name: get_admin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_admin(p_login text, p_password text) RETURNS text
    LANGUAGE plpgsql
    AS '
DECLARE
    v_nom_admin TEXT;
    v_pwd TEXT;
BEGIN
    -- Sélectionner le mot de passe et le nom de l''administrateur à partir de la table admin
    SELECT password_admin, nom_admin INTO v_pwd, v_nom_admin
    FROM admin
    WHERE login_admin = p_login;

    -- Comparer le mot de passe
    IF v_pwd = p_password THEN
        RETURN v_nom_admin;  -- Retourner le nom si le mot de passe est correct
    ELSE
        RETURN NULL;  -- Retourner NULL si le mot de passe est incorrect
    END IF;
END;
';


--
-- TOC entry 241 (class 1255 OID 24679)
-- Name: get_admins(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_admins() RETURNS TABLE(id_admin integer, nom_admin character varying, login_admin character varying)
    LANGUAGE plpgsql
    AS '
BEGIN
    RETURN QUERY SELECT id_admin, nom_admin, login_admin FROM Admin;
END;
';


--
-- TOC entry 237 (class 1255 OID 24675)
-- Name: get_clients(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_clients() RETURNS TABLE(id_client integer, nom_client character varying, prenom_client character varying, email character varying, mobile character varying)
    LANGUAGE plpgsql
    AS '
BEGIN
    RETURN QUERY SELECT id_client, nom_client, prenom_client, email, mobile FROM Client;
END;
';


--
-- TOC entry 243 (class 1255 OID 24693)
-- Name: get_representations(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_representations() RETURNS TABLE(id_representation integer, titre character varying, type character varying, date_representation date)
    LANGUAGE plpgsql
    AS '
BEGIN
    RETURN QUERY 
    SELECT id_representation, titre, type, date_representation 
    FROM Representation;
END;
';


--
-- TOC entry 242 (class 1255 OID 24692)
-- Name: get_reservations(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_reservations() RETURNS TABLE(id_reservation integer, date_reservation timestamp without time zone, nom_client character varying, prenom_client character varying, email character varying, representation character varying, num_salle character varying)
    LANGUAGE plpgsql
    AS '
BEGIN
    RETURN QUERY 
    SELECT 
        r.id_reservation, 
        r.date_reservation, 
        c.nom_client, 
        c.prenom_client, 
        c.email, 
        rep.titre AS representation, 
        s.num_salle
    FROM Reservation r
    JOIN Client c ON r.id_client = c.id_client
    JOIN Representation rep ON r.id_representation = rep.id_representation
    JOIN Salle s ON r.id_salle = s.id_salle;
END;
';


--
-- TOC entry 244 (class 1255 OID 24694)
-- Name: get_salles(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_salles() RETURNS TABLE(id_salle integer, num_salle character varying, nb_sieges integer)
    LANGUAGE plpgsql
    AS '
BEGIN
    RETURN QUERY 
    SELECT id_salle, num_salle, nb_sieges 
    FROM Salle;
END;
';


--
-- TOC entry 239 (class 1255 OID 24677)
-- Name: modifier_admin(integer, character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.modifier_admin(p_id_admin integer, p_nom_admin character varying, p_login_admin character varying, p_password_admin character varying) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    UPDATE Admin 
    SET nom_admin = p_nom_admin, 
        login_admin = p_login_admin, 
        password_admin = p_password_admin
    WHERE id_admin = p_id_admin;
END;
';


--
-- TOC entry 235 (class 1255 OID 24673)
-- Name: modifier_client(integer, character varying, character varying, character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.modifier_client(p_id_client integer, p_nom_client character varying, p_prenom_client character varying, p_email character varying, p_password character varying, p_mobile character varying) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    UPDATE Client 
    SET nom_client = p_nom_client, 
        prenom_client = p_prenom_client, 
        email = p_email, 
        password = p_password, 
        mobile = p_mobile
    WHERE id_client = p_id_client;
END;
';


--
-- TOC entry 230 (class 1255 OID 24668)
-- Name: modifier_salle(integer, character varying, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.modifier_salle(p_id_salle integer, p_num_salle character varying, p_nb_sieges integer) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    UPDATE Salle 
    SET num_salle = p_num_salle, nb_sieges = p_nb_sieges
    WHERE id_salle = p_id_salle;
END;
';


--
-- TOC entry 240 (class 1255 OID 24678)
-- Name: supprimer_admin(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.supprimer_admin(p_id_admin integer) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    DELETE FROM Admin WHERE id_admin = p_id_admin;
END;
';


--
-- TOC entry 236 (class 1255 OID 24674)
-- Name: supprimer_client(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.supprimer_client(p_id_client integer) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    DELETE FROM Client WHERE id_client = p_id_client;
END;
';


--
-- TOC entry 233 (class 1255 OID 24671)
-- Name: supprimer_reservation(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.supprimer_reservation(p_id_reservation integer) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    DELETE FROM Reservation WHERE id_reservation = p_id_reservation;
END;
';


--
-- TOC entry 231 (class 1255 OID 24669)
-- Name: supprimer_salle(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.supprimer_salle(p_id_salle integer) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    DELETE FROM Salle WHERE id_salle = p_id_salle;
END;
';


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
-- TOC entry 4928 (class 0 OID 0)
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
-- TOC entry 4929 (class 0 OID 0)
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
    date_representation date,
    image text
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
-- TOC entry 4930 (class 0 OID 0)
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
-- TOC entry 4931 (class 0 OID 0)
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
-- TOC entry 4932 (class 0 OID 0)
-- Dependencies: 217
-- Name: salle_id_salle_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.salle_id_salle_seq OWNED BY public.salle.id_salle;


--
-- TOC entry 228 (class 1259 OID 24688)
-- Name: vue_representations_a_venir; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_representations_a_venir AS
 SELECT id_representation,
    titre,
    type,
    date_representation
   FROM public.representation
  WHERE (date_representation >= CURRENT_DATE)
  ORDER BY date_representation;


--
-- TOC entry 227 (class 1259 OID 24662)
-- Name: vue_reservations; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_reservations AS
 SELECT r.id_reservation,
    r.date_reservation,
    c.nom_client,
    c.prenom_client,
    c.email,
    rep.titre AS representation,
    s.num_salle,
    s.nb_sieges
   FROM (((public.reservation r
     JOIN public.client c ON ((r.id_client = c.id_client)))
     JOIN public.representation rep ON ((r.id_representation = rep.id_representation)))
     JOIN public.salle s ON ((r.id_salle = s.id_salle)));


--
-- TOC entry 4742 (class 2604 OID 24600)
-- Name: admin id_admin; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin ALTER COLUMN id_admin SET DEFAULT nextval('public.admin_id_admin_seq'::regclass);


--
-- TOC entry 4741 (class 2604 OID 24589)
-- Name: client id_client; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client ALTER COLUMN id_client SET DEFAULT nextval('public.client_id_client_seq'::regclass);


--
-- TOC entry 4743 (class 2604 OID 24609)
-- Name: representation id_representation; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.representation ALTER COLUMN id_representation SET DEFAULT nextval('public.representation_id_representation_seq'::regclass);


--
-- TOC entry 4744 (class 2604 OID 24616)
-- Name: reservation id_reservation; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation ALTER COLUMN id_reservation SET DEFAULT nextval('public.reservation_id_reservation_seq'::regclass);


--
-- TOC entry 4740 (class 2604 OID 24580)
-- Name: salle id_salle; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle ALTER COLUMN id_salle SET DEFAULT nextval('public.salle_id_salle_seq'::regclass);


--
-- TOC entry 4918 (class 0 OID 24597)
-- Dependencies: 222
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.admin (id_admin, nom_admin, login_admin, password_admin) VALUES (2, 'Admin2', 'admin2', 'adminpass2');
INSERT INTO public.admin (id_admin, nom_admin, login_admin, password_admin) VALUES (1, 'admin', 'admin', 'admin');


--
-- TOC entry 4916 (class 0 OID 24586)
-- Dependencies: 220
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'mdp123', '0601020304');
INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (2, 'Martin', 'Sophie', 'sophie.martin@example.com', 'mdp456', '0605060708');
INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (3, 'Durand', 'Paul', 'paul.durand@example.com', 'mdp789', '0608091011');


--
-- TOC entry 4920 (class 0 OID 24606)
-- Dependencies: 224
-- Data for Name: representation; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.representation (id_representation, titre, type, date_representation, image) VALUES (1, 'Concert Rock', 'Musique', '2025-04-15', NULL);
INSERT INTO public.representation (id_representation, titre, type, date_representation, image) VALUES (2, 'Pièce de Théâtre', 'Théâtre', '2025-05-20', NULL);
INSERT INTO public.representation (id_representation, titre, type, date_representation, image) VALUES (3, 'Ballet Classique', 'Danse', '2025-06-10', NULL);


--
-- TOC entry 4922 (class 0 OID 24613)
-- Dependencies: 226
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (1, '2025-03-09 18:07:36.566308', 1, 1, 1);
INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (2, '2025-03-09 18:07:36.566308', 2, 2, 2);
INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (3, '2025-03-09 18:07:36.566308', 3, 3, 3);


--
-- TOC entry 4914 (class 0 OID 24577)
-- Dependencies: 218
-- Data for Name: salle; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (1, '101', 100);
INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (2, '102', 150);
INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (3, '103', 200);


--
-- TOC entry 4933 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 2, true);


--
-- TOC entry 4934 (class 0 OID 0)
-- Dependencies: 219
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.client_id_client_seq', 3, true);


--
-- TOC entry 4935 (class 0 OID 0)
-- Dependencies: 223
-- Name: representation_id_representation_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.representation_id_representation_seq', 3, true);


--
-- TOC entry 4936 (class 0 OID 0)
-- Dependencies: 225
-- Name: reservation_id_reservation_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reservation_id_reservation_seq', 3, true);


--
-- TOC entry 4937 (class 0 OID 0)
-- Dependencies: 217
-- Name: salle_id_salle_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.salle_id_salle_seq', 3, true);


--
-- TOC entry 4756 (class 2606 OID 24604)
-- Name: admin admin_login_admin_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_login_admin_key UNIQUE (login_admin);


--
-- TOC entry 4758 (class 2606 OID 24602)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 4750 (class 2606 OID 24593)
-- Name: client client_email_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_email_key UNIQUE (email);


--
-- TOC entry 4752 (class 2606 OID 24595)
-- Name: client client_mobile_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_mobile_key UNIQUE (mobile);


--
-- TOC entry 4754 (class 2606 OID 24591)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- TOC entry 4760 (class 2606 OID 24611)
-- Name: representation representation_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.representation
    ADD CONSTRAINT representation_pkey PRIMARY KEY (id_representation);


--
-- TOC entry 4762 (class 2606 OID 24618)
-- Name: reservation reservation_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_pkey PRIMARY KEY (id_reservation);


--
-- TOC entry 4746 (class 2606 OID 24584)
-- Name: salle salle_num_salle_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle
    ADD CONSTRAINT salle_num_salle_key UNIQUE (num_salle);


--
-- TOC entry 4748 (class 2606 OID 24582)
-- Name: salle salle_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle
    ADD CONSTRAINT salle_pkey PRIMARY KEY (id_salle);


--
-- TOC entry 4763 (class 2606 OID 24619)
-- Name: reservation reservation_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- TOC entry 4764 (class 2606 OID 24624)
-- Name: reservation reservation_id_representation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_representation_fkey FOREIGN KEY (id_representation) REFERENCES public.representation(id_representation);


--
-- TOC entry 4765 (class 2606 OID 24629)
-- Name: reservation reservation_id_salle_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_salle_fkey FOREIGN KEY (id_salle) REFERENCES public.salle(id_salle);


-- Completed on 2025-03-21 11:44:45

--
-- PostgreSQL database dump complete
--

