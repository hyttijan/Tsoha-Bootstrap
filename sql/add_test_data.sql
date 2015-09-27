INSERT INTO kayttaja(kayttajanimi,salasana,kayttajataso) VALUES('tuntematon','******',4);
INSERT INTO kayttaja(kayttajanimi,salasana,kayttajataso) VALUES('Testikayttaja','salasana',3);
INSERT INTO kategoria(kategorianimi) VALUES('Yleiset aiheet');
INSERT INTO keskustelu(keskusteluotsikko,kategoria) VALUES('Yleistä löpinää',(SELECT MIN(kategoriaid) from kategoria) );
INSERT INTO viesti(sisalto,kayttaja,keskustelu,aika) VALUES('Täällä löpistään',(SELECT MIN(kayttajaid) from kayttaja),(SELECT MIN(keskusteluid) from keskustelu),now());
