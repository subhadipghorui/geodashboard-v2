PGDMP  (                
    |            geodashboard_db    16.4 (Debian 16.4-1.pgdg120+2)    16.4 (Debian 16.4-1.pgdg120+2) N    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    33482    geodashboard_db    DATABASE     u   CREATE DATABASE geodashboard_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_IN';
    DROP DATABASE geodashboard_db;
                postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false            �           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    4            �            1259    35049    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap    root    false    4            �            1259    35056    cache_locks    TABLE     �   CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache_locks;
       public         heap    root    false    4            �            1259    35081    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    root    false    4            �            1259    35080    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          root    false    4    227            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          root    false    226            �            1259    35073    job_batches    TABLE     d  CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);
    DROP TABLE public.job_batches;
       public         heap    root    false    4            �            1259    35064    jobs    TABLE     �   CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
    DROP TABLE public.jobs;
       public         heap    root    false    4            �            1259    35063    jobs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.jobs_id_seq;
       public          root    false    4    224            �           0    0    jobs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;
          public          root    false    223            �            1259    35093    layers    TABLE     {  CREATE TABLE public.layers (
    id bigint NOT NULL,
    g_uuid character varying(255) NOT NULL,
    g_label character varying(255) NOT NULL,
    g_slug character varying(255) NOT NULL,
    g_groups json,
    g_layer_type character varying(255),
    g_layer_url character varying(255),
    g_feature_type character varying(255),
    g_layer_config json,
    g_meta json,
    status smallint DEFAULT '1'::smallint NOT NULL,
    created_by bigint,
    updated_by bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    g_map_type character varying DEFAULT 'Mapbox'::character varying
);
    DROP TABLE public.layers;
       public         heap    root    false    4            �           0    0    COLUMN layers.g_map_type    COMMENT     T   COMMENT ON COLUMN public.layers.g_map_type IS 'Mapbox, Leaflet, Openlayer, Cesium';
          public          root    false    229            �            1259    35092    layers_id_seq    SEQUENCE     v   CREATE SEQUENCE public.layers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.layers_id_seq;
       public          root    false    4    229            �           0    0    layers_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.layers_id_seq OWNED BY public.layers.id;
          public          root    false    228            �            1259    35103    maps    TABLE     �  CREATE TABLE public.maps (
    id bigint NOT NULL,
    g_uuid character varying(255) NOT NULL,
    g_label character varying(255) NOT NULL,
    g_slug character varying(255) NOT NULL,
    g_groups json,
    g_template character varying(255) NOT NULL,
    g_layers json,
    g_meta json,
    status smallint DEFAULT '1'::smallint NOT NULL,
    created_by bigint,
    updated_by bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.maps;
       public         heap    root    false    4            �            1259    35102    maps_id_seq    SEQUENCE     t   CREATE SEQUENCE public.maps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.maps_id_seq;
       public          root    false    4    231            �           0    0    maps_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.maps_id_seq OWNED BY public.maps.id;
          public          root    false    230            �            1259    34341 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    root    false    4            �            1259    34340    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          root    false    4    216            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          root    false    215            �            1259    35033    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    root    false    4            �            1259    35116    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    root    false    4            �            1259    35115    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          root    false    4    233            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          root    false    232            �            1259    35040    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    root    false    4            �            1259    35022    users    TABLE     �  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    is_superadmin boolean DEFAULT false NOT NULL,
    password character varying(255) NOT NULL,
    created_by bigint,
    updated_by bigint,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    root    false    4            �            1259    35021    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          root    false    218    4            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          root    false    217            �           2604    35084    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          root    false    226    227    227            �           2604    35067    jobs id    DEFAULT     b   ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);
 6   ALTER TABLE public.jobs ALTER COLUMN id DROP DEFAULT;
       public          root    false    224    223    224            �           2604    35096 	   layers id    DEFAULT     f   ALTER TABLE ONLY public.layers ALTER COLUMN id SET DEFAULT nextval('public.layers_id_seq'::regclass);
 8   ALTER TABLE public.layers ALTER COLUMN id DROP DEFAULT;
       public          root    false    228    229    229            �           2604    35106    maps id    DEFAULT     b   ALTER TABLE ONLY public.maps ALTER COLUMN id SET DEFAULT nextval('public.maps_id_seq'::regclass);
 6   ALTER TABLE public.maps ALTER COLUMN id DROP DEFAULT;
       public          root    false    231    230    231            �           2604    34344    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          root    false    215    216    216            �           2604    35119    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          root    false    232    233    233            �           2604    35025    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          root    false    218    217    218            z          0    35049    cache 
   TABLE DATA                 public          root    false    221   W       {          0    35056    cache_locks 
   TABLE DATA                 public          root    false    222   9W       �          0    35081    failed_jobs 
   TABLE DATA                 public          root    false    227   SW       ~          0    35073    job_batches 
   TABLE DATA                 public          root    false    225   mW       }          0    35064    jobs 
   TABLE DATA                 public          root    false    224   �W       �          0    35093    layers 
   TABLE DATA                 public          root    false    229   �W       �          0    35103    maps 
   TABLE DATA                 public          root    false    231   �Z       u          0    34341 
   migrations 
   TABLE DATA                 public          root    false    216   �\       x          0    35033    password_reset_tokens 
   TABLE DATA                 public          root    false    219   �]       �          0    35116    personal_access_tokens 
   TABLE DATA                 public          root    false    233   �]       y          0    35040    sessions 
   TABLE DATA                 public          root    false    220   �]       w          0    35022    users 
   TABLE DATA                 public          root    false    218   �]       �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          root    false    226            �           0    0    jobs_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);
          public          root    false    223            �           0    0    layers_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.layers_id_seq', 2, true);
          public          root    false    228            �           0    0    maps_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.maps_id_seq', 2, true);
          public          root    false    230            �           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 45, true);
          public          root    false    215            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          root    false    232            �           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 1, true);
          public          root    false    217            �           2606    35062    cache_locks cache_locks_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
 F   ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
       public            root    false    222            �           2606    35055    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public            root    false    221            �           2606    35089    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            root    false    227            �           2606    35091 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            root    false    227            �           2606    35079    job_batches job_batches_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
       public            root    false    225            �           2606    35071    jobs jobs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.jobs DROP CONSTRAINT jobs_pkey;
       public            root    false    224            �           2606    35101    layers layers_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.layers
    ADD CONSTRAINT layers_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.layers DROP CONSTRAINT layers_pkey;
       public            root    false    229            �           2606    35111    maps maps_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.maps
    ADD CONSTRAINT maps_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.maps DROP CONSTRAINT maps_pkey;
       public            root    false    231            �           2606    34346    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            root    false    216            �           2606    35039 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            root    false    219            �           2606    35123 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            root    false    233            �           2606    35126 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            root    false    233            �           2606    35046    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            root    false    220            �           2606    35032    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            root    false    218            �           2606    35030    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            root    false    218            �           1259    35072    jobs_queue_index    INDEX     B   CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
 $   DROP INDEX public.jobs_queue_index;
       public            root    false    224            �           1259    35124 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            root    false    233    233            �           1259    35048    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            root    false    220            �           1259    35047    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            root    false    220            z   
   x���          {   
   x���          �   
   x���          ~   
   x���          }   
   x���          �   ,  x����o�8��_���I�`0�p�����EJ�ӒN:5Qe�i�̰�5����B���&!�{�����?_L�>͌��죑�O�>�VH�����lj�Ʀ�#���2�-:tc���Ȣ��1�8 ΐ�`�9�#qo���*M,vOW9g:�z6tq9�赟gc�f��-��,b��-J"�I9��������Ek+Q@D��I^�[�r��A�����X�`��`�r��n*08���[�{��T�8fR^+�e�O��N0q���d��6����>��g��г? n且�b�]�E���+�0�����D"�[�Y�sa�8�\UQ2�j?K�:y��������X�������Ēr	��ܪ�Xd�e
���qt2N���$4��4�*0����/_�S����JΫ��C��𧛷���N+��U�AH��%�b��@�J�S�F)O�F�_����S�>*D�%{םH�֧s�iV��Q�ӸV���^Cp�^�D�=�4p�����+��&��NUU��=�x���!��]�N���(�F� ���h�S0�/<�m��,�/�E��kţc�&.s��]N����Im�Ғ{c��&�����Ԏl?�M#��*Z�=��k� ��=}!�p��R2�R^7������Q�XK8M�Y>����Ngg���-${����G��E���י���h�KU۱���%Bk�����o�aP��-(W(�6|�"(/��.Ue��C�vM����>&6��� ^̧s�D��\��#~'�0��5��a#<��G��'V      �   �  x���Qo�0���+�_�$���>mZ*e鴴{i��`�x�l�E���M�*�@�����׷��ͯ{�vz��MZ�lX��x��Nnfާ(���H�4�b<'�H�%N9[bB��gq��i���թ��˵�Z1��4}�L�`EY̊�� ��7(ת��*V
D�O-K�[��)���E6��� ju#��D�,���`��P��D�7ȡ�\t�[l.�AtD7Pl���:�G;��G�42_Y�]�J�����$^FI�`��p�Z�l�(��`ZV����ȬT�[S�Y�� f���L\,YS�o�`7o₠׽�>���;�ϧM�c��j!�9m3���y�X��>cU=u��Y+
i������$S��9s3�-hO��^X�Y}�m3=����~hs7B�AZ�;�}k0y�pR���G$�0�a쑘�J��C9��%�~I��׃��?��Z@      u   �   x����
�@�O1;$�Ψ�Z�� ��e���]��IhE�(/w��É�$��H�6�jS��Y�k�dea�a�އ	���ClJ)`��CY+�(l��6"��vL�V����/*��ƨ�Ee�z.�QUY�2�\@�z^���Zm���?������|`�����d����z�h�@����	��e!4
)����g�b,��g��      x   
   x���          �   
   x���          y   
   x���          w   �   x�u�Ao�0 ��;���D�.#�,,c��x�R�:��(���e'�>o��q��$ �$�.*�,�pՀM�U��2]s��G!�h��^�h��ʥ��*D���L'N�lo�L�=p�4��t&t��#���a�J���4"O�^R�B��Ou*�����*�|X�4���z�y����L���>$����N����~m��&>�z�v�_/=�(Y� EE�ɏφa���V6     