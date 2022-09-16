# PHP Icons

## Installation
The recommended way to install is through Composer.

```
composer require xicrow/php-icons
```

## Usage

Depending on what icons you are using (or want to use), implement the icon class of your choice:

```php
// FontAwesome 4
echo \Xicrow\PhpIcons\FontAwesome4::Icon(\Xicrow\PhpIcons\FontAwesome4::Icon_Thumbs_Up);
```

```html
<i class="fa fa-thumbs-up"></i>
```

```php
// FontAwesome 5
echo \Xicrow\PhpIcons\FontAwesome5::Icon(\Xicrow\PhpIcons\FontAwesome5::Icon_Thumbs_Up);
```

```html
<i class="fas fa-thumbs-up"></i>
```

For now, we'll just use the `BaseIcon` class, to show usages.

Basic usage, show an icon:

```php
echo BaseIcon::Icon(ICON_IDENTIFIER);
```

```html
<span class="ICON_IDENTIFIER"></span>
```

Apply one or more modifiers (not all icon packs support modifiers):

```php
echo BaseIcon::Icon(ICON_IDENTIFIER, ICON_MODIFIER, ICON_MODIFIER);
```

```html
<span class="ICON_IDENTIFIER ICON_MODIFIER ICON_MODIFIER"></span>
```

Modifiers can also be chained from the icon:

```php
echo BaseIcon::Icon(ICON_IDENTIFIER)
    ->modify(ICON_MODIFIER)
    ->modify(ICON_MODIFIER)
;
```

```html
<span class="ICON_IDENTIFIER ICON_MODIFIER ICON_MODIFIER"></span>
```

Attributes for the icon can also be set by chaining:

```php
echo BaseIcon::Icon(ICON_IDENTIFIER)
    ->modify(ICON_MODIFIER)
    ->modify(ICON_MODIFIER)
    ->attribute('title', 'Nifty help text')
    ->attribute('style', 'color: blue;')
;
```

```html
<span class="ICON_IDENTIFIER ICON_MODIFIER ICON_MODIFIER" title="Nifty help text" style="color: blue;"></span>
```

Untill the icon is rendered (either through the `BaseIcon::render()` method or other to-string triggers like `echo`), it is possible to add modifiers and attributes to the
icon.

```php
// Made-up constants
$oStatusIcon = BaseIcon::Icon(BaseIcon::Icon_Bullet, BaseIcon::Modifier_Size_X2);
// Looping a resultset
foreach ($arrResults as $oResult) {
    // Clone the status icon, set color from result, and render
    echo (clone $oStatusIcon)->attribute('style', 'color: '.$oResult->strStatusColor.';');
}
```

## Extending

Instead of using the classes in this repository directly, you are encouraged to implement your own extension like so:

```php
class FA extends \Xicrow\PhpIcons\FontAwesome5 {}

echo FA::Icon(FA::Icon_Thumbs_Up, FA::Modifier_Lg);
```

This will ease your own implementation, since you determine what the class will be called and also makes it easier for you to change provider in the future.

It also makes it easy to implement shortcuts for commonly used icons:

```php
class FA extends \Xicrow\PhpIcons\FontAwesome5 {
    public static function IconCreate(): self
    {
        return static::Icon(static::Icon_Plus_Circle)->attribute('style', 'color: green;');
    }

    public static function IconEdit(): self
    {
        return static::Icon(static::Icon_Pencil)->attribute('style', 'color: blue;');
    }

    public static function IconDelete(): self
    {
        return static::Icon(static::Icon_Trash)->attribute('style', 'color: red;');
    }
}

echo FA::IconCreate();
```

## Supported icon packs

Currently, there are generators and classes for the following icon packs:

- Bootstrap 3 Glyphicons
- Devicons
- FontAwesome 4
- FontAwesome 5 (free)

> Generators are used to create the constants for icons (and modifiers) for each icon pack, these generators will mostly be able to generate constants for every specific
> version of the icon pack, thereby supporting exactly the version you are using.
>
> Classes are simply the implementation of the specific icon pack, that is using the generated icon (and modifier) constants, and implementing a render method specific for
> that icon pack.

## TODO

- Maby generate Interfaces for all versions of icon packs ?
    - Will this clutter too much ?..
    - If done, they should be within their own separate namespace
        - `src/FontAwesome4/FontAwesome4_0_0Icons` (or something like that)
- Figure out if it's possible to get a list of FontAwesome 5 PRO icons
    - Their public accessible list of icons is, of course, only the free icons
- Ideas for new icon generators/classes:
    - Glyphicons
        - https://www.glyphicons.com
    - IcoMoon
        - https://icomoon.io
        - https://github.com/Keyamoon/IcoMoon-Free
    - Ionicons
        - https://ionicons.com
        - https://github.com/ionic-team/ionicons
    - Material
        - https://material.io/resources/icons
    - Icofont
        - https://icofont.com
    - Icons8
        - https://icons8.com/icons
        - https://icons8.com/line-awesome
        - https://github.com/icons8/line-awesome
    - Typicons
        - https://www.s-ings.com/typicons
        - https://github.com/stephenhutchings/typicons.font
    - Microns
        - https://www.s-ings.com/projects/microns-icon-font
        - https://github.com/stephenhutchings/microns

## License

Copyright &copy; 2022 Jan Ebsen
Licensed under the MIT license.
