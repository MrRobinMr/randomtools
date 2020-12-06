Drop database if exists sklep;

Create database sklep;

use sklep;

create table klienci (
	ID_klienta int not null auto_increment primary key,
	imie varchar(20) not null,
	nazwisko varchar(20) not null,
	haslo text not null,
	email varchar(20) not null,
	pracownik bit
);

create table adresy (
	ID_adresy int not null auto_increment primary key,
	ID_klienta int not null,
	ulica varchar(20) not null,
	nr_budynku varchar(10) not null,
	nr_mieszkania varchar(10) null,
	kod_pocztowy varchar(7) not null,
	miasto char(10) not null,
	kraj char(10) not null
);


create table foto (
	ID_produkty int not null,
	foto text,
	opis varchar(50),
	typ varchar(20)
);


create table  producent (
	ID_producent int not null auto_increment primary key,
	nazwa varchar(20) not null
);

INSERT INTO `producent`(`ID_producent`,`nazwa`)VALUES
	(1,'Bosch'),
	(2,'Dewalt'),
	(3,'Drel'),
	(4,'Yato'),
	(5,'SMART'),
	(6,'Makita'),
	(7,'Stihl'),
	(8,'Metabo');

create table produkty(
	ID_produkty int not null auto_increment primary key,
	nazwa varchar(100) not null,
	ID_kategoria int not null,
	cena double not null,
	na_stanie int not null,
	VAT double not null,
	ID_producent int not null
);


create table kategorie (
	ID_kategoria int not null auto_increment primary key,
	nazwakat varchar(20) not null
);

INSERT INTO `kategorie`(`ID_kategoria`,`nazwa`)VALUES
	(1,'wiertarki'),
	(2,'pilarki'),
	(3,'szlifierki'),
	(4,'wiertła'),
	(5,'agregaty'),
	(6,'tarcze do cięcia drewna z gwoździami'),
	(7,'wkrętarki');

create table status (
	ID_status int not null auto_increment primary key,
	status varchar(20)
);

INSERT INTO `status`(`ID_status`,`status`)VALUES
	(null,'w realizacji'),
	(null,'wysłane'),
	(null,'odebrane'),
	(null,'czeka na opłate');

create table koszyk (
	ID_koszyk int not null auto_increment primary key,
	ID_klienta int not null
);

create table pro_kosz (
	ID_pro_kosz int not null auto_increment primary key,
	ID_produkty int not null,
	ilosc bigint not null,
	ID_koszyk int not null,
	cena double not null
);

create table zamowienia (
	ID_zamowienia int not null auto_increment primary key,
	ID_produkty int not null,
	ID_klienta int not null,
	ID_adresy int not null,
	ID_status int not null,
	ID_pracownicy int not null
);

create table pro_zam (
	ID_pro_zam int not null auto_increment primary key,
	ID_produkty int not null,
	ilosc bigint not null,
	ID_zamowienia int not null,
	cena double not null
);


ALTER TABLE adresy
  ADD CONSTRAINT FOREIGN KEY (ID_klienta) REFERENCES klienci (ID_klienta) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE produkty
  ADD CONSTRAINT FOREIGN KEY (ID_kategoria) REFERENCES kategorie (ID_kategoria) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FOREIGN KEY (ID_producent) REFERENCES producent (ID_producent) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE foto
  ADD CONSTRAINT FOREIGN KEY (ID_produkty) REFERENCES produkty (ID_produkty) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE koszyk
  ADD CONSTRAINT FOREIGN KEY (ID_klienta) REFERENCES klienci (ID_klienta) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE pro_kosz
  ADD CONSTRAINT FOREIGN KEY (ID_produkty) REFERENCES produkty (ID_produkty) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FOREIGN KEY (ID_koszyk) REFERENCES koszyk (ID_koszyk) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE zamowienia
  ADD CONSTRAINT FOREIGN KEY (ID_produkty) REFERENCES produkty (ID_produkty) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FOREIGN KEY (ID_klienta) REFERENCES klienci (ID_klienta) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FOREIGN KEY (ID_adresy) REFERENCES adresy (ID_adresy) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FOREIGN KEY (ID_status) REFERENCES status (ID_status) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FOREIGN KEY (ID_pracownicy) REFERENCES klienci (ID_klienta) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE pro_zam
  ADD CONSTRAINT FOREIGN KEY (ID_produkty) REFERENCES produkty (ID_produkty) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FOREIGN KEY (ID_zamowienia) REFERENCES zamowienia (ID_zamowienia) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO produkty VALUES
	(NULL,'Młotowiertarka BOSCH GBH 2-26 DFR 800 W Walizka',1,715.00,45,0.23,1),
	(NULL,'Pilarka BOSCH UniversalChain 18',2,492.00,12,0.23,1),
	(NULL,'Szlifierka kątowa Bosch GWS 9-125 S Professional',3,288.00,8,0.23,1),
	(NULL,'BOSCH Komplet wierteł metal drewno beton 15 szt',4,32.00,35,0.23,1),
	(NULL,'Wiertarka DEWALT DWD024',1,279.00,13,0.23,2),
	(NULL,'SZLIFIERKA KĄTOWA DeWALT DWE4157',3,260.00,18,0.23,2),
	(NULL,'DWE399 Pilarka Alligator 430mm DEWALT',2,1640.00,5,0.23,2),
	(NULL,'AGREGAT PRĄDOTWÓRCZY JEDNOFAZOWY DEWALT DXGN 4000E AVR',5,5129.10,5,0.23,2),
	(NULL,'Drel Tarcza na szlifierkę do cięcia drewna z gwoździami 125mm CON-DCT-1112',6,20.80,88,0.23,3),
	(NULL,'Drel Tarcza na szlifierkę do cięcia drewna z gwoździami 115mm CON-DCT-1111',6,19.30,90,0.23,3),
	(NULL,'Drel Tarcza do cięcia drewna z gwoździami 76mm CON-DCT-1307',6,15.70,50,0.23,3),
	(NULL,'AGREGAT PRĄDOTWÓRCZY 5500W TRÓJFAZOWY (400V)',5,2479.00,7,0.23,4),
	(NULL,'WIERTARKO-WKRĘTARKA Z UDAREM 1 X BATERIA 18V 2,0AH + ŁADOWARKA',7,329.00,25,0.23,4),
	(NULL,'SZLIFIERKA KĄTOWA 18V 125MM KORPUS BEZ AKUMULATORA',3,177.00,43,0.23,4),
	(NULL,'Pilarka łańcuchowa Yato YT-8489',2,379.00,15,0.23,4),
	(NULL,'Agregat prądotwórczy Smart365 01-3600',5,1259.00,7,0.23,5),
	(NULL,'WIERTŁA DO METALU HSS 0.8MM – 13MM',4,67.00,50,0.23,5),
	(NULL,'WIERTŁA DO BETONU SDS-PLUS -LINIA DUO',4,120.00,15,0.23,5),
	(NULL,'TARCZA DO METALU PŁASKA 115×1,0MM 25SZT',6,64.15,35,0.23,5),
	(NULL,'Wiertarko - wkrętarka akumulatorowa DHP453RFE 18V 3.0Ah Litowo-jonowa',7,989.00,10,00.25,6),
	(NULL,'Młotowiertarka bezprzewodowa DHR241Z 18 V 1.9 J',1,539.00,14,0.23,6),
	(NULL,'Szlifierka kątowa MAKITA 125 mm 18 V DGA504RMJ',3,1599.00,12,0.23,6),
	(NULL,'Pilarka akumulatorowa DUC353Z 2X18V',2,1099.00,18,0.23,6),
	(NULL,'PILARKA SPALINOWA STIHL MS 181, PM3, DŁUGOŚĆ PROWADNICY 35 CM',2,1169.00,5,0.23,7),
	(NULL,'PILARKA SPALINOWA STIHL MS 251 PD, DŁUGOŚĆ PROWADNICY 35 CM',2,1899.00,3,0.23,7),
	(NULL,'AGREGAT PRĄDOTWÓRCZY Z SILNIKIEM HONDA EA3000 (3,0KW 41KG 96DB(A))',5,2800.00,20,0.23,7),
	(NULL,'AGREGAT PRĄDOTWÓRCZY HONDA EU10I (1,0KW 13KG 87DB(A))',5,4155.00,2,0.3,7),
	(NULL,'Wiertarko-wkrętarka akumulatorowa BS 18 LT + ładowarka i akumulatory 1x2Ah 1x4Ah 602102502',7,1199.00 ,14,0.23,8),
	(NULL,'wiertarka bezudarowa BE 75-16 750W 600580000',7,1001.73,18,0.23,8),
	(NULL,'Metabo Młotowiertarka udarowa KHE 76 - 600341000',1, 3343.15,4,0.23,8);
