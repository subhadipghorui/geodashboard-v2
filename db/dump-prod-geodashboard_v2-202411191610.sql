PGDMP      
            
    |            geodashboard_v2     16.3 (Ubuntu 16.3-1.pgdg22.04+1)    16.5 (Debian 16.5-1.pgdg120+1) N    w           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            x           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            y           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            z           1262    48867    geodashboard_v2    DATABASE     {   CREATE DATABASE geodashboard_v2 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.UTF-8';
    DROP DATABASE geodashboard_v2;
                geodashboard_user    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false            {           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    4            �            1259    48904    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap    geodashboard_user    false    4            �            1259    48911    cache_locks    TABLE     �   CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache_locks;
       public         heap    geodashboard_user    false    4            �            1259    48936    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    geodashboard_user    false    4            �            1259    48935    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          geodashboard_user    false    4    227            |           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          geodashboard_user    false    226            �            1259    48928    job_batches    TABLE     d  CREATE TABLE public.job_batches (
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
       public         heap    geodashboard_user    false    4            �            1259    48919    jobs    TABLE     �   CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
    DROP TABLE public.jobs;
       public         heap    geodashboard_user    false    4            �            1259    48918    jobs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.jobs_id_seq;
       public          geodashboard_user    false    4    224            }           0    0    jobs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;
          public          geodashboard_user    false    223            �            1259    48948    layers    TABLE     �  CREATE TABLE public.layers (
    id bigint NOT NULL,
    g_uuid character varying(255) NOT NULL,
    g_label character varying(255) NOT NULL,
    g_slug character varying(255) NOT NULL,
    g_groups json,
    g_layer_type character varying(255),
    g_layer_url character varying(255),
    g_feature_type character varying(255),
    g_map_type character varying(255) DEFAULT 'Mapbox'::character varying,
    g_layer_config json,
    g_meta json,
    status smallint DEFAULT '1'::smallint NOT NULL,
    created_by bigint,
    updated_by bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.layers;
       public         heap    geodashboard_user    false    4            ~           0    0    COLUMN layers.g_map_type    COMMENT     T   COMMENT ON COLUMN public.layers.g_map_type IS 'Mapbox, Leaflet, Openlayer, Cesium';
          public          geodashboard_user    false    229            �            1259    48947    layers_id_seq    SEQUENCE     v   CREATE SEQUENCE public.layers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.layers_id_seq;
       public          geodashboard_user    false    4    229                       0    0    layers_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.layers_id_seq OWNED BY public.layers.id;
          public          geodashboard_user    false    228            �            1259    48959    maps    TABLE     �  CREATE TABLE public.maps (
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
       public         heap    geodashboard_user    false    4            �            1259    48958    maps_id_seq    SEQUENCE     t   CREATE SEQUENCE public.maps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.maps_id_seq;
       public          geodashboard_user    false    4    231            �           0    0    maps_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.maps_id_seq OWNED BY public.maps.id;
          public          geodashboard_user    false    230            �            1259    48869 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    geodashboard_user    false    4            �            1259    48868    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          geodashboard_user    false    216    4            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          geodashboard_user    false    215            �            1259    48888    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    geodashboard_user    false    4            �            1259    48969    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
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
       public         heap    geodashboard_user    false    4            �            1259    48968    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          geodashboard_user    false    4    233            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          geodashboard_user    false    232            �            1259    48895    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    geodashboard_user    false    4            �            1259    48876    users    TABLE       CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    is_superadmin boolean DEFAULT false NOT NULL,
    password character varying(255) NOT NULL,
    created_by bigint,
    updated_by bigint,
    status smallint DEFAULT '0'::smallint NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    geodashboard_user    false    4            �            1259    48875    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          geodashboard_user    false    4    218            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          geodashboard_user    false    217            �           2604    48939    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          geodashboard_user    false    226    227    227            �           2604    48922    jobs id    DEFAULT     b   ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);
 6   ALTER TABLE public.jobs ALTER COLUMN id DROP DEFAULT;
       public          geodashboard_user    false    223    224    224            �           2604    48981 	   layers id    DEFAULT     f   ALTER TABLE ONLY public.layers ALTER COLUMN id SET DEFAULT nextval('public.layers_id_seq'::regclass);
 8   ALTER TABLE public.layers ALTER COLUMN id DROP DEFAULT;
       public          geodashboard_user    false    228    229    229            �           2604    48982    maps id    DEFAULT     b   ALTER TABLE ONLY public.maps ALTER COLUMN id SET DEFAULT nextval('public.maps_id_seq'::regclass);
 6   ALTER TABLE public.maps ALTER COLUMN id DROP DEFAULT;
       public          geodashboard_user    false    231    230    231            �           2604    48872    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          geodashboard_user    false    215    216    216            �           2604    48972    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          geodashboard_user    false    232    233    233            �           2604    48879    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          geodashboard_user    false    218    217    218            h          0    48904    cache 
   TABLE DATA                 public          geodashboard_user    false    221   [       i          0    48911    cache_locks 
   TABLE DATA                 public          geodashboard_user    false    222   *[       n          0    48936    failed_jobs 
   TABLE DATA                 public          geodashboard_user    false    227   D[       l          0    48928    job_batches 
   TABLE DATA                 public          geodashboard_user    false    225   ^[       k          0    48919    jobs 
   TABLE DATA                 public          geodashboard_user    false    224   x[       p          0    48948    layers 
   TABLE DATA                 public          geodashboard_user    false    229   �[       r          0    48959    maps 
   TABLE DATA                 public          geodashboard_user    false    231   �e       c          0    48869 
   migrations 
   TABLE DATA                 public          geodashboard_user    false    216   �h       f          0    48888    password_reset_tokens 
   TABLE DATA                 public          geodashboard_user    false    219   fi       t          0    48969    personal_access_tokens 
   TABLE DATA                 public          geodashboard_user    false    233   �i       g          0    48895    sessions 
   TABLE DATA                 public          geodashboard_user    false    220   �i       e          0    48876    users 
   TABLE DATA                 public          geodashboard_user    false    218   �i       �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          geodashboard_user    false    226            �           0    0    jobs_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);
          public          geodashboard_user    false    223            �           0    0    layers_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.layers_id_seq', 9, true);
          public          geodashboard_user    false    228            �           0    0    maps_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.maps_id_seq', 3, true);
          public          geodashboard_user    false    230            �           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 7, true);
          public          geodashboard_user    false    215            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          geodashboard_user    false    232            �           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 2, true);
          public          geodashboard_user    false    217            �           2606    48917    cache_locks cache_locks_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
 F   ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
       public            geodashboard_user    false    222            �           2606    48910    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public            geodashboard_user    false    221            �           2606    48944    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            geodashboard_user    false    227            �           2606    48946 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            geodashboard_user    false    227            �           2606    48934    job_batches job_batches_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
       public            geodashboard_user    false    225            �           2606    48926    jobs jobs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.jobs DROP CONSTRAINT jobs_pkey;
       public            geodashboard_user    false    224            �           2606    48957    layers layers_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.layers
    ADD CONSTRAINT layers_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.layers DROP CONSTRAINT layers_pkey;
       public            geodashboard_user    false    229            �           2606    48967    maps maps_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.maps
    ADD CONSTRAINT maps_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.maps DROP CONSTRAINT maps_pkey;
       public            geodashboard_user    false    231            �           2606    48874    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            geodashboard_user    false    216            �           2606    48894 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            geodashboard_user    false    219            �           2606    48976 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            geodashboard_user    false    233            �           2606    48979 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            geodashboard_user    false    233            �           2606    48901    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            geodashboard_user    false    220            �           2606    48887    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            geodashboard_user    false    218            �           2606    48885    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            geodashboard_user    false    218            �           1259    48927    jobs_queue_index    INDEX     B   CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
 $   DROP INDEX public.jobs_queue_index;
       public            geodashboard_user    false    224            �           1259    48977 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            geodashboard_user    false    233    233            �           1259    48903    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            geodashboard_user    false    220            �           1259    48902    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            geodashboard_user    false    220            h   
   x���          i   
   x���          n   
   x���          l   
   x���          k   
   x���          p   Z
  x��Z{sڸ������$��X��t��z� Hv6M�#�"ql�����~�l�5�Mڤ�܄��st$����[�a{0�Y�Q�6[8߭OȒΣڹ�9kk�c�v�)�<QP��:�Qƒ�B*�$��!�kØ�4b7�H��7ݳN�^��}yC?�,����S2s��3���K��g�������B{���7w�
�Gb�q<��G�G^�F�i"���ˣ�Z����#E4��Ed���kY��<��k�������T��?����f�n���b�E�:�����?^=��0Ќ�A��dn8	��𛊵f���9�7���sID9�-�ᄒ�]�)�s�*�\�7tν��d�w�X�����º�W�s��6[���C��d��'i��{�5��0�w<o�C'�3���Z	�,6U�o�,vx�Ơ��?+�Z�u<e6r� �l�܋�������m�����Q��y�p{M�R�ꚧ�->ִ�d��D�߻g���4��dr{�Z���e!�5QmȨ!��f�&j$6����Yw�1�)�JcM�.��l��@dn)�r5�r���&�!�X��U����X��XA`42_���ucpP�?����xN��Y�,�!�o�\N��N�~y�/�>�����cy�q]Ev�M����_��HƲ$���EiҿƢJ����+��j��`�Ȇ+#I� ���|
�)�P�|L���1��__�DHıУ�,h�һ�o[.� ���"��M�C?�ھ��\ĺ�o�����]��5>D�yY �u^�9�΋K�7d����:V<aAŒ(Ȏ���k�"�訮*+�� �Cv�f�e�Z-��d:�����q3�q�G3��&$���� '�|�㛸>�����<���1����|� �,��ŏ�qc?�o|��fy� 6�i#t��Lsj���������{�����i���^�{v���Q�I�y򗪀.;���e���1YL�}z���A��ς/k�VJ�E����`����h}�m�Cv ������7�Ȣ3����Ӥ�7^�~�܅ke�^��J�z�4b�S'��!U/t �M1�@2�]�%�P����k�8 �^H5�b^%��H��2�x�k�h,6�1�]�=��J���H	�q���n\��&��K���H�y����l,�X�V��k���[��'AYÿt��Whiy?����/�����7�f�y/ȕ�\V���$U�\�DRC7�H �G�*��k�!(�Q)�gHv6ȹ�����.�	خ�}�]�A���m�:�-W�ٕ2��ލ���{�}Rc����eᔲ�����QehJvXQx$K�[�+�z��������i��D�q�kP�ݲNTQܤ����8H���I
��P]|Ε�<��`�w'�ǰ�vi�#"��[���~���a;�/|� �Y<$�WI�F(Dm��W�˃� oc�%m�ٖ�$����{fC���gC٨�5VJ �ue��:�Mp<M��\��H��*�O��RH�nV��&91����>ā�jw:m[��s�TO�%j���z
+��zi�O�}�M�K&�~ђ�/)֮v/�v\S��R����NqD�u,jV*Ȯ�G��਺�1BDT�A.��ǙO��7N&�d����� ��m�Ru�dj��J��
�lS/�����؛�Vopb��A���"���ꚫY,6��V�I1
�ښv�Y�$�V���j��!�u�s�'�~b{�ܼ���kG��ɮ*��?��ޠ]\��x=_�5l���/���� )��FW���N^e�`�l�:^�^[gl�ۨ�w6�7h���L�k"Έ����Vڦ{���\��g����Ƹ�����]##��4�#�q�9:�i��O���>�3�va�R�=T)7P��D+�3|7��V}�v�.�����..�0+�LID���Z��r�LB?�0���k�9��Q{0Ș�{m޷�n��[�F����F9��[1g��1g�aƠJ�f��;��c��;���Q����"�cd�s�2�v�W�AVQ��{���������4^�@o8�'����b)���n����6����8��f'�  �>rֵ ��֨ ������IՎh��Vy������n��d�Kn�[�Jk�!xB���(��|ũ��f�(��7��#������k#��YH��>!�*>!�Cg4ְg���:cW�eU�� ��qtu�iz�b�O�5kM�P�/Y��څ�3�Y���A���W�k�ժ��|�^Z-\��#ѵ��W�.�0��� ��(V	i���tJ��E��&���s�7���W�w�=1�:b1��d|tMf�&sJV�\��'W�C�:��jp�J)2�Ե�|��PY^�J�L�Z�'�ﭖ��>n���0�<L^�N�9���ə����0+G��Ej(��'"����(WC_:;�+i��_@_ͣ��#C�T�UE���9��٬��g>�h�=���G�I	�P�M��+�?'j�T�� ZD�F�?�*dJS�������:��w�s�h�G�M\�D�z���;4U��FSO���|�!x�'��y�f���L����9@�(6��}2Cj�8 ��g�\���      r   �  x��]o�0���+"߰I1���Iv�n�@bT�n��P��R�Tc��>��FW��vU)B����'y���7�`ts�TM�I��i��o����c��:�4%�� ��O��0�t�3�H��4�����'�5�K�m(?
�n�C��"�2��݆@��ߗ`^�MuW�\�|�yES�J�n*k�&�Z	��nHt��{�����B�&i:K>8B��+w�mnF3�7�����S�Ԣ:m�w>��H���&�*��3��'��jj�����di��L<��Lz��:�&�Mh����^�Gl[�*�$Ĝ!
-j3��~��D��c�a7�ݰ�8��G$B��*��=H�RAkY���U]�L˲�3��Q]�`e ��QR����&�W��^��Z&�~���h��r7�a�X�Bh�r��@���W^7��e}���R��c�f�����w8|v�}�sjw`$X�ܪxb!����6�����U��ٻ�]��Y�[2E�2i������@�!&"	�w���Aq�Qz��.'��7�$�đ�T�h6��O��2"g,d�g�\R�粐F��3_�Maޏ�� = `�^c����4���B�3-$��,�D��s����7�x3�fkG�c�0.������E�%=      c   �   x���M�@໿boH쬟Щ�!Һ범�~����J�a���΄QFɞTm�2�γs͛�,49mw� &K0ɂR
��sPԒ7[-k�O�\�V#�	e(���"g����Z�s�ڝ�(� �E�8��f�*���·���U������*�jΫ9��j���;���,��!uǗ7Y����I�      f   
   x���          t   
   x���          g   
   x���          e   [  x���[o�@����`B�(a��/^0H�����ˊ+�[��B�6mj�d��;�33Gь���f�@Z9!q��y��Z�� eT)�m/"1�:��P��QC�2��Ľ�2,?�p� 
"Du��+܉C�Bv������ǰ��D��%-��tq��q(2����󖳃����;�R���E�<G��*�w�_ݦ��Q��'��Kk�ea�ݯ\��`�N�
�I�J���Co�����_Pl7�_{����'I�t��bϞ��l�Ўc��i�ȋ��+']Uu�+7vi��/�	�j�oeP(Q�k׵�Ѥ��׶��]�g}�}3ى���-a��`�m!�     