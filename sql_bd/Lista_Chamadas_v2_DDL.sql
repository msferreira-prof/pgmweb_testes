/* criar bd ou esquema */
CREATE SCHEMA lista_chamadas_v2;

/* conecto ou abro o bd ou esquema */
USE lista_chamadas_v2;

/* tabelas */
/* tabela de professores */
CREATE TABLE professores (
matricula INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(45) NOT NULL,
foto MEDIUMBLOB NULL,
PRIMARY KEY (matricula)
)
DEFAULT CHARACTER SET = utf8;

/* tabela de turmas */
CREATE TABLE turmas (
codigo CHAR(3) NOT NULL,
serie  CHAR(10) NOT NULL,
sala   INT NOT NULL,
hora_inicial TIME NOT NULL,
hora_final TIME NOT NULL,
professores_matricula INT NOT NULL,
PRIMARY KEY (codigo),
CONSTRAINT fk_professores_matricula 
	FOREIGN KEY (professores_matricula)
    REFERENCES professores (matricula)
)    
DEFAULT CHARACTER SET = utf8;

/* tabela de alunos */
CREATE TABLE alunos (
matricula INT NOT NULL AUTO_INCREMENT, 
nome VARCHAR(50) NOT NULL,
turmas_codigo CHAR(3) NULL,
PRIMARY KEY (matricula),
CONSTRAINT fk_turmas_codigo 
	FOREIGN KEY (turmas_codigo)
    REFERENCES turmas (codigo)
)
DEFAULT CHARACTER SET = utf8;

/* tabela de usuarios */
CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(128) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX usuarios_email_idx (email ASC))
DEFAULT CHARACTER SET = utf8;


/* criar indices para as chaves estrangeiras das tabelas */
CREATE INDEX fk_professores_matricula_idx ON turmas (professores_matricula ASC);
CREATE INDEX fk_turmas_codigo_idx ON alunos (turmas_codigo ASC);

/* Exemplos de DROP e ALTER para constraints e tabelas */
/*   
ALTER TABLE turmas 
DROP CONSTRAINT fk_professores_matricula;

ALTER TABLE turmas 
MODIFY COLUMN professores_matricula CHAR(3) NULL;

ALTER TABLE turmas 
ADD CONSTRAINT fk_professores_matricula 
	FOREIGN KEY (professores_matricula)
    REFERENCES professores (matricula)
;
*/

    
    