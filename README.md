#Task Manager

###Requisitos
- Docker
- Composer

###Comandos para reproduzir o ambiente

Instale as dependências do Laravel
```shell
$ composer install
```
Instale e compile as dependências do projeto
```shell
$ npm install
$ npm run prod
```
Configure as variáveis de ambiente
```shell
$ cp .env.example .env
$ php artisan key:generate
```

Execute as instâncias do projeto utilizando o Laravel Sail
```shell
$ ./vendor/bin/sail up -d
```

Execute as migrations do banco de dados
```shell
$ ./vendor/bin/sail artisan migrate
```

Acesse pelo http://localhost:80
