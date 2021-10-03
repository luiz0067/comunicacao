create table empresa(
id int not null auto_increment primary key,
nome varchar(50) not null,
senha varchar(50) not null
);
create table usuario (
	codigo int auto_increment not null primary key, 
	usuario varchar (50) not null,
	senha varchar (50) not null,
	empresa int not null
);
create table categoria (
	codigo int auto_increment not null primary key, 
	nome varchar (50) not null,
	empresa int not null
);
create table projetos (
	codigo int auto_increment not null primary key, 
	nome varchar (50) not null,
	categoria int not null,
	descricao varchar (50) not null,
	empresa int not null
);
create table fotos (
	codigo int auto_increment not null primary key,
	produto int not null,
	nome varchar (50) not null,
	imagem varchar (50) not null,
	link varchar (50) not null,
	empresa int not null
);

create table novidades(
codigo int not null primary key auto_increment,
titulo  varchar(50) not null,
descricao varchar(50)not null,
imagem varchar(50) not null,
empresa int not null
);
create table fotos_novidades (
	codigo int auto_increment not null primary key,
	novidades int not null,
	nome varchar (50) not null,
	imagem varchar (50) not null,
	link varchar (50) not null,
	empresa int not null
);

create table depoimento(
codigo int not null primary key auto_increment,
titulo  varchar(50) not null,
descricao varchar(50)not null,
imagem varchar(50) not null,
empresa int not null
);
create table fotos_depoimento(
	codigo int auto_increment not null primary key,
	depoimento int not null,
	nome varchar (50) not null,
	imagem varchar (50) not null,
	link varchar (50) not null,
	empresa int not null
);

ALTER TABLE projetos 
ADD CONSTRAINT FK_projetos_categoria 
FOREIGN KEY FK_projetos_categoria (categoria)
REFERENCES categoria (codigo);

ALTER TABLE fotos 
ADD CONSTRAINT FK_fotos_projetos 
FOREIGN KEY FK_fotos_projetos (projetos)
REFERENCES projetos (codigo);

ALTER TABLE fotos_depoimento
ADD CONSTRAINT FK_fotos_depoimento_depoimento 
FOREIGN KEY FK_fotos_depoimento_depoimento (depoimento)
REFERENCES depoimento (codigo);

ALTER TABLE fotos_novidades
ADD CONSTRAINT FK_fotos_novidades_novidades 
FOREIGN KEY FK_fotos_novidades_novidades (novidades)
REFERENCES novidades (codigo);

ALTER TABLE usuario
ADD CONSTRAINT FK_usuario_produtos
FOREIGN KEY FK_usuario_empresa (empresa)
REFERENCES empresa(id);

ALTER TABLE categoria
ADD CONSTRAINT FK_categoria_produtos
FOREIGN KEY FK_categoria_empresa (empresa)
REFERENCES empresa(id);

ALTER TABLE fotos
ADD CONSTRAINT FK_fotos_empresa
FOREIGN KEY FK_fotos_empresa(empresa)
REFERENCES empresa(id);

ALTER TABLE fotos_depoimento
ADD CONSTRAINT FK_fotos_depoimento_empresa
FOREIGN KEY FK_fotos_depoimento_empresa(empresa)
REFERENCES empresa(id);

ALTER TABLE fotos_novidades
ADD CONSTRAINT FK_fotos_novidades_empresa
FOREIGN KEY FK_fotos_novidades_empresa (empresa)
REFERENCES empresa (id);

ALTER TABLE novidades
ADD CONSTRAINT FK_novidades_empresa
FOREIGN KEY FK_novidades_empresa (empresa)
REFERENCES empresa (id);

ALTER TABLE depoimento
ADD CONSTRAINT FK_depoimento_empresa
FOREIGN KEY FK_depoimento_empresa (empresa)
REFERENCES empresa (id);

ALTER TABLE projetos
ADD CONSTRAINT FK_produtos_empresa
FOREIGN KEY FK_produtos_empresa (empresa)
REFERENCES empresa (id);
