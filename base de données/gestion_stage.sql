create database if not exists gestion_stag;

use gestion_stag;

create table filiére(
    idFiliere int(4) auto_increment primary key,
    nomFiliere VARCHAR(50),
    niveau VARCHAR(50)
);

create table stagiaire(
    idStagiaire int(4) auto_increment primary key,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    civilite VARCHAR(1),
    photo VARCHAR(100),
    idFiliere int(4)
    
);

create table utilisateur(
    iduser int(4) auto_increment primary key,
    login VARCHAR(50),
    email VARCHAR(255),
    role VARCHAR(1),
    etat int(1),
    pwd varchar(255)
);

ALTER table stagiaire add CONSTRAINT foreign key(idfiliere) references filiere(idFiliere);

INSERT into stagiaire(nom,prenom,civilite,photo,idFiliere) VALUES 
('nguimtsop','Arnold','M','brice.jpg',1),
('moh mezette','arnaud','M','Desert.jpg',2),
('Salim','Omar','M','hortensias.jpg',3),
('Timi','Martias','M','tensias.jpg',2),
('Nasima','Fatima','F','hortensias.jpg',3),
('Tekom','Gilles','M','bricearnold.jpg',1),
('Salim','Omar','M','hortensias.jpg',3); 

INSERT into filiere(nomFiliere,niveau) VALUES 
('TSDI','TS'),
('TSGE','TS'),
('TGI','T'),
('TSRI','TS'),
('TSMI','TS'),
('TCE','T'),
('TSDI','TS'),
('TSGE','TS'),
('TGI','T'),
('TSRI','TS'),
('TSMI','TS'),
('TCE','T'),
('TSDI','TS'),
('TSGE','TS'),
('TGI','T'),
('TSRI','TS'),
('TSMI','TS'),
('TCE','T'),
('TSDI','TS'),
('TSGE','TS'),
('TGI','T'),
('TSRI','TS'),
('TSMI','TS'),
('TCE','T')
;