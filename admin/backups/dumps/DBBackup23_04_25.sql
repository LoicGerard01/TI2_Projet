--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2025-04-23 10:42:37

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
-- TOC entry 4919 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 229 (class 1255 OID 24747)
-- Name: ajout_representation(text, text, date, text, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajout_representation(text, text, date, text, integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
    DECLARE 
        p_titre ALIAS FOR $1; 
        p_type ALIAS FOR $2;
        p_date ALIAS FOR $3;
        p_image ALIAS FOR $4;
        p_salle ALIAS FOR $5;
        retour integer;
    BEGIN
        INSERT INTO representation (titre, type, date_representation, image, salle)
        VALUES (p_titre, p_type, p_date, p_image, p_salle) 
        ON CONFLICT DO NOTHING;
        
        SELECT INTO retour id_representation FROM representation WHERE titre = p_titre AND date_representation = p_date;
    
        IF retour IS NULL THEN
          RETURN -1;
        ELSE
          RETURN retour;
        END IF;
    END;
';


--
-- TOC entry 245 (class 1255 OID 24754)
-- Name: ajouter_client(text, text, text, text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajouter_client(p_nom_client text, p_prenom_client text, p_email text, p_password text, p_mobile text) RETURNS text
    LANGUAGE plpgsql
    AS '
DECLARE
    v_exists INTEGER;
BEGIN
    -- Vérifie si l''email existe déjà
    SELECT COUNT(*) INTO v_exists
    FROM client
    WHERE email = p_email;

    IF v_exists > 0 THEN
        RETURN ''Email déjà utilisé'';
    END IF;

    -- Insertion du nouveau client
    INSERT INTO client(nom_client, prenom_client, email, password, mobile)
    VALUES (p_nom_client, p_prenom_client, p_email, p_password, p_mobile);

    RETURN 1;
END;
';


--
-- TOC entry 230 (class 1255 OID 24748)
-- Name: delete_representation(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.delete_representation(integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
    DECLARE p_id ALIAS FOR $1;
    BEGIN
        DELETE FROM representation WHERE id_representation = p_id;
        RETURN 1;
    END;
';


--
-- TOC entry 232 (class 1255 OID 24751)
-- Name: get_admin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_admin(p_login text, p_password text) RETURNS text
    LANGUAGE plpgsql
    AS '
DECLARE
    v_nom_admin TEXT;
    v_pwd TEXT;
BEGIN
    SELECT password_admin, nom_admin INTO v_pwd, v_nom_admin
    FROM admin
    WHERE login_admin = p_login;

    IF v_pwd = p_password THEN
        RETURN v_nom_admin;
    ELSE
        RETURN NULL;
    END IF;
END;
';


--
-- TOC entry 246 (class 1255 OID 24753)
-- Name: get_client(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_client(p_email text, p_password text) RETURNS text
    LANGUAGE plpgsql
    AS '
DECLARE
    v_nom_client TEXT;
    v_pwd TEXT;
BEGIN
    SELECT nom_client, password INTO v_nom_client, v_pwd
    FROM client
    WHERE email = p_email;

    IF v_pwd = p_password THEN
        RETURN v_nom_client;
    ELSE
        RETURN NULL;
    END IF;
END;
';


--
-- TOC entry 244 (class 1255 OID 24752)
-- Name: update_ajax_representation(text, text, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.update_ajax_representation(champ text, valeur text, id_rep integer) RETURNS void
    LANGUAGE plpgsql
    AS '
BEGIN
    IF champ = ''titre'' THEN
        UPDATE representation SET titre = valeur WHERE id_representation = id_rep;
    ELSIF champ = ''type'' THEN
        UPDATE representation SET type = valeur WHERE id_representation = id_rep;
    ELSIF champ = ''date_representation'' THEN
        UPDATE representation SET date_representation = valeur::date WHERE id_representation = id_rep;
    ELSIF champ = ''image'' THEN
        UPDATE representation SET image = valeur WHERE id_representation = id_rep;
    ELSIF champ = ''salle'' THEN
        UPDATE representation SET salle = valeur::int WHERE id_representation = id_rep;
    ELSE
        RAISE EXCEPTION ''Champ invalide : %'', champ;
    END IF;
END;
';


--
-- TOC entry 231 (class 1255 OID 24750)
-- Name: update_representation(integer, text, text, date, text, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.update_representation(integer, text, text, date, text, integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
    DECLARE 
        p_id_representation ALIAS FOR $1;
        p_titre ALIAS FOR $2; 
        p_type ALIAS FOR $3;
        p_date ALIAS FOR $4;
        p_image ALIAS FOR $5;
        p_salle ALIAS FOR $6;
        retour integer;
    BEGIN
        UPDATE representation 
        SET titre = p_titre, 
            type = p_type, 
            date_representation = p_date, 
            image = p_image, 
            salle = p_salle
        WHERE id_representation = p_id_representation;
        
        GET DIAGNOSTICS retour = ROW_COUNT;
        RETURN retour;    
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
-- TOC entry 4920 (class 0 OID 0)
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
-- TOC entry 4921 (class 0 OID 0)
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
    image text,
    salle integer
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
-- TOC entry 4922 (class 0 OID 0)
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
-- TOC entry 4923 (class 0 OID 0)
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
-- TOC entry 4924 (class 0 OID 0)
-- Dependencies: 217
-- Name: salle_id_salle_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.salle_id_salle_seq OWNED BY public.salle.id_salle;


--
-- TOC entry 228 (class 1259 OID 24723)
-- Name: vue_representations_a_venir; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_representations_a_venir AS
 SELECT r.id_representation,
    r.titre,
    r.type,
    r.date_representation,
    r.salle,
    r.image,
    s.nb_sieges,
    s.num_salle
   FROM (public.representation r
     JOIN public.salle s ON ((s.id_salle = r.salle)))
  WHERE (r.date_representation >= CURRENT_DATE)
  ORDER BY r.date_representation;


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
-- TOC entry 4732 (class 2604 OID 24600)
-- Name: admin id_admin; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin ALTER COLUMN id_admin SET DEFAULT nextval('public.admin_id_admin_seq'::regclass);


--
-- TOC entry 4731 (class 2604 OID 24589)
-- Name: client id_client; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client ALTER COLUMN id_client SET DEFAULT nextval('public.client_id_client_seq'::regclass);


--
-- TOC entry 4733 (class 2604 OID 24609)
-- Name: representation id_representation; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.representation ALTER COLUMN id_representation SET DEFAULT nextval('public.representation_id_representation_seq'::regclass);


--
-- TOC entry 4734 (class 2604 OID 24616)
-- Name: reservation id_reservation; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation ALTER COLUMN id_reservation SET DEFAULT nextval('public.reservation_id_reservation_seq'::regclass);


--
-- TOC entry 4730 (class 2604 OID 24580)
-- Name: salle id_salle; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle ALTER COLUMN id_salle SET DEFAULT nextval('public.salle_id_salle_seq'::regclass);


--
-- TOC entry 4909 (class 0 OID 24597)
-- Dependencies: 222
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.admin (id_admin, nom_admin, login_admin, password_admin) VALUES (2, 'Admin2', 'admin2', 'adminpass2');
INSERT INTO public.admin (id_admin, nom_admin, login_admin, password_admin) VALUES (1, 'admin', 'admin', 'admin');


--
-- TOC entry 4907 (class 0 OID 24586)
-- Dependencies: 220
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'mdp123', '0601020304');
INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (2, 'Martin', 'Sophie', 'sophie.martin@example.com', 'mdp456', '0605060708');
INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (3, 'Durand', 'Paul', 'paul.durand@example.com', 'mdp789', '0608091011');
INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (4, 'Durand', 'Sophie', 'sophie.durand@example.com', 'motdepasse123', '0478123457');
INSERT INTO public.client (id_client, nom_client, prenom_client, email, password, mobile) VALUES (8, 'bob', 'bob', 'Bob', 'Bob', '11111111111');


--
-- TOC entry 4911 (class 0 OID 24606)
-- Dependencies: 224
-- Data for Name: representation; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.representation (id_representation, titre, type, date_representation, image, salle) VALUES (1, 'Concert Rock', 'Musique', '2025-04-15', NULL, 1);
INSERT INTO public.representation (id_representation, titre, type, date_representation, image, salle) VALUES (11, 'Dr. Jekyll & Mr. Hyde', 'Théatre', '2025-06-19', 'dr_Jekyll.jpeg', 4);
INSERT INTO public.representation (id_representation, titre, type, date_representation, image, salle) VALUES (12, 'test', 'TEST', '2025-04-24', 'azddazdzadza', 1);
INSERT INTO public.representation (id_representation, titre, type, date_representation, image, salle) VALUES (2, 'Romeo & Juliet', 'Théâtre', '2025-05-30', 'romeo_juliet.jpg', 3);
INSERT INTO public.representation (id_representation, titre, type, date_representation, image, salle) VALUES (3, 'La Bohème', 'Opéra', '2025-06-10', 'boheme.png', 4);


--
-- TOC entry 4913 (class 0 OID 24613)
-- Dependencies: 226
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (1, '2025-03-09 18:07:36.566308', 1, 1, 1);
INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (2, '2025-03-09 18:07:36.566308', 2, 2, 2);
INSERT INTO public.reservation (id_reservation, date_reservation, id_client, id_representation, id_salle) VALUES (3, '2025-03-09 18:07:36.566308', 3, 3, 3);


--
-- TOC entry 4905 (class 0 OID 24577)
-- Dependencies: 218
-- Data for Name: salle; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (1, '101', 100);
INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (2, '102', 150);
INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (3, '103', 200);
INSERT INTO public.salle (id_salle, num_salle, nb_sieges) VALUES (4, '201', 120);


--
-- TOC entry 4925 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 2, true);


--
-- TOC entry 4926 (class 0 OID 0)
-- Dependencies: 219
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.client_id_client_seq', 8, true);


--
-- TOC entry 4927 (class 0 OID 0)
-- Dependencies: 223
-- Name: representation_id_representation_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.representation_id_representation_seq', 13, true);


--
-- TOC entry 4928 (class 0 OID 0)
-- Dependencies: 225
-- Name: reservation_id_reservation_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reservation_id_reservation_seq', 3, true);


--
-- TOC entry 4929 (class 0 OID 0)
-- Dependencies: 217
-- Name: salle_id_salle_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.salle_id_salle_seq', 4, true);


--
-- TOC entry 4746 (class 2606 OID 24604)
-- Name: admin admin_login_admin_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_login_admin_key UNIQUE (login_admin);


--
-- TOC entry 4748 (class 2606 OID 24602)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 4740 (class 2606 OID 24593)
-- Name: client client_email_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_email_key UNIQUE (email);


--
-- TOC entry 4742 (class 2606 OID 24595)
-- Name: client client_mobile_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_mobile_key UNIQUE (mobile);


--
-- TOC entry 4744 (class 2606 OID 24591)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- TOC entry 4750 (class 2606 OID 24611)
-- Name: representation representation_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.representation
    ADD CONSTRAINT representation_pkey PRIMARY KEY (id_representation);


--
-- TOC entry 4752 (class 2606 OID 24618)
-- Name: reservation reservation_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_pkey PRIMARY KEY (id_reservation);


--
-- TOC entry 4736 (class 2606 OID 24584)
-- Name: salle salle_num_salle_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle
    ADD CONSTRAINT salle_num_salle_key UNIQUE (num_salle);


--
-- TOC entry 4738 (class 2606 OID 24582)
-- Name: salle salle_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.salle
    ADD CONSTRAINT salle_pkey PRIMARY KEY (id_salle);


--
-- TOC entry 4753 (class 2606 OID 24714)
-- Name: representation fk_salle; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.representation
    ADD CONSTRAINT fk_salle FOREIGN KEY (salle) REFERENCES public.salle(id_salle) NOT VALID;


--
-- TOC entry 4754 (class 2606 OID 24619)
-- Name: reservation reservation_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- TOC entry 4755 (class 2606 OID 24624)
-- Name: reservation reservation_id_representation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_representation_fkey FOREIGN KEY (id_representation) REFERENCES public.representation(id_representation);


--
-- TOC entry 4756 (class 2606 OID 24629)
-- Name: reservation reservation_id_salle_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_salle_fkey FOREIGN KEY (id_salle) REFERENCES public.salle(id_salle);


-- Completed on 2025-04-23 10:42:37

--
-- PostgreSQL database dump complete
--

