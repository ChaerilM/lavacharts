# Lavacharts 4.0
[![Total Downloads](https://img.shields.io/packagist/dt/khill/lavacharts.svg?style=plastic)](https://packagist.org/packages/khill/lavacharts)
[![License](https://img.shields.io/packagist/l/khill/lavacharts.svg?style=plastic)](http://opensource.org/licenses/MIT)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=plastic)](https://php.net/)
[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/kevinkhill/lavacharts?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
[![PayPal](https://img.shields.io/badge/paypal-donate-yellow.svg?style=plastic)](https://paypal.me/kevinkhill)

Lavacharts is a graphing / chart library for PHP5.6+ that wraps the Google Chart API.

Stable:
[![Current Release](https://img.shields.io/github/release/kevinkhill/lavacharts.svg?style=plastic)](https://github.com/kevinkhill/lavacharts/releases)
[![Build Status](https://img.shields.io/travis/kevinkhill/lavacharts/3.1.svg?style=plastic)](https://travis-ci.org/kevinkhill/lavacharts)
[![Coverage Status](https://img.shields.io/coveralls/kevinkhill/lavacharts/3.1.svg?style=plastic)](https://coveralls.io/r/kevinkhill/lavacharts?branch=3.1)

Dev:
[![Development Release](https://img.shields.io/badge/release-dev--master-brightgreen.svg?style=plastic)](https://github.com/kevinkhill/lavacharts/tree/master)
[![Build Status](https://img.shields.io/travis/kevinkhill/lavacharts/master.svg?style=plastic)](https://travis-ci.org/kevinkhill/lavacharts)
[![Coverage Status](https://img.shields.io/coveralls/kevinkhill/lavacharts/master.svg?style=plastic)](https://coveralls.io/r/kevinkhill/lavacharts?branch=master)


## Package Features
- **Updated!** Global package configuration
  - Options include: `auto_run`, `locale`, `datetime_format`, `timezone`, `maps_api_key`

- **Updated!** New DataInterface for creating custom DataProviders.
  - [JoinedDataTable](https://github.com/kevinkhill/lavacharts/blob/4.0/src/DataTables/JoinedDataTable.php) Is an example of one of the usages for DataInterface. 
  
- **Updated!**
  - Lava.js Event handling now can be given context if the default of "window" doesn't work for you.

- **Updated!**
  - Lava.js has been refactored to reduced the amount of promise chaining and event handling to increase speed and for simplicity.

- Any option for customizing charts that Google supports, Lavacharts should as well.
 - Visit [Google's Chart Gallery](https://developers.google.com/chart/interactive/docs/gallery) for details on available option
 
- Custom JavaScript module for interacting with charts client-side
  - AJAX data + option reloading
  - Fetching charts
  - Events integration
- Column Formatters and Roles

- Framework Integrations for [Laravel](https://github.com/kevinkhill/lavacharts/blob/4.0/src/Laravel/LavachartsServiceProvider.php), [Symfony](https://github.com/kevinkhill/lavacharts/tree/4.0/src/Symfony/Bundle/Resources), [Angular](https://github.com/kevinkhill/lavacharts/blob/4.0/javascript/src/angular/LavaJsService.ts)
- Template Extensions for [Blade](https://github.com/kevinkhill/lavacharts/blob/4.0/src/Laravel/BladeTemplateExtensions.php), [Twig](https://github.com/kevinkhill/lavacharts/blob/4.0/src/Symfony/Bundle/Twig/LavachartsExtension.php)
  
- [Carbon](https://github.com/briannesbitt/Carbon) support for date/datetime/timeofday columns

- Now supporting **22** Charts!
  - Annotation, Area, Bar, Bubble, Calendar, Candlestick, Column, Combo, Gantt, Gauge, Geo, Histogram, Line, Org, Pie, Sankey, Scatter, SteppedArea, Table, Timeline, TreeMap, and WordTree!


#### For complete documentation, please visit [lavacharts.com](http://lavacharts.com/)
#### Upgrade guide: [Migrating from 2.5.x to 3.0.x](https://github.com/kevinkhill/lavacharts/wiki/Upgrading-from-2.5-to-3.0)
#### For contributing, a handy guide [can be found here](https://github.com/kevinkhill/lavacharts/blob/master/.github/CONTRIBUTING.md)

---

## Installing
In your project's main `composer.json` file, add this line to the requirements:
```json
"khill/lavacharts": "~4.0"
```

Run Composer to install Lavacharts:
```bash
$ composer update
```

## Framework Agnostic
If you are using Lavacharts with Silex, Lumen or your own Composer project, that's no problem! Just make sure to:
`require 'vendor/autoload.php';` within you project and create an instance of Lavacharts: `$lava = new Khill\Lavacharts\Lavacharts;`


## Laravel
To integrate Lavacharts into Laravel, a ServiceProvider has been included.

### Laravel 5.x
Register Lavacharts in your app by adding these lines to the respective arrays found in `config/app.php`:
```php
<?php
// config/app.php

// ...
'providers' => [
    // ...

    Khill\Lavacharts\Laravel\LavachartsServiceProvider::class,
],

// ...
'aliases' => [
    // ...
    
    'Lava' => Khill\Lavacharts\Laravel\LavachartsFacade::class,
]
```


### Laravel 4.x
Register Lavacharts in your app by adding these lines to the respective arrays found in `app/config/app.php`:

```php
<?php
// app/config/app.php

// ...
'providers' => array(
    // ...

    "Khill\Lavacharts\Laravel\LavachartsServiceProvider",
),

// ...
'aliases' => array(
    // ...
    
    'Lava' => "Khill\Lavacharts\Laravel\LavachartsFacade",
)
```


## Symfony
The package also includes a Bundle for Symfony to enable Lavacharts as a service that can be pulled from the Container.

### Add Bundle
Add the bundle to the registerBundles method in the AppKernel, found at `app/AppKernel.php`:
```php
<?php
// app/AppKernel.php

class AppKernel extends Kernel
{
    // ..
    
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Khill\Lavacharts\Symfony\Bundle\LavachartsBundle(),
        );
    }
}
```
### Import Config
Add the service definition to the `app/config/config.yml` file
```yaml
imports:
  # ...
  - { resource: "@LavachartsBundle/Resources/config/services.yml"
```


# Usage
The creation of charts is separated into two parts:
First, within a route or controller, you define the chart, the data table, and the customization of the output.

Second, within a view, you use one line and the library will output all the necessary JavaScript code for you.

## Basic Example
Here is an example of the simplest chart you can create: A line chart with one dataset and a title, no configuration.

### Controller
Setting up your first chart.

#### Data
```php
$data = $lava->DataTable();

$data->addDateColumn('Day of Month')
     ->addNumberColumn('Projected')
     ->addNumberColumn('Official');

// Random Data For Example
for ($a = 1; $a < 30; $a++) {
    $rowData = [
      "2017-4-$a", rand(800,1000), rand(800,1000)
    ];

    $data->addRow($rowData);
}
```

Arrays work for datatables as well...
```php
$data->addColumns([
    ['date', 'Day of Month'],
    ['number', 'Projected'],
    ['number', 'Official']
]);
```

Or you can `use \Khill\Lavacharts\DataTables\DataFactory` [to create DataTables in another way](https://gist.github.com/kevinkhill/0c7c5f6211c7fd8f9658)

#### Chart Options
Customize your chart, with any options found in Google's documentation. Break objects down into arrays and pass to the chart.
```php
$lava->LineChart('Stocks', $data, [
    'title' => 'Stock Market Trends',
    'animation' => [
        'startup' => true,
        'easing' => 'inAndOut'
    ],
    'colors' => ['blue', '#F4C1D8']
]);
```

#### Output ID
The chart will needs to be output into a div on the page, so an html ID for a div is needed.
Here is where you want your chart `<div id="stocks-div"></div>`
 - If no options for the chart are set, then the third parameter is the id of the output:
```php
$lava->LineChart('Stocks', $data, 'stocks-div');
```
 - If there are options set for the chart, then the id may be included in the options:
```php
$lava->LineChart('Stocks', $data, [
    'elementId' => 'stocks-div'
    'title' => 'Stock Market Trends'
]);
```
 - The 4th parameter will also work:
```php
$lava->LineChart('Stocks', $data, [
    'title' => 'Stock Market Trends'
], 'stocks-div');
```


## View
Pass the main Lavacharts instance to the view, because all of the defined charts are stored within, and render!
```php
<?= $lava->render('LineChart', 'Stocks', 'stocks-div'); ?>
```

Or if you have multiple charts, you can condense theh view code withL
```php
<?= $lava->renderAll(); ?>
```


# Changelog
The complete changelog can be found [here](https://github.com/kevinkhill/lavacharts/wiki/Changelog)
