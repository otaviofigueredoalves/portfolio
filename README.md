# 👨‍💻 Meu Portfólio Dinâmico (Dynamic Developer Portfolio)

Uma plataforma de portfólio customizada e um Sistema de Gerenciamento de Conteúdo (CMS) completo, desenvolvidos do zero para expor meus projetos e habilidades. 

Este projeto não é apenas uma vitrine, mas uma demonstração prática de **Engenharia de Software**, abordando arquitetura limpa, segurança de rotas e manipulação de banco de dados relacional.

---

## 🎯 O Desafio e a Solução

A maioria dos portfólios são páginas estáticas ou usam CMS prontos como o WordPress. O objetivo deste projeto foi construir uma **arquitetura proprietária**, aplicando os fundamentos por trás dos grandes frameworks web do mercado (como Laravel e Symfony).

O sistema conta com um **Painel Administrativo Privado** onde eu posso, dinamicamente, gerenciar todo o conteúdo exibido na vitrine (projetos, tecnologias e ordenação), garantindo total flexibilidade sem a necessidade de alterar código.

---

## 🛠️ Stack Tecnológica

O projeto foi construído utilizando as seguintes tecnologias e conceitos:

*   **Linguagem Core:** PHP Puro (Orientado a Objetos - OOP)
*   **Padrão de Arquitetura:** MVC (Model-View-Controller)
*   **Banco de Dados:** MySQL (Consultas otimizadas com `LEFT JOIN` e ordenação via SQL).
*   **Front-end:** HTML5, CSS3, JavaScript e Bootstrap.
*   **Gerenciamento de Ambiente:** Utilização de arquivos `.env` para proteção de credenciais sensíveis (variáveis de ambiente).
*   **Roteamento:** Sistema de roteamento customizado (simulando rotas de frameworks modernos).

---

## 🚀 Principais Features (Destaques de Engenharia)

### 1. Painel Administrativo com CRUD Completo
*   Um painel seguro com operações de **Create, Read, Update, Delete** para Projetos e Tecnologias.
*   **Sistema de Ordenação:** Lógica no banco de dados para permitir a ordenação customizada dos projetos na vitrine principal (`ORDER BY ordem ASC, id DESC`), não dependendo da data de criação.

### 2. Segurança e Controle de Acesso (RBAC)
*   Proteção de rotas utilizando verificações de Sessão.
*   Prevenção contra *Session Fixation* utilizando `session_regenerate_id(true)`.
*   As senhas no banco de dados são criptografadas utilizando os algoritmos nativos e seguros do PHP (`password_hash` e `password_verify`).
*   Implementação de "Ninja Mode": Tentativas de acesso não autorizadas a rotas de autenticação retornam Erro 404 para ofuscar o endpoint contra bots.

### 3. Otimização de Consultas (Hidratação de Objetos)
*   Para lidar com relacionamentos Muito-Para-Muitos (Projetos e Múltiplas Tecnologias), foi implementada uma query com `LEFT JOIN` e uma lógica de agrupamento/hidratação no Back-end (Model). Isso previne duplicidade e minimiza as requisições ao banco de dados.

---

## 👁️ Modo Vitrine (Demonstração para Recrutadores)

Para permitir que Tech Leads e recrutadores interajam com o sistema sem comprometer os dados de produção, implementei um **Usuário Visitante (Guest)**.

*   **Acesso:** O visitante consegue fazer login, acessar o painel administrativo e visualizar a estrutura interna e relatórios.
*   **Segurança:** As ações de alteração no banco de dados (POST, PUT, DELETE) são bloqueadas no Back-end caso a sessão detectada seja a do visitante.

Para testar o painel administrativo, utilize as credenciais abaixo:
*   **Login:** `visitante@guest`
*   **Senha:** `123456`

*(Atenção: As funções de adicionar, editar ou excluir projetos estarão desabilitadas nesta conta).*

---

## 💻 Como Rodar o Projeto Localmente
*(Atenção: futuramente criarei migrations para construir as tabelas através do phinx).*
Se você deseja clonar e rodar o projeto na sua máquina:

1.  Clone este repositório:
    
```bash
    git clone [https://github.com/SEU_USUARIO/NOME_DO_REPOSITORIO.git](https://github.com/SEU_USUARIO/NOME_DO_REPOSITORIO.git)
    ```
2.  Crie um banco de dados MySQL chamado `seu_banco`.
3.  Importe o arquivo `db.sql` (disponível na pasta raiz) para criar as tabelas e o usuário visitante.
4.  Copie o arquivo `.env.example` para `.env` e configure as credenciais do seu banco de dados:
    ```env
    DB_HOST=localhost
    DB_NAME=seu_banco
    DB_USER=root
    DB_PASS=sua_senha
    ```
5.  Inicie o servidor PHP embutido na pasta pública (ou use Apache/Nginx via XAMPP/Docker):
    ```bash
    php -S localhost:8000 -t public
    ```
6.  Acesse `http://localhost:8000` no seu navegador.
