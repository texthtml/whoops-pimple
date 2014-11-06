# Whoops-Pimple

Integrates the Whoops library into Pimple [whoops](https://github.com/filp/whoops)

**whoops** is an error handler base/framework for PHP. Out-of-the-box, it
provides a pretty error interface that helps you debug your web projects, 
but at heart it's a simple yet powerful stacked error handling system.

[![Latest Stable Version](https://poser.pugx.org/texthtml/whoops-pimple/v/stable.svg)](https://packagist.org/packages/texthtml/whoops-pimple)
[![License](https://poser.pugx.org/texthtml/whoops-pimple/license.svg)](https://packagist.org/packages/texthtml/whoops-pimple)
[![Total Downloads](https://poser.pugx.org/texthtml/whoops-pimple/downloads.svg)](https://packagist.org/packages/texthtml/whoops-pimple)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/texthtml/whoops-pimple/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/texthtml/whoops-pimple/?branch=master)

## Module installation

In your project root folder

1. `composer require texthtml/whoops-pimple ~1.0`
2. In your Pimple container configuration, register the WhoopsServiceProvider:

```php
$container->register(new WhoopsServiceProvider);
```

-----

![Whoops!](http://i.imgur.com/xiZ1tUU.png)
