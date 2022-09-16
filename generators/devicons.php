<?php
/**
 * Generator for Devicons
 *
 * Set the version to extract icon classes from below.
 *
 * @see https://github.com/vorillaz/devicons
 */
$strVersion        = '1.8.0';
$strCssPrefix      = '.devicons-';
$strCssClassPrefix = 'devicons-';

// Load helpers
include './_helpers.php';

// Get and check major version
$iMajorVersion = $fnGetAndCheckMajorVersion($strVersion, [1]);

// Set base URL for raw repository content
$strRawRepositoryUrl = 'https://raw.githubusercontent.com/vorillaz/devicons/' . $strVersion;
if (version_compare($strVersion, '1.4.0') === -1) {
	$strRawRepositoryUrl = 'https://raw.githubusercontent.com/vorillaz/devicons/v' . $strVersion;
}

// Write interface with icons
$arrIcons    = [];
$strIconsUrl = $strRawRepositoryUrl . '/css/devicons.css';
$arrIcons    = $fnExtractClassesFromCss(
	file_get_contents($strIconsUrl),
	$strCssPrefix,
	$strCssClassPrefix,
	'icon'
);
$fnWriteInterface(
	'Xicrow\PhpIcons',
	'Devicons' . $iMajorVersion . 'Icons',
	[
		'List of icon classes for Devicons ' . $iMajorVersion,
		'',
		'Based on Devicons version: ' . $strVersion,
		'Generated                : ' . date('Y-m-d'),
		'',
	],
	$arrIcons
);
