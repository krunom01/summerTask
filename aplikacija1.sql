drop database if exists aplikacija1;

create database aplikacija1 default character set utf8;

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




			
		
	













