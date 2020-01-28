<?php
/**
 * Generator for Bootstrap Glyphicons (Bootstrap v.3x)
 *
 * Set the version to extract icon classes from below.
 *
 * @see https://github.com/twbs/bootstrap
 */
$strVersion        = '3.4.1';
$strCssPrefix      = '.glyphicon-';
$strCssClassPrefix = 'glyphicon-';

// Load helpers
include './_helpers.php';

// Get and check major version
$iMajorVersion = $fnGetAndCheckMajorVersion($strVersion, [3]);

// Set base URL for raw repository content
$strRawRepositoryUrl = 'https://raw.githubusercontent.com/twbs/bootstrap/v' . $strVersion;

// Write interface with icons
$arrIcons    = [];
$strIconsUrl = $strRawRepositoryUrl . '/less/glyphicons.less';
$arrIcons    = $fnExtractClassesFromCss(
    file_get_contents($strIconsUrl),
    $strCssPrefix,
    $strCssClassPrefix,
    'icon'
);
$fnWriteInterface(
    'Xicrow\PhpIcons',
    'Bootstrap' . $iMajorVersion . 'Glyphicons',
    [
        'List of icon classes for Bootstrap Glyphicons ' . $iMajorVersion,
        '',
        'Based on Bootstrap version: ' . $strVersion,
        'Generated                 : ' . date('Y-m-d'),
        '',
    ],
    $arrIcons
);
