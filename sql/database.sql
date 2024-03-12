CREATE TABLE cars (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  marca VARCHAR(100) NOT NULL,
  modelo VARCHAR(100) NOT NULL,
  color VARCHAR(100) NOT NULL,
  refmotor VARCHAR(100) NOT NULL,
  matricula VARCHAR(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO cars (marca, modelo, color, refmotor,matricula) VALUES('Seat','Marbella','Rojo','AJN','S1234AA');
INSERT INTO cars (marca, modelo, color, refmotor,matricula) VALUES('Volkwagen','Golf','Verde','JTV','1749FDC');
INSERT INTO cars (marca, modelo, color, refmotor,matricula) VALUES('Citroen','C5','Negro','JBD','1957FTR');
INSERT INTO cars (marca, modelo, color, refmotor,matricula) VALUES('Mercedes','E350d','Azul','DFT','1894CDB');
INSERT INTO cars (marca, modelo, color, refmotor,matricula) VALUES('BMW','335i','Rojo','NKT','1936KHT');
INSERT INTO cars (marca, modelo, color, refmotor,matricula) VALUES('Audi','Quattro','Rojo','KGT','S2343AA');