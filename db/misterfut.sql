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

drop table if exists temporadas cascade;

create table temporadas (
    id           bigserial constraint pk_temporadas primary key,
    fecha_inicio date      default current_date,
    fecha_fin    date,
    id_usuario   bigint    not null constraint fk_temporadas_usuarios
                                    references usuarios (id)
                                    on delete cascade on update no action
);

drop table if exists equipos cascade;

create table equipos (
    id         bigserial    constraint pk_equipos primary key,
    nombre     varchar(100) not null constraint uq_equipos_nombre unique,
    id_usuario bigint       not null constraint fk_equipos_usuarios
                                     references usuarios (id)
                                     on delete cascade on update cascade,
    created_at timestamptz  default current_timestamp
);

drop table if exists estadisticas_equipo cascade;

create table estadisticas_equipo (
    id_temporada       bigint       not null constraint fk_estadisticas_equipo_temporadas
                                             references temporadas (id)
                                             on delete no action on update cascade,
    id_equipo          bigint       not null constraint fk_estadisticas_equipo_equipos
                                             references equipos (id)
                                             on delete cascade on update cascade,
    partidos_jugados   numeric(3)   default 0,
    partidos_ganados   numeric(3)   default 0,
    partidos_empatados numeric(3)   default 0,
    partidos_perdidos  numeric(3)   default 0,
    goles_a_favor      numeric(3)   default 0,
    goles_en_contra    numeric(3)   default 0,
    constraint pk_estadisticas_equipo primary key (id_temporada, id_equipo)
);

drop table if exists posiciones cascade;

create table posiciones (
    id       bigserial    constraint pk_posiciones primary key,
    posicion varchar(100) not null
);

drop table if exists jugadores cascade;

create table jugadores (
    id          bigserial    constraint pk_jugadores primary key,
    nombre      varchar(100) not null,
    fecha_nac   date         not null,
    dorsal      numeric(2)   not null,
    id_posicion bigint       not null constraint fk_jugadores_posiciones
                                      references posiciones (id)
                                      on delete no action on update cascade
);

drop table if exists estadisticas_jugador cascade;

create table estadisticas_jugador (
    id_temporada      bigint       not null constraint fk_estadisticas_jugador_temporada
                                            references temporadas (id)
                                            on delete no action on update cascade,
    id_jugador        bigint       not null constraint fk_estadisticas_jugador_jugadores
                                            references jugadores (id)
                                            on delete cascade on update cascade,
    id_equipo         bigint       not null constraint fk_estadisticas_jugador_equipo
                                            references equipos (id)
                                            on delete cascade on update cascade,
    partidos_jugados  numeric(3)   default 0,
    goles_marcados    numeric(3)   default 0,
    goles_encajados   numeric(3)   default 0,
    asistencias       numeric(3)   default 0,
    goles_por_partido numeric(4,2) default 0,
    constraint pk_estadisticas_jugador primary key (id_temporada, id_jugador, id_equipo)
);

drop table if exists eventos cascade;

create table eventos (
    id          bigserial    constraint pk_eventos primary key,
    nombre      varchar(100) not null,
    descripcion text,
    fecha       timestamptz  not null,
    id_equipo   bigint       not null constraint fk_eventos_equipo
                                      references equipos (id)
                                      on delete cascade on update cascade
);
