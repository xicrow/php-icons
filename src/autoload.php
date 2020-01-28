<?php
spl_autoload_register(function ($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = [
            'Xicrow\\PhpIcons\\BaseIcon'              => './BaseIcon.php',
            'Xicrow\\PhpIcons\\Bootstrap3'            => './Bootstrap3.php',
            'Xicrow\\PhpIcons\\Bootstrap3Glyphicons'  => './Bootstrap3Glyphicons.php',
            'Xicrow\\PhpIcons\\Devicons1'             => './Devicons1.php',
            'Xicrow\\PhpIcons\\Devicons1Icons'        => './Devicons1Icons.php',
            'Xicrow\\PhpIcons\\FontAwesome4'          => './FontAwesome4.php',
            'Xicrow\\PhpIcons\\FontAwesome4Icons'     => './FontAwesome4Icons.php',
            'Xicrow\\PhpIcons\\FontAwesome4Modifiers' => './FontAwesome4Modifiers.php',
            'Xicrow\\PhpIcons\\FontAwesome5'          => './FontAwesome5.php',
            'Xicrow\\PhpIcons\\FontAwesome5Icons'     => './FontAwesome5Icons.php',
            'Xicrow\\PhpIcons\\FontAwesome5Modifiers' => './FontAwesome5Modifiers.php',
        ];
    }

    if (isset($classes[$class])) {
        /** @noinspection PhpIncludeInspection */
        require __DIR__ . $classes[$class];
    }
}, true, false);
