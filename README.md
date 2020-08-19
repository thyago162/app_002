# Descrição
1. O frontend foi feito com Vue.js
2. Foi criado dois testes no feature para testar o CRUD
3. Foi Criado uma camada de repository e uma de service
4. Foi criado duas notificações que são chamadas quando um produto é criado e outra quando o produto é atualizado
5. As validações de formulário estão no services de cada uma das classes
6. Foi criado o relacionamento entre tabelas no model de acordo com Laravel 7
7. Para os testes com email utilizei minha conta no mailtrap, as configurações foram colocadas no .env

## INSTALAÇÃO DAS DEPENDÊNCIAS
1. composer install
2. npm install

## CONFIGURAÇÕES MÍNIMAS
1. cp .env-example .env
2. php artisan key:generate

## APÓS CONFIGURAR O BANCO DE DADOS
3. php artisan migration:fresh --seed

## RODAR A APLICAÇÃO
1. npm run dev
2. php artisan serve

## RODAR OS TESTES
1. php artisan test


