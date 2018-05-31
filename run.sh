#!/bin/bash

echo Instalando as dependencias da api...........
cd $(pwd)/api && composer install

echo Criando o banco de dados...........
cd $(pwd)/ && touch $(pwd)/database\/database.sqlite

echo Rodando Migrations e Seeds
cd $(pwd)/ && php artisan migrate:refresh --seed

echo Inicializando o serviço da api em background na porta 8000
cd $(pwd)/ && php artisan serve > ../xpto.log & >/dev/null

echo Instalando as dependencias da aplicacao.........
cd ../xpto-app && composer install

echo Inicializando o servico da aplicacao na porta 80
cd $(pwd)/ && php -S localhost:80
