drop table if exists usuarios cascade;

create table usuarios (
    id         bigserial    constraint pk_usuarios primary key,
    nombre     varchar(15)  not null constraint uq_usuarios_nombre unique,
    password   varchar(60)  not null,
    email      varchar(255) not null,
    token      varchar(32),
    --activacion varchar(32),
    created_at timestamptz  default current_timestamp
);

create index idx_usuarios_activacion on usuarios (activacion);
create index idx_usuarios_created_at on usuarios (created_at);

insert into usuarios(nombre, email, password)
    values  ('christian','christianhf.chf@gmail.com', crypt('christian', gen_salt('bf', 13))),
            ('pepe','pepe@gmail.com', crypt('pepe', gen_salt('bf', 13)));

drop table if exists session;

create table session (
    id char(40) not null primary key,
    expire integer,
    data BYTEA
);

drop table if exists equipos cascade;

create table equipos (
    id                 bigserial    constraint pk_equipos primary key,
    nombre             varchar(100) not null constraint uq_equipos_nombre unique,
    partidos_ganados   numeric(3)   default 0,
    partidos_empatados numeric(3)   default 0,
    partidos_perdidos  numeric(3)   default 0,
    goles_a_favor      numeric(3)   default 0,
    goles_en_contra    numeric(3)   default 0,
    id_usuario         bigint       not null constraint fk_equipos_usuarios
                                             references usuarios (id)
                                             on delete cascade on update cascade
);

insert into equipos(nombre, id_usuario)
    values  ('Real Madrid', 1),
            ('Cadiz', 1),
            ('Fruteria Pepe', 2);

drop table if exists posiciones cascade;

create table posiciones (
    id       bigserial    constraint pk_posiciones primary key,
    posicion varchar(100) not null
);

insert into posiciones(posicion)
    values  ('POR'), ('CAD'), ('LD'), ('DFC'), ('LI'), ('CAI'), ('MCD'), ('MD'),
            ('MC'), ('MI'), ('MCO'), ('SDD'), ('SD'), ('SDI'), ('ED'), ('DC'),
            ('EI');

drop table if exists jugadores cascade;

create table jugadores (
    id               bigserial    constraint pk_jugadores primary key,
    nombre           varchar(100) not null,
    fecha_nac        date         not null,
    dorsal           numeric(2)   not null,
    partidos_jugados numeric(3)   default 0,
    goles_marcados   numeric(3)   default 0,
    goles_encajados  numeric(3)   default 0,
    asistencias      numeric(3)   default 0,
    id_equipo        bigint       not null constraint fk_jugadores_equipos
                                           references equipos (id)
                                           on delete cascade on update cascade,
    id_posicion      bigint       not null constraint fk_jugadores_posiciones
                                           references posiciones (id)
                                           on delete no action on update cascade
);

insert into jugadores(nombre,fecha_nac,dorsal,id_equipo,id_posicion)
    values  ('Sergio Ramos', '1990-07-03',4,1,4),
            ('Ortuño', '1987-05-12',8,2,13);
