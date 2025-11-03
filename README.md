<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/THPL28/thpl/actions"><img src="https://github.com/THPL28/thpl/workflows/CI/badge.svg" alt="CI/CD Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-brightgreen" alt="License"></a>
</p>

# THPL - 🌐 Website Oficial Institucional

O **Website Oficial da THPL** é um projeto institucional e de serviços focado em estabelecer uma **presença digital profissional e robusta** para a empresa. Desenvolvido com **PHP e Laravel**, o site garante performance, segurança e uma **experiência de usuário (UX) moderna**.

O projeto é mantido através de um pipeline de **CI/CD (Integração e Deploy Contínuos)** para garantir que todas as atualizações sejam testadas e publicadas automaticamente.

---

## ✨ Principais Objetivos

O desenvolvimento deste projeto foi guiado pelos seguintes pilares:

* **Exposição Profissional:** Apresentar os **serviços da THPL** de forma clara, otimizada e com foco em conversão.
* **UX/UI Moderna:** Entregar uma interface intuitiva, rápida e totalmente **responsiva** em todos os dispositivos.
* **Performance e Segurança:** Implementar boas práticas do ecossistema Laravel/PHP para garantir um sistema escalável e seguro.
* **Automação de Deploy:** Manter o ambiente de produção sempre atualizado e estável via **CI/CD automatizado**.

---

## 💻 Tecnologias de Ponta

Um stack moderno e robusto foi escolhido para o projeto:

### Backend & Framework
* **PHP 8+:** Linguagem de programação principal.
* **Laravel 10:** Framework full-stack, utilizado para API, rotas e lógica de negócio.
* **Blade Templates:** Motor de template nativo para views dinâmicas.
* **MySQL:** Banco de dados relacional para persistência de dados.

### Frontend & Estilo
* **Tailwind CSS / Bootstrap:** Utilizado para desenvolvimento rápido e layouts totalmente responsivos.
* **JavaScript (Alpine.js / Vue.js):** Para interatividade de frontend, componentes dinâmicos e SPA (opcional).

### DevOps & Ferramentas
* **GitHub Actions:** Configuração de pipeline para CI/CD automatizado (`.github/workflows/ci.yml`).
* **Composer / NPM:** Gerenciamento de dependências.

---

## 🛠 Funcionalidades Implementadas

O projeto inclui diversas funcionalidades essenciais para um website institucional:

* **Página Inicial (Landing Page):** Apresentação da empresa e chamada para ação (CTA).
* **Seção de Serviços:** Páginas detalhadas para cada solução oferecida.
* **Formulário de Contato:** Funcional e seguro, com envio de e-mail integrado.
* **Dashboard Administrativo (Opcional):** Área restrita para gerenciamento de conteúdo via CMS.
* **Autenticação Completa:** Sistema de login, registro e recuperação de senha.
* **SEO Básico:** Otimização de meta tags e estrutura para melhor indexação em buscadores.
* **Integração:** Links para redes sociais e potencial integração com Google Analytics.

---

## ⚙️ CI/CD e Estrutura de Código

O fluxo de trabalho de desenvolvimento é automatizado via GitHub Actions:

### Pipeline CI/CD
* **CI (Integração Contínua):** Executa testes unitários, testes de integração e verificações de qualidade (linting, padrões) em cada `push` para garantir a integridade do código.
* **CD (Deploy Contínuo):** Realiza o deploy automático para o servidor de produção após a aprovação de todos os testes no branch principal.

### Estrutura de Diretórios

```text
thpl/
├── app/                # Lógica principal (Modelos, Controladores, Serviços)
├── database/           # Migrations, Seeds e Factories
├── public/             # Assets compilados e ponto de entrada
├── resources/          # Views Blade e assets (JS, CSS)
├── routes/             # Definição de rotas (web, api)
├── tests/              # Testes automatizados (Unitários e Feature)
└── .github/workflows/  # Configuração de CI/CD

## 🚀 Instalação Local

### Siga os passos abaixo para configurar o projeto em seu ambiente local:

1. Clone o Repositório
Bash

git clone git@github.com:THPL28/thpl.git
cd thpl
2. Configuração e Dependências
Crie seu arquivo de ambiente (.env) e instale as dependências.

Bash

cp .env.example .env
composer install
npm install
npm run dev
3. Setup do Laravel
Gere a chave da aplicação e configure o banco de dados (certifique-se de configurar o .env com suas credenciais).

Bash

php artisan key:generate
php artisan migrate --seed
4. Execução
Inicie o servidor de desenvolvimento do Laravel.

Bash

php artisan serve
O site estará acessível em http://127.0.0.1:8000.

## 🧪 Testes Automatizados
O projeto utiliza testes unitários e de feature para garantir a qualidade do código.

Os testes estão localizados em tests/.

O GitHub Actions executa os testes automaticamente em cada push.

Para executar os testes localmente, use o comando:

php artisan test

🛡 Segurança e Boas Práticas

### Segurança
Proteção contra vulnerabilidades comuns (CSRF, XSS, injeção SQL).

Senhas criptografadas com bcrypt.

Uso de Middleware de autenticação e autorização.

Boas Práticas
Adesão ao Padrão MVC (Model-View-Controller).

Uso de Repositórios e Services para separar a lógica de negócio dos Controllers.

Versionamento Semântico e commits seguindo Conventional Commits.

## 🤝 Contribuição
Contribuições são muito bem-vindas! Para contribuir com melhorias ou novas funcionalidades:

Fork o repositório.

Crie uma nova branch de feature: git checkout -b feature/nome-da-feature

Faça commit das suas alterações (idealmente seguindo Conventional Commits).

Faça push e abra um Pull Request.

## 📌 Licença
Este projeto é open-source e está licenciado sob a Licença MIT. Consulte o arquivo LICENSE para mais detalhes.

## 📞 Contato
Fique à vontade para entrar em contato:

Email: thpldevweb@gmail.com

LinkedIn: [Tiago Looze](https://www.linkedin.com/in/tiago-looze-b1a0001b7/)

GitHub: @THPL28

<p align="center"> Desenvolvido em Laravel PHP por Tiago Looze </p>