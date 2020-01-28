<?php
/**
 * Generator for Bootstrap Glyphicons (Bootstrap v.3x)
 *
 * Set the version to extract icon classes from below.
 *
 * @see https://github.com/twbs/bootstrap
 */
$strVersion     = '3.4.1';
$strClassPrefix = 'glyphicon-';

/**
 * Extract and check major version
 */
$iMajorVersion = (strpos($strVersion, '.') ? (int)current(explode('.', $strVersion)) : '');
if (!in_array($iMajorVersion, [3], true)) {
    /** @noinspection PhpUnhandledExceptionInspection */
    throw new Exception('Unsupported major version: ' . $iMajorVersion . ' (' . $strVersion . ')');
}

/**
 * Set base URL for raw repository content
 */
$strRawRepositoryUrl = 'https://raw.githubusercontent.com/twbs/bootstrap/v' . $strVersion;

include './helpers.php';

/**
 * Write interface with icons
 */
$arrIcons    = [];
$strIconsUrl = $strRawRepositoryUrl . '/less/glyphicons.less';
$arrIcons    = extractClassesFromCss(
    file_get_contents($strIconsUrl),
    '.glyphicon',
    'icon',
    $strClassPrefix
);
/** @noinspection PhpUnhandledExceptionInspection */
writeInterface(
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
