drop database if exists aplikacija1;

create database aplikacija1 default character set utf8;

#c:\xampp\mysql\bin\mysql -uedunova -pedunova --default_character_set=utf8 < C:\xampp\htdocs\summerTask\aplikacija1.sql

use aplikacija1;
create table kategorija (
sifra int not null primary key auto_increment,
naziv varchar(20) not null,
trener int 
);
create table trening(
sifra int not null primary key auto_increment,
mjesto varchar(20) not null,
vrijeme datetime not null,
kategorija int not null,
clan varchar(100),
trener int,
napomena varchar(200)
);
create table clan(
sifra int not null primary key auto_increment,
ime varchar(20) not null,
prezime varchar(20) not null,
oib char(11),
datumrodenja date,
mob char(11),
imeroditelja varchar(15),
prezimeroditelja varchar(15),
kategorija int

);
create table zaposlenik (
sifra int not null primary key auto_increment,
ime varchar(20) not null,
prezime varchar(20) not null,
oib char(11),
mob char(11),
radnomjesto varchar(20) not null,
ziroracun int
);


create table trener (
sifra int not null primary key auto_increment,
zaposlenik int
);
create unique index i_1 on trener(zaposlenik);

create table trening_clan (
trening int not null,
clan int 
);





alter table trening add foreign key (kategorija) references kategorija(sifra);

alter table clan add foreign key (kategorija) references kategorija(sifra);
alter table trener add foreign key (zaposlenik) references zaposlenik(sifra);
alter table kategorija add foreign key (trener) references trener(sifra);


alter table trening add foreign key (trener) references trener (sifra);
alter table trening_clan add foreign key (trening) references trening(sifra);
alter table trening_clan add foreign key (clan) references clan(sifra);

insert into zaposlenik (sifra,ime,prezime,oib,mob,radnomjesto,ziroracun) values
(null,'tomo','Jakopec','62352326174','09874754',2,2345344),
(null,'Franko','Kulesevic','15167215107','09274754',2,2345344),
(null,'Matko','Pejic','42420075120','09874754',2,2345344),
(null,'Igor','Takalic','29146742689','09874754',1,2345344),
(null,'Filip','Pavlovic','41872779570','09874754',1,2345344),
(null,'Danijel','Sugar','10699318727','09874754',1,2345344),
(null,'Andrej','Hofsuster','21293900532','09874754',1,2345344),
(null,'Ivan','Vinkovic','99224160854','09874754',1,2345344),
(null,'Jure Lucian','Boban','10873090543','09874754',1,2345344),
(null,'Nikola','Saric','74205666680','09874754',1,2345344),
(null,'Zlatko','Barat','56457216545','09874754',1,2345344),
(null,'Vladimir','Budac','53097283732','09874754',1,2345344),
(null,'Zvonimir','Milanovic','60525233226','09874754',1,2345344),
(null,'Ivan','Knezevic','07368778055','09874754',1,2345344),
(null,'Petar','Čučković','59497330930','09874754',1,2345344),
(null,'Kruno','Marijanovic','81578727276','09874754',1,2345344);

insert into trener(sifra,zaposlenik) values
(null,1),
(null,2),
(null,3);

insert into kategorija(sifra,naziv,trener) values
(null,'Kadeti',1),
(null,'Juniori',2),
(null,'Seniori',3);

insert into clan (sifra,ime,prezime,oib,datumrodenja,mob,imeroditelja,prezimeroditelja,kategorija) values
(null,'kruno','marijanovic','62352326174','1992-11-11','09874754','miro','marijanovic',1),
(null,'marko','peric','62352326174','2000-11-11','09874754','miro','marijanovic',1),
(null,'bruno','kitarovic','62352326174','2009-11-11','09874754','miro','marijanovic',1),
(null,'ante','severina','62352326174','2007-11-11','09874754','miro','marijanovic',1),
(null,'jozo','marijanovic','62352326174','1992-11-11','09874754','miro','marijanovic',1),
(null,'pero','jozic','62352326174','1992-11-11','09874754','miro','marijanovic',2),
(null,'tomo','rakitic','62352326174','1992-11-11','09874754','miro','marijanovic',2),
(null,'lucas','boban','62352326174','1992-12-11','09874754','miro','marijanovic',2),
(null,'ivan','marijanovic','62352326174','1992-12-11','09874754','miro','marijanovic',2),
(null,'tomislav','marijanovic','62352326174','1992-11-11','09874754','miro','marijanovic',3),
(null,'danijel','marijanovic','62352326174','1992-11-11','09874754','miro','marijanovic',3),
(null,'vjeko','marijanovic','62352326174','1992-11-11','09874754','miro','marijanovic',3),
(null,'borna','marijanovic','62352326174','1992-11-11','09874754','miro','marijanovic',3),
(null,'hrvoje','anic','62352326174','1992-11-11','09874754','miro','marijanovic',3),
(null,'markan','marijanovic','62352326174','1992-11-11','09874754','miro','marijanovic',3),
(null,'ivana','marijanovic','62352326174','1992-11-11','09874754','miro','marijanovic',3);

insert into trening (sifra,mjesto,vrijeme,kategorija) values 
(null,'Glavni teren','2018-10-22 15:30',1),
(null,'Glavni teren','2018-10-23 15:30',1),
(null,'Glavni teren','2018-10-24 15:30',2),
(null,'Glavni teren','2018-10-22 15:30',2),
(null,'Glavni teren','2018-10-23 15:30',3),
(null,'Glavni teren','2018-10-24 15:30',3),
(null,'Glavni teren','2018-10-22 15:30',3);

