<?php
/**
 * Generator for the FontAwesome icon library
 *
 * Set the version to extract icon classes from below.
 *
 * @see https://github.com/FortAwesome/Font-Awesome
 */
$strVersion        = '5.11.2';
$strCssPrefix      = '.#{$fa-css-prefix}-';
$strCssClassPrefix = 'fa-';

// Load helpers
include './_helpers.php';

// Get and check major version
$iMajorVersion = $fnGetAndCheckMajorVersion($strVersion, [4, 5]);

// Set base URL for raw repository content
$strRawRepositoryUrl = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/' . $strVersion;
if (version_compare($strVersion, '5.0.0') === -1) {
	$strRawRepositoryUrl = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/v' . $strVersion;
}

// Write interface with modifiers
$arrModifiers = [];
if ($iMajorVersion === 5) {
	$arrModifiers = array_merge($arrModifiers, [
		'Modifier_Style_Brands'  => 'fab',
		'Modifier_Style_Duotone' => 'fad',
		'Modifier_Style_Light'   => 'fal',
		'Modifier_Style_Regular' => 'far',
		'Modifier_Style_Solid'   => 'fas',
	]);
}
$arrModifiersUrls = [
	$strRawRepositoryUrl . '/scss/_animated.scss',
	$strRawRepositoryUrl . '/scss/_bordered-pulled.scss',
	$strRawRepositoryUrl . '/scss/_fixed-width.scss',
	$strRawRepositoryUrl . '/scss/_larger.scss',
	$strRawRepositoryUrl . '/scss/_rotated-flipped.scss',
	$strRawRepositoryUrl . '/scss/_stacked.scss',
];
foreach ($arrModifiersUrls as $strModifiersUrl) {
	$arrModifiers = array_merge(
		$arrModifiers,
		$fnExtractClassesFromCss(
			file_get_contents($strModifiersUrl),
			$strCssPrefix,
			$strCssClassPrefix,
			'modifier'
		)
	);
}
$fnWriteInterface(
	'Xicrow\PhpIcons',
	'FontAwesome' . $iMajorVersion . 'Modifiers',
	[
		'List of modifier classes for FontAwesome ' . $iMajorVersion,
		'',
		'Based on FontAwesome version: ' . $strVersion,
		'Generated                   : ' . date('Y-m-d'),
		'',
	],
	$arrModifiers
);

// Write interface with icons
$arrIcons    = [];
$strIconsUrl = $strRawRepositoryUrl . '/scss/_icons.scss';
$arrIcons    = $fnExtractClassesFromCss(
	file_get_contents($strIconsUrl),
	$strCssPrefix,
	$strCssClassPrefix,
	'icon'
);
$fnWriteInterface(
	'Xicrow\PhpIcons',
	'FontAwesome' . $iMajorVersion . 'Icons',
	[
		'List of icon classes for FontAwesome ' . $iMajorVersion,
		'',
		'Based on FontAwesome version: ' . $strVersion,
		'Generated                   : ' . date('Y-m-d'),
		'',
	],
	$arrIcons
);
