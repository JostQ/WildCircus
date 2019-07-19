# Wild Circus

## Before Installation

Make sure to have Composer and Yarn installed.

Composer : https://getcomposer.org/

Yarn : https://yarnpkg.com/en/

## Installation

1. Clone the project : `$ git clone https://github.com/JostQ/WildCircus.git`

2. Install the Symfony modules with composer : `$ composer install`

3. Install Webpack : `$ yarn install`

## How to prepare the application

Copy .env file : `$ cp .env .env.local`

Open .env.local file and edit the line `DATABASE_URL=` with your information

If you didn't create your DB, use the command :
```
$ php bin/console doctrine:database:create
```

Send to your database the commands SQL :
```
$ php bin/console doctrine:schema:update --dump-sql

$ php bin/console doctrine:schema:update --force
```

Send the fixtures to your DB :
```
$ php bin/console doctrine:fixtures:load
```

## Run your server

Build your application :
```
$ npm run-script build
```

Run the server PHP :
```
$ php bin/console s:r
```

## Congratulation !

![](https://image.noelshack.com/fichiers/2019/29/5/1563542557-logo-200x200.png)

## Sources
Backlog : https://image.noelshack.com/fichiers/2019/29/5/1563540819-pb.jpg

Mock-up : https://image.noelshack.com/fichiers/2019/29/5/1563540812-maquette.jpg

DB : https://image.noelshack.com/fichiers/2019/29/5/1563540818-model-db.jpg
