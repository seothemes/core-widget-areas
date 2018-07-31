# Widget Areas

Register or unregister widget areas through configuration.

## Installation

This component should be installed using Composer, with the command `composer require d2/core-widget-areas`.

## Usage

Within your config file (typically found at `config/defaults.php`), create an array that includes widget areas you would like to register, and another array containing widget areas which should be unregistered. 

If this component is being used to register widget areas in a Genesis child theme then the `genesis_register_widget_area` function will be used to ensure they're given the correct Genesis markup.

Class constants are in place for default Genesis widget areas making it easier to unregister them.

For example:

```php
use D2\Core\WidgetArea;

$d2_widget_areas = [
    WidgetArea::REGISTER   => [
        [
            'id' => 'utility-bar',
            'name' => __( 'Header Utility Bar', 'example-textdomain' ),
            'description' => __( 'Utility bar area appearing above the site header.', 'example-textdomain' ),
        ],
    ],
    WidgetArea::UNREGISTER => [
        WidgetArea::HEADER_RIGHT,
        WidgetArea::SIDEBAR_ALT,
    ],
];

return [
    WidgetArea::class => $d2_widget_areas,
];
 ```

## Load the component

Components should be loaded in your theme `functions.php` file, using the `Theme::setup` static method. Code should run on the `after_setup_theme` hook (or `genesis_setup` if you use Genesis Framework).

```php
add_action( 'after_setup_theme', function() {
    $config = include_once __DIR__ . '/config/defaults.php';
    \D2\Core\Theme::setup( $config );
} );
```
