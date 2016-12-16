CREATE DATABASE crobby;

use crobby;

CREATE TABLE lugar ( lugar_id serial PRIMARY KEY, descripcion varchar (100) NULL, nombre varchar (50) NULL );

CREATE TABLE vector ( vector_id serial PRIMARY KEY, temperatura integer, humedad integer, ruido integer, voz integer, fecha timestamp, lugar_id integer REFERENCES lugar (lugar_id) );

