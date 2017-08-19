

###  War-O in PHP

* A code exercise in an effort to kick the tires on functional PHP.
* This is not a complete implementation of War-O as described [here](https://github.com/peidevs/WarO_Java/blob/master/Rules.md), but it is close. 
* Rather than merely port other OO examples, this example is experimental:
    * `main` is a State monad
    * classes are mostly simple fields 
    * immutable state 
* TODO:
    * implement strategies
    * shuffle a deck, deal to players / kitty
    * consider an IO monad for logging

### Info

* uses [this](https://hub.docker.com/r/phpunit/phpunit/) Docker image
    * as of AUG 2017, uses PHPUnit 6.0.x and PHP 7.0
* uses [Composer](https://getcomposer.org)
* style somewhat inspired by [Functional PHP](https://www.packtpub.com/application-development/functional-php) using [php-functional](https://github.com/widmogrod/php-functional) library

### Composer

* install Composer
* run the following:

```
php ~/path/composer.phar install
```

### Composer Sidebar

* the `composer.json` was originally populated with (tremendous # of  brain cells were lost trying to figure this out):

```
php ~/path/composer.phar require widmogrod/php-functional:dev-master
php ~/path/composer.phar require phpunit/phpunit
```

### Docker Setup

* install Docker
* in Docker window, `cd` to appropriate directory, then:

<pre>
docker pull phpunit/phpunit
</pre>

### To run tests

* `./run_tests.sh`

