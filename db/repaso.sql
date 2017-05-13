drop table if exists aulas cascade;

create table aulas
(
    id       bigserial    constraint pk_aulas primary key,
    den_aula varchar(255) not null
);

insert into aulas (den_aula)
    values ('P7'),
           ('P10');

drop table if exists ordenadores cascade;

create table ordenadores
(
    id         bigserial     constraint pk_ordenadores primary key,
    marca_ord  varchar(255),
    modelo_ord varchar(255),
    foto       text,
    aula_id    bigint        not null constraint fk_ordenadores_aulas
                             references aulas (id)
                             on delete no action on update cascade
);

insert into ordenadores (marca_ord, modelo_ord, foto, aula_id)
    values ('Sony', 'Vaio','https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Sony_VGN-C90S.jpg/800px-Sony_VGN-C90S.jpg', 1),
           ('IBM', '8088','http://vignette1.wikia.nocookie.net/videojuego/images/2/26/IBM_PC_modelo_8088.jpg/revision/latest?cb=20140503035503', 2);

drop table if exists dispositivos cascade;

create table dispositivos
(
    id           bigserial     constraint pk_dispositivos primary key,
    marca_disp   varchar(255),
    modelo_disp  varchar(255),
    foto         text,
    ordenador_id bigint        constraint fk_dispositivos_ordenadores
                               references ordenadores (id)
                               on delete no action on update cascade,
    aula_id      bigint        constraint fk_dispositivos_aulas
                               references aulas (id)
                               on delete no action on update cascade,
    constraint ck_lugar_valido check ((ordenador_id is null and aula_id is not null)
                                   or (ordenador_id is not null and aula_id is null))
);

insert into dispositivos (marca_disp, modelo_disp, foto, ordenador_id, aula_id)
    values ('Seagate', 'Barracuda 1TB', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Airy_by_CnMemory%2C_external_hard_disk-3187.jpg/330px-Airy_by_CnMemory%2C_external_hard_disk-3187.jpg', 1, null),
           ('Logitech', 'K120', 'https://images-na.ssl-images-amazon.com/images/G/01/electronics/detail-page/B003ELVLKU_K120_TOP_US.jpg', 2, null),
           ('Ratón', 'Superguay', 'http://www.redusers.com/noticias/wp-content/uploads/2010/06/rat-cyborg-de-la-hostiaaaaa.jpg', 2, null),
           ('nVIDIA', 'GTX480', 'http://www.legitreviews.com/images/reviews/1258/gtx480_slide.jpg', null, 2);

drop table if exists registro_ord cascade;

create table registro_ord
(
    id           bigserial   constraint pk_registro_ord primary key,
    ordenador_id bigint      not null constraint fk_registro_ord_ordenadores
                                      references ordenadores (id)
                                      on delete no action on update cascade,
    origen_id    bigint      not null constraint fk_registro_ord_origen
                                      references aulas (id)
                                      on delete no action on update cascade,
    destino_id   bigint      not null constraint fk_registro_ord_destino
                                      references aulas (id)
                                      on delete no action on update cascade,
    created_at   timestamptz not null default current_timestamp,
    constraint ck_lugares_distintos check (origen_id != destino_id)
);

drop table if exists registro_disp cascade;

create table registro_disp
(
    id              bigserial   constraint pk_registro_disp primary key,
    dispositivo_id  bigint      not null constraint fk_registro_disp_dispositivos
                                         references dispositivos (id)
                                         on delete no action on update cascade,
    origen_ord_id   bigint      references ordenadores (id),
    origen_aula_id  bigint      references aulas (id),
    destino_ord_id  bigint      references ordenadores (id),
    destino_aula_id bigint      references aulas (id),
    created_at      timestamptz not null default current_timestamp,
    check ((origen_ord_id is null and origen_aula_id is not null) or
           (origen_ord_id is not null and origen_aula_id is null)),
    check ((destino_ord_id is null and destino_aula_id is not null) or
           (destino_ord_id is not null and destino_aula_id is null))
);

create view v_dispositivos as
   select d.*,
          coalesce(
              a.den_aula,
              coalesce(o.marca_ord, '') || ' ' || coalesce(o.modelo_ord, '')
          ) as ubicacion
     from dispositivos d
left join aulas a on d.aula_id = a.id
left join ordenadores o on d.ordenador_id = o.id;

drop table if exists usuarios cascade;

create table usuarios (
  id         bigserial   constraint pk_usuarios primary key,
  nombre     varchar(20) not null constraint uq_usuario_unico unique,
  password   char(32)    not null
);

insert into usuarios (nombre, password)
    values ('admin', md5('admin')), ('selene', md5('selene'));
