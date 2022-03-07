-- para criar uma base
CREATE DATABASE escola_php;

-- para selecionar a base
USE escola_php;

-- para criar uma tabela
create table alunos (
    id int primary key auto_increment,
    nome varchar(150) not null,
    email varchar(150) not null unique
);

-- para inserir na tabela criada
insert into alunos (nome, email) 
values 
('Bruno', 'bruno@senac.com.br'),
('Breno', 'breno@senac.com.br'),
('Elayne', 'elayne@senac.com.br'),
('Celia', 'celia@senac.com.br');

drop table alunos;

select*from alunos;