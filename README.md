Browser Capabilities PHP Project
================================

This is a userland replacement for PHP's native `get_browser()` function, which is _officially supported_ by the Browser
Capabilities Project.

[![CI](https://github.com/browscap/browscap-php/actions/workflows/continuous-integration.yml/badge.svg)](https://github.com/browscap/browscap-php/actions/workflows/continuous-integration.yml)

Installation
------------

Run the command below to install via Composer

```shell
composer require browscap/browscap-php 
```

Then you may identify the current user agent this way:

```php
$cache = new \MatthiasMullie\Scrapbook\Psr16\SimpleCache($doctrineFileCache); // or maybe any other PSR-16 compatible caches
$logger = new \Monolog\Logger('name'); // or maybe any other PSR-3 compatible logger

$browscap = new \BrowscapPHP\Browscap($cache, $logger);
$info = $browscap->getBrowser();
```

If you want to autoupdate the used cache, we recommend a separate cron job that calls the command listed above.

BC breaks in version 7.0.x
-----------------------------

```
 - [BC] BrowscapPHP\Command\UpdateCommand was marked "@internal"
 - [BC] BrowscapPHP\Command\FetchCommand was marked "@internal"
 - [BC] BrowscapPHP\Command\ConvertCommand was marked "@internal"
 - [BC] BrowscapPHP\Command\CheckUpdateCommand was marked "@internal"
 - [BC] BrowscapPHP\Command\ParserCommand was marked "@internal"
 - [BC] BrowscapPHP\Helper\Filesystem was marked "@internal"
```

Setup Examples
--------------

```php
$fileCache = new \League\Flysystem\Local\LocalFilesystemAdapter($cacheDir);
$filesystem = new \League\Flysystem\Filesystem($fileCache);
$cache = new \MatthiasMullie\Scrapbook\Psr16\SimpleCache(
    new \MatthiasMullie\Scrapbook\Adapters\Flysystem($filesystem)
);

$logger = new \Monolog\Logger('name');

$bc = new \BrowscapPHP\Browscap($cache, $logger);
$result = $bc->getBrowser();
```

NOTE: You may use any other cache which implements
the [PSR-16](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-16-simple-cache.md) interface.

## Using the full browscap.ini file

```php
$bc = new \BrowscapPHP\BrowscapUpdater();
$bc->update(\BrowscapPHP\Helper\IniLoaderInterface::PHP_INI_FULL);
```

## Setting up a proxy configuration

If you are behind a proxy or need a spcific configuration, you have to set up a client instance.
See into the [Guzzle documentation](http://docs.guzzlephp.org/en/latest/) for more information about this.

```php
$proxyConfig = [
    'proxy' => [
        'http'  => 'tcp://localhost:8125',
        'https' => 'tcp://localhost:8124',
    ],
];
$client = new \GuzzleHttp\Client($proxyConfig);
$bcu = new BrowscapUpdater();
$bcu->setClient($client);
```

Usage Examples
--------------

## Taking the user agent from the global $_SERVER variable

```php
$bc = new \BrowscapPHP\Browscap();
$current_browser = $bc->getBrowser();
```

## Using a sample useragent

```php
$bc = new \BrowscapPHP\Browscap($cache, $logger);
$current_browser = $bc->getBrowser($the_user_agent);
```

Issues and feature requests
---------------------------

Please report your issues and ask for new features on the GitHub Issue Tracker
at https://github.com/browscap/browscap-php/issues

Please report incorrectly identified User Agents and browser detect in the browscap.ini
file here: https://github.com/browscap/browscap/issues
