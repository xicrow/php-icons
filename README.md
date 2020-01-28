# PHP Icons

## Extending
Instead of using the classes in this repository directly, you are encouraged to implement your own extension like so:  
```php
class FA extends \Xicrow\PhpIcons\FontAwesome5 {}

echo FA::Icon(FA::Icon_Thumbs_Up, FA::Modifier_Lg);
```

This will ease your own implementation, since you determine what the class will be called, and also makes it easier for you to change provider in the future.  

It also makes it easy to implement shortcuts for commonly used icons:  
```php
class FA extends \Xicrow\PhpIcons\FontAwesome5 {
    public static function CreateIcon(): self
    {
        return static::Icon(static::Icon_Plus_Circle)->attribute('style', 'color: green;');
    }

    public static function EditIcon(): self
    {
        return static::Icon(static::Icon_Pencil)->attribute('style', 'color: blue;');
    }

    public static function DeleteIcon(): self
    {
        return static::Icon(static::Icon_Trash)->attribute('style', 'color: red;');
    }
}

echo FA::CreateIcon();
```

## TODO
- Figure out if it's possible to get a list of FontAwesome PRO icons
- Maybe add icon generator and class for the following icon libraries:
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
    - Devicons
        - https://vorillaz.github.io/devicons
        - https://github.com/vorillaz/devicons

## License
Copyright &copy; 2020 Jan Ebsen
Licensed under the MIT license.
