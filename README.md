![alt tag](https://avatars.githubusercontent.com/u/4144954?s=200&v=4 "Encryptor")

Cart Challenge
=======================
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

## Install

You can install `BE take-home coding challenge` From Start Your Base Url / `Install`:

```
Ex: http://localhost/Takehome/install/
```

After Installation Must Be Redirect To `index.php` Root Folder to see Records once u install in first time
in `config/condif.php`
define `INSTALLED` will be `1`

## OR

see Live Version From Here [LiveProject](https://twitter.com/yahongie)

## Specs and Project roots

``````
--TakeHome
   ----Commands
      ---createCartCommand.php
      ---createProductCommand.php
   ----config
     ---config.php
     ---db.php
   ----Includes
     ---FactoryDB.php
     ---helper.php
   ----install
     ---index.php
   ----themes
   ----vendor
   --.htaccess
   --coder
   --cart.sql
   --composer.json
   ---composer.lock
   ---composer.phar
   ---index.php
   --Relations Schema.png
``````

My Guideline in My Project To Create Task

``````
- Require Composer lib To Create Command Line
    "php": "^7.3|^8.0",
    "symfony/console": "2.6.7",
    "ext-pdo": "*"
- Create Install Schema To Migrate DB queries with relations from cart.sql !important
- Connect To Mysql DB With PDO Functions,
- Define config db connect and flag installed 0 first time.
- add Bootstrab css & js to display table record for carts.
- add #!/usr/bin/env php  called coder in my project to start command.
``````
>My Schema DB
![alt tag](Relations%20Schema.png "DB")


### Run & GO

actually i add 2 command in my task u can see in `coder` file

`````````
$application->add(new createCartCommand());

$application->add(new  createProductCommand());

to see helper command excute this command 
> php coder

to run command to create product :
> php coder createProduct Iphone --price="100" --rate="3" --weight="2.39"
and all fields required *
to run command create product cart :
> php coder createCart  --product="Blouse","T-shirt","Pants","Sweatpants","Jacket","Shoes"
and must be spreated by ',' to multible product
`````````

# OR
----------------
your Can see above table button u can execute command from it .
> [RefTask](https://github.com/Edfa3ly/take-home-coding-challenge/blob/master/back-end.md#q-i-got-confused-on-how-to-calculate-an-item-price-and-its-shipping-and-vat)


#License By:
-----------------------------------------------------

####

$ Follow ME
> Developed by Dev Ahmed S. Ahmed [coder79](https://twitter.com/yahongie) ❤


