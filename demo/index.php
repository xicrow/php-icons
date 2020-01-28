<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

include '../src/autoload.php';

use Xicrow\PhpIcons\BaseIcon;
use Xicrow\PhpIcons\Bootstrap3;
use Xicrow\PhpIcons\Devicons1;
use Xicrow\PhpIcons\FontAwesome4;
use Xicrow\PhpIcons\FontAwesome5;

function renderIcon(BaseIcon $oIcon): string
{
    $strHtml = '';
    $strHtml .= '<pre style="margin: 5px 0; padding: 10px; background-color: #EEE; tab-size: 4;">' . htmlentities($oIcon->render()) . '</pre>';
    $strHtml .= $oIcon->render();

    return $strHtml;
}

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Xicrow\PhpIcons - Demo</title>
</head>
<body>
<?php
// General
if (false) {
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>';
    echo renderIcon(
    	// Get icon instance for specific icon identifier (can also take list of modifiers)
        FontAwesome4::Icon(FontAwesome4::Icon_Thumbs_Up)
	        // Add modifiers
            ->modify(FontAwesome4::Modifier_5x)
            ->modify(FontAwesome4::Modifier_Flip_Vertical)
            ->modify(FontAwesome4::Modifier_Border)
	        // Add attributes
            ->attribute('title', 'Click me !')
            ->attribute('style', 'color: blue; cursor: help;')
            ->attribute('onclick', 'alert(\'You clicked me ! :D\');')
            ->attribute('data-is-icon', true)
            ->attribute('data-is-font-awesome', true)
    );
}

// Bootstrap 3
if (false) {
	echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">';
    echo renderIcon(Bootstrap3::Icon(Bootstrap3::Icon_Thumbs_Up));
    echo renderIcon(Bootstrap3::Icon(Bootstrap3::Icon_Cog));
}

// Devicons 1
if (false) {
	echo '<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/devicons@1.8.0/css/devicons.min.css">';
    echo renderIcon(Devicons1::Icon(Devicons1::Icon_Windows));
    echo renderIcon(Devicons1::Icon(Devicons1::Icon_Linux));
    echo renderIcon(Devicons1::Icon(Devicons1::Icon_Ubuntu));
    echo renderIcon(Devicons1::Icon(Devicons1::Icon_Windows)->attribute('style', 'font-size: 500%;'));
    echo renderIcon(Devicons1::Icon(Devicons1::Icon_Linux)->attribute('style', 'font-size: 500%;'));
    echo renderIcon(Devicons1::Icon(Devicons1::Icon_Ubuntu)->attribute('style', 'font-size: 500%;'));
}

// FontAwesome 4
if (false) {
	echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>';
    echo renderIcon(FontAwesome4::Icon(FontAwesome4::Icon_Thumbs_Up));
    echo renderIcon(FontAwesome4::Icon(FontAwesome4::Icon_Thumbs_Up, FontAwesome4::Modifier_3x));
    echo renderIcon(FontAwesome4::Icon(FontAwesome4::Icon_Thumbs_Up, FontAwesome4::Modifier_3x, FontAwesome4::Modifier_Flip_Horizontal));
    echo renderIcon(FontAwesome4::Icon(FontAwesome4::Icon_Cog, FontAwesome4::Modifier_Spin));
    echo renderIcon(FontAwesome4::Icon(FontAwesome4::Icon_Spinner, FontAwesome4::Modifier_Pulse));
}

// FontAwesome 5
if (false) {
	echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous"/>';
    echo renderIcon(FontAwesome5::Icon(FontAwesome5::Icon_Thumbs_Up));
    echo renderIcon(FontAwesome5::Icon(FontAwesome5::Icon_Thumbs_Up, FontAwesome5::Modifier_3x));
    echo renderIcon(FontAwesome5::Icon(FontAwesome5::Icon_Thumbs_Up, FontAwesome5::Modifier_3x, FontAwesome5::Modifier_Flip_Horizontal));
    echo renderIcon(FontAwesome5::Icon(FontAwesome5::Icon_Cog, FontAwesome5::Modifier_Spin));
    echo renderIcon(FontAwesome5::Icon(FontAwesome5::Icon_Spinner, FontAwesome5::Modifier_Pulse));
}
?>
</body>
</html>
