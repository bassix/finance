# bassix finance

**This is a library written in [PHP 7.4](https://www.php.net/releases/7_4_0.php) for handling finances consisting of prices, money, currencies and taxes.**

To get involved into the development of this project you need to get a local copy of this repository:

```bash
git clone git@github.com:bassix/voucher-service.git
cd voucher-service
```

_**Note:** This project is based on the [GitFlow](http://nvie.com/posts/a-successful-git-branching-model/) branching model and workflow._

## Code quality tools
`
Run [PHPUnit](https://phpunit.de/) tests:

```bash
./vendor/bin/phpunit tests
```

Run [phpstan](https://github.com/phpstan/phpstan) to make statical analyse of the code. (Level from 0 to 7, where 0 is the most loose, 7 is the strongest. 0 is default):

```bash
./vendor/phpstan/phpstan/phpstan analyse --level 7
```

Run [php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) to fix errors in code (use `--dry-run` option only to see errors):

```bash
./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix
```

Documentation and constructor with more detailed information could be found at [https://mlocati.github.io/php-cs-fixer-configurator](https://mlocati.github.io/php-cs-fixer-configurator).
