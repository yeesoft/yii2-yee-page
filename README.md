# yii2-yee-page

##Yee CMS - Page Module

####Backend module for managing pages 

This module is part of Yee CMS (based on Yii2 Framework).

Page module lets you easily create static pages on your site. 

Installation
------------

- Install [Yee Media Module](https://github.com/yeesoft/yii2-yee-media) if it is not installed yet.

- Either run

```
composer require --prefer-dist yeesoft/yii2-yee-page "~0.1.0"
```

or add

```
"yeesoft/yii2-yee-page": "~0.1.0"
```

to the require section of your `composer.json` file.

- Run migrations

```php
yii migrate --migrationPath=@vendor/yeesoft/yii2-yee-page/migrations/
```

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

Screenshots
-------  

[Flickr - Yee CMS Post Module](https://www.flickr.com/photos/134050409@N07/sets/72157656324703598)
