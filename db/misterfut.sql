drop table if exists usuarios cascade;

create table usuarios (
    id         bigserial    constraint pk_usuarios primary key,
    nombre     varchar(15)  not null constraint uq_usuarios_nombre unique,
    password   varchar(60)  not null,
    email      varchar(255) not null,
    token      varchar(32),
    created_at timestamptz  default current_timestamp
);

create index idx_usuarios_created_at on usuarios (created_at);

drop table if exists session;

create table session (
    id char(40) not null primary key,
    expire integer,
    data BYTEA
);

drop table if exists equipos cascade;

create table equipos (
    id                 bigserial    constraint pk_equipos primary key,
    nombre             varchar(100) not null,
    partidos_jugados   numeric(3)   default 0,
    partidos_ganados   numeric(3)   default 0,
    partidos_empatados numeric(3)   default 0,
    partidos_perdidos  numeric(3)   default 0,
    goles_a_favor      numeric(3)   default 0,
    goles_en_contra    numeric(3)   default 0,
    temporada          varchar(10)  not null,
    id_usuario         bigint       not null constraint fk_equipos_usuarios
                                             references usuarios (id)
                                             on delete cascade on update cascade,
    constraint uq_equipos_nombre_temporada unique (nombre, temporada, id_usuario)
);

drop table if exists posiciones cascade;

create table posiciones (
    id       bigserial    constraint pk_posiciones primary key,
    posicion varchar(100) not null
);

drop table if exists jugadores cascade;

create table jugadores (
    id                bigserial    constraint pk_jugadores primary key,
    nombre            varchar(100) not null,
    fecha_nac         date         not null,
    dorsal            numeric(2)   not null,
    partidos_jugados  numeric(3)   default 0,
    goles_marcados    numeric(3)   default 0,
    goles_encajados   numeric(3)   default 0,
    asistencias       numeric(3)   default 0,
    goles_por_partido numeric(4,2) default 0,
    esta_lesionado    boolean      default false,
    fecha_alta        date         default current_date + interval '1 day',
    esta_sancionado   boolean      default false,
    id_equipo         bigint       not null constraint fk_jugadores_equipos
                                           references equipos (id)
                                           on delete cascade on update cascade,
    id_posicion       bigint       not null constraint fk_jugadores_posiciones
                                           references posiciones (id)
                                           on delete no action on update cascade
);

drop table if exists eventos cascade;

create table eventos (
    id           bigserial    constraint pk_eventos primary key,
    tipo         varchar(100) not null,
    nombre       varchar(100) not null,
    descripcion  text,
    fecha_inicio date         not null,
    hora_inicio  varchar(5)   not null,
    fecha_fin    date         not null,
    hora_fin     varchar(5)   not null,
    id_equipo    bigint       not null constraint fk_eventos_equipo
                                       references equipos (id)
                                       on delete cascade on update cascade
);

drop table if exists ejercicios cascade;

create table ejercicios (
    id            bigserial   constraint pk_ejercicios primary key,
    id_usuario    bigint      constraint fk_ejercicios_usuarios
                              references usuarios (id)
                              on delete cascade on update cascade,
    nombre        varchar(100) not null,
    tipo          varchar(100) not null,
    descripcion   text         not null,
    num_jugadores int,
    material      text,
    dimensiones   varchar(100)
);
