<?php
/**
 * Generator for Devicons
 *
 * Set the version to extract icon classes from below.
 *
 * @see https://github.com/vorillaz/devicons
 */
$strVersion     = '1.8.0';
$strClassPrefix = 'devicons-';

/**
 * Extract and check major version
 */
$iMajorVersion = (strpos($strVersion, '.') ? (int)current(explode('.', $strVersion)) : '');
if (!in_array($iMajorVersion, [1], true)) {
    /** @noinspection PhpUnhandledExceptionInspection */
    throw new Exception('Unsupported major version: ' . $iMajorVersion . ' (' . $strVersion . ')');
}

/**
 * Set base URL for raw repository content
 */
if (version_compare($strVersion, '1.4.0') === -1) {
    $strRawRepositoryUrl = 'https://raw.githubusercontent.com/vorillaz/devicons/v' . $strVersion;
} else {
    $strRawRepositoryUrl = 'https://raw.githubusercontent.com/vorillaz/devicons/' . $strVersion;
}

include './helpers.php';

/**
 * Write interface with icons
 */
$arrIcons    = [];
$strIconsUrl = $strRawRepositoryUrl . '/css/devicons.css';
$arrIcons    = extractClassesFromCss(
    file_get_contents($strIconsUrl),
    '.devicons',
    'icon',
    $strClassPrefix
);
/** @noinspection PhpUnhandledExceptionInspection */
writeInterface(
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