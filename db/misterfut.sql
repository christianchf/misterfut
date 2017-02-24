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
    values ('christian','christianhf.chf@gmail.com', crypt('christian', gen_salt('bf', 13)));
