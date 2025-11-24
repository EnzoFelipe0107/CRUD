# CRUD 

O Projeto consiste em um CRUD utilizando PHP, MYSQL, HTML, CSS, JS
para facilitar a manipulação e o controle de dados podendo excluir, editar e incluir usuários

## 🛠️ Tecnologias Utilizadas

Este projeto foi desenvolvido utilizando as seguintes tecnologias:

* **Linguagem de Programação:** PHP (para lógica de *backend* e manipulação de dados).
* **Banco de Dados:** MySQL (para armazenamento e gestão de dados).
* **Servidor Local:** XAMPP (ambiente local que inclui Apache, MySQL e PHP).
* **Estrutura da Página:** HTML5 (marcação e estrutura do conteúdo).
* **Estilização:** CSS3 (estilos visuais, cores, layout).
* **Framework CSS:** Bootstrap (para design responsivo e componentes pré-estilizados).

---

## 🎯 Objetivo do Projeto

O projeto foi criado para que o fluxo, manipulação, controle e visualização dos dados seja facilitado e interligado, utilizando uma interface responsiva, fácil e direta

---

## ⚙️ Instalação e Configuração

Para executar este projeto em sua máquina local, siga os passos abaixo:

### Pré-requisitos

Certifique-se de ter o **XAMPP** instalado e configurado corretamente.

### 1. Clonagem do Repositório

git bash
# Clone o projeto para a raiz do diretório htdocs do seu XAMPP.
C:\xampp\htdocs\.git clone [https://github.com/EnzoFelipe0107/CRUD-OPOVO] 

### 2. Configuração do Banco de Dados (MySQL)

1.  Inicie os módulos **Apache** e **MySQL** no painel de controle do XAMPP.
2.  Acesse o **phpMyAdmin** (geralmente em `http://localhost/phpmyadmin`).
3.  Crie um novo banco de dados com o nome: `[usuarios]`.
4.  Importe o arquivo SQL do projeto (que contém a estrutura das tabelas).
     create_table_O_POVO.sql


### 3. Configuração da Conexão PHP

1.  Localize o arquivo de conexão do banco de dados `config.php`  dentro da pasta do projeto.
2.  Edite as seguintes variáveis para corresponderem à sua configuração local:

    ```php
    $servidor = "localhost";
    $usuario = "root"; // Padrão do XAMPP
    $senha = "";       // Padrão do XAMPP
    $banco = "[usuarios]";
    ```

### 4. Execução do Projeto

1.  Certifique-se de que o Apache está rodando no XAMPP.
2.  Abra seu navegador e acesse a URL: `http://localhost/CRUD-OPOVO/PROJETO/index.php`


## 🏗️ Estrutura do Projeto e Fluxo de Criação

### 1. Planejamento e Estrutura Inicial (HTML/CSS)

O projeto começou com a definição da estrutura base em **HTML**. A **Bootstrap** foi integrada logo no início para garantir:

* **Responsividade:** O layout se adapta a diferentes tamanhos de tela.
* **Componentes:** Utilização de *navbars*, formulários e cards do Bootstrap para agilizar o desenvolvimento da interface.

A estilização primária foi feita via classes do Bootstrap, com adições pontuais de **CSS**  para ajustes finos de cor, tipografia e espaçamento.

### 2. Banco de Dados (MySQL)

O **MySQL** foi configurado para armazenar os dados de usuário. A principal tabela criada foi:

* `[usuarios]` contendo :
ID
nome
email
senha
data_nascimento
CPF

### 3. Backend (PHP e Conexão com o Banco)

A **lógica PHP** foi implementada para realizar as operações de **CRUD** (*Create, Read, Update, Delete*):

* **Conexão:** O script de conexão (`conexao.php`) estabeleceu a ponte entre o PHP e o MySQL.
* **Inserção (C):** O PHP capturou os dados do formulário HTML (usando `$_POST` ou `$_GET`) e os inseriu no MySQL via comandos SQL (`INSERT INTO`).
* **Leitura (R):** Foram criados *scripts* para buscar e exibir os dados do MySQL (`SELECT * FROM...`), que foram então exibidos na tela em tabelas ou listas HTML.
* **Atualização (U) e Exclusão (D):** Implementados com comandos SQL (`UPDATE` e `DELETE`) acionados por botões e tratados pelo PHP.

### 4. Ambiente de Desenvolvimento (XAMPP)

O **XAMPP** forneceu o ambiente necessário para testar o código PHP localmente e gerenciar o banco de dados via phpMyAdmin, facilitando a fase de desenvolvimento e depuração.

📄 Principais arquivos 
* **index.php** Página inicial do sistema
* **config.php** Script PHP de conexão com o banco de dados MySQL.
* **novo-usuario.php** Lógica PHP para inserir novos dados (CREATE).
* **listar-usuario.php** Lógica PHP para buscar e exibir dados (READ).
* **editar-usuario.php** Formulário e lógica PHP para atualizar dados (UPDATE).
* **create_table_O_Povo.sql** Arquivo de criação do banco de dados.
* **salvar-usuario.php** Lógica PHP para salvar as mudanças do banco de dados
* **create_table_O_Povo.sql** arquivo para criação da tabela SQL
   
