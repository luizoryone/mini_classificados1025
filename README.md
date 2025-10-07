# 🚀 Mini Classificados SENAI

[![Repositório no GitHub](https://img.shields.io/badge/GitHub-luizoryone%2Fmini__classificados1025-blue?style=for-the-badge&logo=github)](https://github.com/luizoryone/mini_classificados1025.git)

## 📝 Sobre o Projeto

Este projeto é um sistema simples de classificados online, desenvolvido como exercício prático e **inspirado na funcionalidade básica de plataformas como OLX e Mercado Livre**.

O objetivo foi criar uma aplicação que, mesmo em sua simplicidade, mantenha uma **boa estrutura de código e segurança fundamental**. Ele permite que usuários cadastrem e visualizem anúncios de produtos, utilizando um ambiente de desenvolvimento local.

## 🛡️ Segurança e Estrutura

* **Proteção contra Injeção de SQL:** Todas as consultas ao banco de dados são tratadas para prevenir ataques de injeção de SQL.
* **Segurança no Login (Hash de Senha):** As senhas dos usuários são armazenadas no banco de dados utilizando funções de *hash* seguras, garantindo que as credenciais não fiquem expostas em texto puro.

## 🎯 Objetivos de Aprendizado

* Implementar um sistema de **Autenticação** básico (Login e Logout) usando Sessões em PHP.
* Dominar operações de **CRUD** (Create, Read, Update, Delete) em PHP com MySQL.
* Estruturar um banco de dados relacional (Usuário, Anúncio, Categoria).
* **Aplicar conceitos de segurança**, como a prevenção de injeção de SQL e o uso de `hash` para senhas.
* Configurar e utilizar o ambiente de desenvolvimento local **XAMPP**.

## ✨ Funcionalidades

| Tela/Ação | Funcionalidade | Descrição |
| :--- | :--- | :--- |
| **Tela Inicial (Classificados SENAI)** | Visualização | Mostra todos os anúncios cadastrados. |
| **Login / Sair** | Autenticação | Controle de acesso ao sistema com senhas seguras (hash). |
| **Criar Anúncio** | Cadastro | Permite o **cadastro de produtos** após o login. |
| **Meus Anúncios** | Gerenciamento | Área do usuário para ver, editar e excluir seus anúncios. |

## 🛠️ Tecnologias e Requisitos

* **Ambiente de Servidor:** **XAMPP** (Necessário para rodar o Apache e o MySQL/MariaDB).
* **Linguagem Backend:** PHP.
* **Banco de Dados:** MySQL/MariaDB (Gerenciado via phpMyAdmin).
* **Frontend:** HTML5, CSS3.

## ⚙️ Estrutura do Banco de Dados

O projeto utiliza um banco de dados relacional com as seguintes tabelas principais:

| Tabela | Função | Campos Chave |
| :--- | :--- | :--- |
| `usuario` | Armazena dados de login. | `id`, `nome`, `email`, `senha` (com hash) |
| `categoria` | Define os tipos de produtos. | `id`, `nome` |
| `anuncio` | Armazena os classificados. | `id`, `titulo`, `descricao`, `preco`, `id_usuario` (FK), `id_categoria` (FK) |

## 🚀 Como Executar o Projeto Localmente

Siga os passos abaixo para rodar a aplicação utilizando o **XAMPP**.

### Pré-requisitos

Certifique-se de que você tem o **XAMPP** instalado e que os módulos **Apache** e **MySQL** estão ativos.

### 1. Clonar o Repositório

Use o link fornecido para clonar o projeto:

```bash
git clone [https://github.com/luizoryone/mini_classificados1025.git](https://github.com/luizoryone/mini_classificados1025.git)
cd mini_classificados1025


