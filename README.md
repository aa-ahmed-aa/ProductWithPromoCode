## Description
This is a simple explanation for a product and promocode demo

### Explanation
we have two tables one for Products and PromoCodes and we will join the two tables to get the product prices according to promocode woth the high weight

### Requiremets
- php7.4 (with xdebug enabled - optional for running the code coverage)
- symfony cli
- composer

### Install
```shell script
$ cp .env.example .env
$ php bin/console doctrine:database:create --env=dev
$ php bin/console doctrine:schema:update --force --env=dev
$ php bin/console doctrine:fixture:load --env=dev --no-interaction
$ symfony server:start
```
Endpoint

> https://localhost:8000/product?page=1&limit=LIMIT

Replace the limit with the imit you want  


### Testing
Before you start
```shell script
$ php bin/console doctrine:database:create --env=test
$ php bin/console doctrine:schema:update --force --env=test
$ php bin/console doctrine:fixture:load --env=test --no-interaction
```
to run the tests
```shell script
$ php ./vendor/bin/phpunit
```

### Coverage
<p align="center">
    <img src="https://github.com/aa-ahmed-aa/ProductWithPromoCode/blob/master/1.png" alt="Coverage is awesome"/>
</p>

To Run the coverage in cli mode
```shell script
$ php ./vendor/bin/phpunit --coverage-html coverage/html
```
