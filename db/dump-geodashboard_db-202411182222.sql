PGDMP                  
    |            geodashboard_db    16.4 (Debian 16.4-1.pgdg120+2)    16.4 (Debian 16.4-1.pgdg120+2)     I           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            J           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            K           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            L           1262    33482    geodashboard_db    DATABASE     u   CREATE DATABASE geodashboard_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_IN';
    DROP DATABASE geodashboard_db;
                postgres    false            �            1259    35093    layers    TABLE     {  CREATE TABLE public.layers (
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
       public         heap    root    false            M           0    0    COLUMN layers.g_map_type    COMMENT     T   COMMENT ON COLUMN public.layers.g_map_type IS 'Mapbox, Leaflet, Openlayer, Cesium';
          public          root    false    229            �            1259    35092    layers_id_seq    SEQUENCE     v   CREATE SEQUENCE public.layers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.layers_id_seq;
       public          root    false    229            N           0    0    layers_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.layers_id_seq OWNED BY public.layers.id;
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
       public         heap    root    false            �            1259    35102    maps_id_seq    SEQUENCE     t   CREATE SEQUENCE public.maps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.maps_id_seq;
       public          root    false    231            O           0    0    maps_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.maps_id_seq OWNED BY public.maps.id;
          public          root    false    230            �           2604    35096 	   layers id    DEFAULT     f   ALTER TABLE ONLY public.layers ALTER COLUMN id SET DEFAULT nextval('public.layers_id_seq'::regclass);
 8   ALTER TABLE public.layers ALTER COLUMN id DROP DEFAULT;
       public          root    false    228    229    229            �           2604    35106    maps id    DEFAULT     b   ALTER TABLE ONLY public.maps ALTER COLUMN id SET DEFAULT nextval('public.maps_id_seq'::regclass);
 6   ALTER TABLE public.maps ALTER COLUMN id DROP DEFAULT;
       public          root    false    231    230    231            D          0    35093    layers 
   TABLE DATA           �   COPY public.layers (id, g_uuid, g_label, g_slug, g_groups, g_layer_type, g_layer_url, g_feature_type, g_layer_config, g_meta, status, created_by, updated_by, created_at, updated_at, g_map_type) FROM stdin;
    public          root    false    229   h       F          0    35103    maps 
   TABLE DATA           �   COPY public.maps (id, g_uuid, g_label, g_slug, g_groups, g_template, g_layers, g_meta, status, created_by, updated_by, created_at, updated_at) FROM stdin;
    public          root    false    231   v       P           0    0    layers_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.layers_id_seq', 2, true);
          public          root    false    228            Q           0    0    maps_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.maps_id_seq', 2, true);
          public          root    false    230            �           2606    35101    layers layers_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.layers
    ADD CONSTRAINT layers_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.layers DROP CONSTRAINT layers_pkey;
       public            root    false    229            �           2606    35111    maps maps_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.maps
    ADD CONSTRAINT maps_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.maps DROP CONSTRAINT maps_pkey;
       public            root    false    231            D   �  x��Tko�0�������I8�` A]�RSMj;ij����s0�&K���wM���v[b�{_�s -�D�#���1�	f4�T�Q�K[}V$j��3�K�R,�lZHњ>��Z��v:�r�Z"���/Q���s���\ gg�,
��Lp�JX1��WhbL����5\��t��
��if
��U"3���mm�y3.귌s��Ȩ�"�?�vG	��ﻴ�.�����ܐ%"p���iQ?�|F{�����A�,�Uj��b6_ń�R�g5�-J�,��6e%4��HO�)�Q8H��(�*��2
���Ȋ=�1�8��ib��ʍ� ���art�B��Q�^.���mV!�,Tq����.c^IY�;{�F��|���$���Z�:X��G%r.V��*cyg�ΒLffa�`�fO�s�G���tݨ,�`�F��O��
�&��9�T���u�2�6��ޫ5��,5{u]k+a��<ף�L���>�]o�u�n/z��[��k�+uq�� �p,0�>潄�������y��0#t��X�"x�'�n��m�E��5�xhu�C�^=K)3�Q��?��}`�[�X_K|c=Ĵ�����Y>W�����^�<-��㋏��[�����w�;;���N�=m��}��#vK���t����E��z�����{����LÆ�PG,Xnñ`�*�J^�Q��j�?t��v�!��y��D����Q�?��=+n��'v�)���uc��dc�A������6�      F   �  x��R�N�0=�_Q�;b|\qd�+q�r�i�%�#۩6T�w&M��
r�߼7~�L]&��4O�|.�'�5ʹZS��Z�i����~�&��i��Y����~��TM�<9ƣ�)�m��ZU@$��L�\G��e[ ܼ�>��z"�k!&��'Я�Ru�0�U���O���}<�3��~��&r����w���~�c0�����彇gk+"9�S���!��:I���D���bҘ�o�Dfʙ�8č�� �����r�#{$)����a��2� $���F��qv��]dT�*�t^��u�� ��R?Q��ڠ�uߐۑy����+K�>^%�KG�5����Oҝ/W��V�����{}yW�[D�8l��`S:�G��c:⇕�dN9�<��T�K�n����ɘ���l2�� ��U�     