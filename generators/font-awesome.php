<?php
/**
 * Generator for the FontAwesome icon library
 *
 * Set the version to extract icon classes from below.
 *
 * If version 5:
 *  Requires the given version to have the ./metadata/icons.json file
 * If version 4:
 *  Requires the given version to have the ./scss/_icons.scss file
 *
 * @see https://github.com/FortAwesome/Font-Awesome
 */
$strVersion     = '5.11.2';
$strClassPrefix = 'fa-';

/**
 * Extract and check major version
 */
$iMajorVersion = (strpos($strVersion, '.') ? (int)current(explode('.', $strVersion)) : '');
if (!in_array($iMajorVersion, [4, 5], true)) {
    /** @noinspection PhpUnhandledExceptionInspection */
    throw new Exception('Unsupported major version: ' . $iMajorVersion . ' (' . $strVersion . ')');
}

/**
 * Set base URL for raw repository content
 */
switch ($iMajorVersion) {
    case 4:
        $strRawRepositoryUrl = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/v' . $strVersion;
        break;
    case 5:
        $strRawRepositoryUrl = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/' . $strVersion;
        break;
}

include './helpers.php';

/**
 * Write interface with modifiers
 */
switch ($iMajorVersion) {
    case 4:
        $arrModifiersUrls = [
            $strRawRepositoryUrl . '/scss/_animated.scss',
            $strRawRepositoryUrl . '/scss/_bordered-pulled.scss',
            $strRawRepositoryUrl . '/scss/_fixed-width.scss',
            $strRawRepositoryUrl . '/scss/_larger.scss',
            $strRawRepositoryUrl . '/scss/_rotated-flipped.scss',
            $strRawRepositoryUrl . '/scss/_stacked.scss',
        ];
        $arrModifiers     = [];
        foreach ($arrModifiersUrls as $strModifiersUrl) {
            $arrModifiers = array_merge(
                $arrModifiers,
                extractClassesFromCss(
                    file_get_contents($strModifiersUrl),
                    '.#{$fa-css-prefix}',
                    'modifier',
                    $strClassPrefix
                )
            );
        }
        break;
    case 5:
        $arrModifiersUrls = [
            $strRawRepositoryUrl . '/scss/_animated.scss',
            $strRawRepositoryUrl . '/scss/_bordered-pulled.scss',
            $strRawRepositoryUrl . '/scss/_fixed-width.scss',
            $strRawRepositoryUrl . '/scss/_larger.scss',
            $strRawRepositoryUrl . '/scss/_rotated-flipped.scss',
            $strRawRepositoryUrl . '/scss/_stacked.scss',
        ];
        $arrModifiers     = [
            'Modifier_Style_Brands'  => 'fab',
            'Modifier_Style_Duotone' => 'fad',
            'Modifier_Style_Light'   => 'fal',
            'Modifier_Style_Regular' => 'far',
            'Modifier_Style_Solid'   => 'fas',
        ];
        foreach ($arrModifiersUrls as $strModifiersUrl) {
            $arrModifiers = array_merge(
                $arrModifiers,
                extractClassesFromCss(
                    file_get_contents($strModifiersUrl),
                    '.#{$fa-css-prefix}',
                    'modifier',
                    $strClassPrefix
                )
            );
        }
        break;
}
/** @noinspection PhpUnhandledExceptionInspection */
writeInterface(
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

/**
 * Write interface with icons
 */
$arrIcons = [];
switch ($iMajorVersion) {
    case 4:
        $strIconsUrl = $strRawRepositoryUrl . '/scss/_icons.scss';
        $arrIcons    = extractClassesFromCss(
            file_get_contents($strIconsUrl),
            '.#{$fa-css-prefix}',
            'icon',
            $strClassPrefix
        );
        break;
    case 5:
        // @todo It appears the list only contains free icons, figure out how to get all icons, and add option to generate with pro or not (if possible)
        $strIconsUrl = $strRawRepositoryUrl . '/metadata/icons.json';
        $arrData     = json_decode(file_get_contents($strIconsUrl), true, 512, JSON_THROW_ON_ERROR);
        foreach ($arrData as $strIcon => $arrIconInfo) {
            $strConstant = 'icon ' . str_replace('-', ' ', $strIcon);
            $strConstant = ucwords($strConstant);
            $strConstant = str_replace(' ', '_', $strConstant);

            $arrIcons[$strConstant] = $strClassPrefix . $strIcon;
        }
        break;
}
/** @noinspection PhpUnhandledExceptionInspection */
writeInterface(
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
