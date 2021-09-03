Descargado, ajecutar lo siguientes, si esta en linux favor agregar la palabra sudo al principio de cada comando

yarn install
composer install
php bin/console doctrine:database:create (para crear la bd)
php bin/console doctrine:schema:update --force (para crear tablas y columnas)
puedes ejecutar estos comandos tambien para la migracion de la data php bin/console make:migration php bin/console doctrine:migrations:migrate
yarn encore dev, si lo tiene en produccion agregar yarn encore prod
php bin/console doctrine:fixtures:load (para crear data en las tablas)