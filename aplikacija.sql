drop database if exists aplikacija;
create database aplikacija default character set utf8;
alter database aplikacija default character set utf8;
use aplikacija;

create table kategorija (
sifra int not null primary key auto_increment,
naziv varchar(20) not null,
brojpolaznika int,
napomena varchar(200),
trener int 
);
create table trening(
sifra int not null primary key auto_increment,
mjesto varchar(20) not null,
vrijeme datetime not null,
kategorija int not null,
clan int,
trener int,
napomena varchar(200)
);
create table clan(
sifra int not null primary key auto_increment,
ime varchar(20) not null,
prezime varchar(20) not null,
oib char(11) not null,
email varchar(20) not null,
mob int not null,
imeroditelja varchar(15),
prezimeroditelja varchar(15),
brojugovora char(6),
placenaclanarina boolean,
kategorija int
);
create table zaposlenik (
sifra int not null primary key auto_increment,
ime varchar(20),
prezime varchar(20),
oib char(11),
email varchar(30),
mob int,
radnomjesto varchar(30),
nadredeni int(1),
ziroracun int,
lozinka int(7),
image varchar (50)
);
create table trener (
sifra int not null primary key auto_increment,
zaposlenik int
);

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




			
		
	


select * from kategorija;
select * from trening;
select * from clan;
select * from zaposlenik;
select * from trener;











