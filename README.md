# Widget Areas

Register, unregister and display widget areas through configuration.

## Installation

This component should be installed using Composer, with the command `composer require d2/core-widget-areas`.

## Usage

Within your config file (typically found at `config/defaults.php`), create an array that includes widget areas you would like to register, and another array containing widget areas which should be unregistered. 

If this component is being used to register widget areas in a Genesis child theme then the `genesis_register_widget_area` function will be used to ensure they're given the correct Genesis markup.

Additional settings are provided to allow the automatic output of widget areas. Use the `WidgetArea::LOCATION` key inside the `WidgetArea::REGISTER` array to hook the widget area to a specific location, and use the `WidgetArea::BEFORE` and `WidgetArea::AFTER` keys to specify the before and after markup - closures are accepted. The `WidgetArea::PRIORITY` key is also provided to change the priority of the widget area and it's location.

Class constants are in place for default Genesis widget areas making it easier to unregister them.

For example:

```php
use D2\Core\WidgetArea;

$d2_widget_areas = [
    WidgetArea::REGISTER   => [
        [
            WidgetArea::ID          => 'utility-bar',
            WidgetArea::NAME        => __( 'Utility Bar', 'example-textdomain' ),
            WidgetArea::DESCRIPTION => __( 'Utility bar appearing above the site
            header.', 'example-textdomain' ),
            WidgetArea::BEFORE      => '<div class="utility-bar">',
            WidgetArea::AFTER       => '</div>',
            WidgetArea::LOCATION    => 'genesis_before_header',
            WidgetArea::PRIORITY    => 5,
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
