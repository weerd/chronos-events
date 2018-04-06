<h1 align="center">Chronos Events</h1>


## Introduction
**Chronos Events** is a package for Laravel 5 that provides scaffolding and functionality for working with calendar events in a CMS-like nature.


## Installation

### Step 1: Composer
From the command line, run:

```shell
$ composer require weerd/chronos-events
```

### Step 2: Service Provider

This package has support for Laravel's package auto-discovery, so after installing with composer the package's service provider will automagically ✨ be registered and enabled.

However, if your project has package auto-discovery disabled, or you prefer to add the service provider manually, within your Laravel project, open `config/app.php` and, at the end of the `providers` array, append:

```php
'providers' => [
    // ...

    /*
     * Application Service Providers...
     */
    // ...

    /*
     * Post-Application Package Service Providers...
     */
    Weerd\ChronosEvents\ChronosEventsServiceProvider::class,
],
```

### Step 3: Migrate
Next, run the migration to add the `calendar_events` table to your database:

```shell
$ php artisan migrate
```



## Customization
_more to come..._
