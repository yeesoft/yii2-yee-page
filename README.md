# yii2-yee-page

##Yee CMS - Page Module

####Backend module for managing pages 

This module is part of Yee CMS (based on Yii2 Framework).

Page module lets you easily create static pages on your site. 

Installation
------------

Either run

```
composer require --prefer-dist yeesoft/yii2-yee-page "*"
```

or add

```
"yeesoft/yii2-yee-page": "*"
```

to the require section of your `composer.json` file.

Configuration
------
- In your backend config file

```php
'modules'=>[
	'page' => [
		'class' => 'yeesoft\page\PageModule',
	],
],
```

- Run migrations

```php
yii migrate --migrationPath=@vendor/yeesoft/yii2-yee-page/migrations/
```

Screenshots
-------  

[Flickr - Yee CMS Post Module](https://www.flickr.com/photos/134050409@N07/sets/72157656324703598)
