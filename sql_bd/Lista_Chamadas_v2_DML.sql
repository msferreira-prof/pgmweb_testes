/* conecto ou abro o bd ou esquema */
USE lista_chamadas_v2;

/* inserir dados na tabela professores */
INSERT INTO professores (matricula, nome) VALUES (DEFAULT, "Joana D'Arc");
INSERT INTO professores (matricula, nome) VALUES (DEFAULT, 'Einstein Jones');
INSERT INTO professores (matricula, nome) VALUES (DEFAULT, 'Maria Joana Silva');
INSERT INTO professores (matricula, nome) VALUES (DEFAULT, 'Augusto Joana');
INSERT INTO professores (matricula, nome) VALUES (DEFAULT, 'Wolverine Mesquita');

/* inserir dados na tabela usuarios */
-- senha 'joao23#2021'
-- valor da senha gravado corresponde a funcao hash('sha256', 'joao23#2021') para o senha informada
INSERT INTO usuarios (id, nome, email, senha) VALUES (DEFAULT, 'joao23', 'joao23@abc.com', '1269dae00e6d9ec936d3e407a651ceddc6c870fdac5e9ef21b5a6087495de3fa');
-- senha 'maria15#2021'
-- valor da senha gravado corresponde a funcao hash('sha256', 'maria15#2021') para o senha informada
INSERT INTO usuarios (id, nome, email, senha) VALUES (DEFAULT, 'maria15', 'maria15@abc.com', 'ff6441499177c96a996a9da4783b3513c12a72c5ce7b1fbdb976788acd7eb830');


/* seleciona dados na tabela professores */
SELECT matricula, nome FROM professores;

SELECT * 
FROM professores
WHERE matricula >= 10
  AND matricula <= 12
/*  matricula BETWEEN 10 AND 12 */
/*
    matricula < 8 
  AND nome like '%Joana%'
*/
;

/* apaga os dados de uma tabela ( MUITO CUIDADO AO USAR E COMO USAR!!!) */
DELETE FROM professores
WHERE matricula = 1;
