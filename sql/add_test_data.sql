INSERT INTO kayttaja(kayttajanimi,salasana,kayttajataso) VALUES('Janne','Hurdur',3);
INSERT INTO kategoria(kategorianimi) VALUES('Yleiset aiheet');
INSERT INTO keskustelu(keskusteluotsikko,kategoria) VALUES('Yleistä löpinää',(SELECT MIN(kategoriaid) from kategoria) );
INSERT INTO viesti(sisalto,kayttaja,keskustelu,aika) VALUES('Täällä löpistään',(SELECT MIN(kayttajaid) from kayttaja),(SELECT MIN(keskusteluid) from keskustelu),now());
