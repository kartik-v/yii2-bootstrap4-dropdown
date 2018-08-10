yii2-bootstrap4-dropdown
========================

[![Stable Version](https://poser.pugx.org/kartik-v/yii2-bootstrap4-dropdown/v/stable)](https://packagist.org/packages/kartik-v/yii2-bootstrap4-dropdown)
[![Unstable Version](https://poser.pugx.org/kartik-v/yii2-bootstrap4-dropdown/v/unstable)](https://packagist.org/packages/kartik-v/yii2-bootstrap4-dropdown)
[![License](https://poser.pugx.org/kartik-v/yii2-bootstrap4-dropdown/license)](https://packagist.org/packages/kartik-v/yii2-bootstrap4-dropdown)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-bootstrap4-dropdown/downloads)](https://packagist.org/packages/kartik-v/yii2-bootstrap4-dropdown)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-bootstrap4-dropdown/d/monthly)](https://packagist.org/packages/kartik-v/yii2-bootstrap4-dropdown)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-bootstrap4-dropdown/d/daily)](https://packagist.org/packages/kartik-v/yii2-bootstrap4-dropdown)

Enhanced Bootstrap 4 dropdown widget for Yii2 framework with nested submenu support.

## Demo
You can see detailed [documentation and demos](http://demos.krajee.com/bootstrap4-dropdown) on usage of this extension.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

> NOTE: Check the [composer.json](https://github.com/kartik-v/yii2-bootstrap4-dropdown/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

Either run

```
$ php composer.phar require kartik-v/yii2-bootstrap4-dropdown "@dev"
```

or add

```
"kartik-v/yii2-bootstrap4-dropdown": "@dev"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Dropdown Solo Button

Usage of `kartik\bs4dropdown\Dropdown` widget as a standalone dropdown button.

```php
<?php 
use \yii\helpers\Html;
use kartik\bs4dropdown\Dropdown;
?>
<div class="dropdown">
    <?php
        echo Html::button('Dropdown Button', [
           'id' => 'dropdownMenuButton',
           'class' => 'btn btn-secondary dropdown-toggle'
           'data-toggle' => 'dropdown',
           'aria-haspopup' => 'true',
           'aria-expanded' => 'false'
        ]);
        echo Dropdown::widget([
            'items' => [
                ['label' => 'Section 1', 'url' => '/'],
                ['label' => 'Section 2', 'url' => '#'],
                [
                     'label' => 'Section 3', 
                     'items' => [
                         ['label' => 'Section 3.1', 'url' => '/'],
                         ['label' => 'Section 3.2', 'url' => '#'],
                         [
                             'label' => 'Section 3.3', 
                             'items' => [
                                 ['label' => 'Section 3.3.1', 'url' => '/'],
                                 ['label' => 'Section 3.3.2', 'url' => '#'],
                             ],
                         ],
                     ],
                 ],
            ],
            'options' => ['aria-labelledby' => 'dropdownMenuButton']
        ]);
    ?>
</div>
```

### Dropdown Menu NavBar

Usage of `kartik\bs4dropdown\Dropdown` widget with Bootstrap 4 `NavBar`.

```php
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;
use kartik\bs4dropdown\Dropdown;

NavBar::begin(['brandLabel' => 'NavBar Test']);
echo Nav::widget([
    'items' => [
        ['label' => 'Home', 'url' => ['/site/index']],
        [
            'label' => 'Sections', 
            'items' => [
                ['label' => 'Section 1', 'url' => '/'],
                ['label' => 'Section 2', 'url' => '#'],
                [
                     'label' => 'Section 3', 
                     'items' => [
                         ['label' => 'Section 3.1', 'url' => '/'],
                         ['label' => 'Section 3.2', 'url' => '#'],
                         [
                             'label' => 'Section 3.3', 
                             'items' => [
                                 ['label' => 'Section 3.3.1', 'url' => '/'],
                                 ['label' => 'Section 3.3.2', 'url' => '#'],
                             ],
                         ],
                     ],
                 ],
            ],
            'dropDownOptions' => ['aria-labelledby' => 'sectionsMenu'],
            'linkOptions' => [
                'id' => 'sectionsMenu',
                'class' => "nav-link dropdown-toggle{$active1}", 
                'title' => 'Krajee Dropdown Sections',
                'role' => 'button',
                'aria-haspopup' => 'true',
                'aria-expanded' => 'false'
            ]
        ],
        ['label' => 'About', 'url' => ['/site/about']],
    ],
    'dropdownClass' => Dropdown::classname(), // use the custom dropdown
    'options' => ['class' => 'navbar-nav mr-auto'],
]);
NavBar::end();
```


## License

**yii2-bootstrap4-dropdown** is released under the BSD-3-Clause License. See the bundled `LICENSE.md` for details.