CREATE TABLE kayttaja(
  kayttajaid SERIAL PRIMARY KEY,
  kayttajanimi varchar(50) NOT NULL,
  salasana varchar(32) NOT NULL,
  kayttajataso smallint NOT NULL
);
CREATE TABLE kategoria(
  kategoriaid SERIAL PRIMARY KEY,
  kategorianimi varchar(50) NOT NULL
);
CREATE TABLE keskustelu(
  keskusteluid SERIAL PRIMARY KEY,
  keskusteluotsikko varchar(50) NOT NULL,
  kategoria smallint REFERENCES kategoria ON DELETE CASCADE
);
CREATE TABLE viesti(
  viestiid SERIAL PRIMARY KEY,
  keskustelu smallint REFERENCES keskustelu ON DELETE CASCADE,
  kayttaja smallint REFERENCES kayttaja,
  sisalto varchar(1000) NOT NULL,
  aika timestamptz NOT NULL
);

