<?php
/**
 * Get and check major version against supported major versions
 *
 * @param string $strVersion
 * @param array  $arrSupportedMajorVersions
 *
 * @return int
 * @throws Exception
 */
$fnGetAndCheckMajorVersion = function (string $strVersion, array $arrSupportedMajorVersions): int {
	if (strpos($strVersion, '.') === false) {
		throw new Exception('Unrecognized version format: ' . $strVersion);
	}

	$iMajorVersion = (int)current(explode('.', $strVersion));
	if (!in_array($iMajorVersion, $arrSupportedMajorVersions, true)) {
		throw new Exception('Unsupported major version: ' . $iMajorVersion . ' (' . implode('|', $arrSupportedMajorVersions) . ')');
	}

	return $iMajorVersion;
};

/**
 * Extract classes from CSS/LESS/SCSS file, and return constant indexes list of classes
 *
 * @param string $strCss
 * @param string $strCssPrefix
 * @param string $strCssClassPrefix
 * @param string $strConstantPrefix
 *
 * @return array
 * @throws Exception
 */
$fnExtractClassesFromCss = function (string $strCss, string $strCssPrefix, string $strCssClassPrefix, string $strConstantPrefix): array {
	$arrClasses = [];

	$arrLines = explode("\n", $strCss);
	foreach ($arrLines as $iLineIndex => $strLine) {
		if (substr($strLine, 0, 2) === '//') {
			continue;
		}

		if (preg_match('/' . preg_quote($strCssPrefix, '/') . '(#{\$[^}]+})?([^ ,:{]+)/', $strLine, $arrMatches) === 1) {
			$strScssVariable = $arrMatches[1];
			$strCssClass     = $arrMatches[2];

			// SCSS loop variable, get loop start and end from previous line
			if ($strScssVariable === '#{$i}' && preg_match('/@for \$i from (\d+) through (\d+)/', $arrLines[$iLineIndex - 1], $arrSubMatches) === 1) {
				for ($iLoop = $arrSubMatches[1]; $iLoop <= $arrSubMatches[2]; $iLoop++) {
					$strSubCssClass = $iLoop . $strCssClass;

					$strConstant = $strConstantPrefix . ' ' . str_replace(['_', '-'], ' ', $strSubCssClass);
					$strConstant = ucwords($strConstant);
					$strConstant = str_replace(' ', '_', $strConstant);

					$arrClasses[$strConstant] = $strCssClassPrefix . $strSubCssClass;
				}
			} elseif ($strScssVariable !== '') {
				throw new Exception('Unhandled SCSS variable: ' . $strScssVariable);
			} else {
				$strConstant = $strConstantPrefix . ' ' . str_replace(['_', '-'], ' ', $strCssClass);
				$strConstant = ucwords($strConstant);
				$strConstant = str_replace(' ', '_', $strConstant);

				$arrClasses[$strConstant] = $strCssClassPrefix . $strCssClass;
			}
		}
	}

	return $arrClasses;
};

/**
 * Write interface with given constants to file
 *
 * @param string $strNamespace
 * @param string $strInterfaceName
 * @param array  $arrDocblockComments
 * @param array  $arrConstants
 *
 * @throws Exception
 */
$fnWriteInterface = function (string $strNamespace, string $strInterfaceName, array $arrDocblockComments, array $arrConstants): void {
	$strFilePath = '../src/' . $strInterfaceName . '.php';

	$strFileData = '<?php' . "\n";
	$strFileData .= 'namespace ' . $strNamespace . ';' . "\n";
	$strFileData .= "\n";
	$strFileData .= '/**' . "\n";
	if (count($arrDocblockComments) > 0) {
		foreach ($arrDocblockComments as $strDocblockComment) {
			$strFileData .= ' * ' . $strDocblockComment . "\n";
		}
	} else {
		$strFileData .= ' * Interface ' . $strInterfaceName . "\n";
		$strFileData .= ' *' . "\n";
	}
	$strFileData .= ' * @package ' . $strNamespace . "\n";
	$strFileData .= ' */' . "\n";
	$strFileData .= 'interface ' . $strInterfaceName . "\n";
	$strFileData .= '{' . "\n";

	if (count($arrConstants) > 0) {
		$iMaxConstantLength = max(array_map('strlen', array_keys($arrConstants)));
		ksort($arrConstants, SORT_NATURAL);
		foreach ($arrConstants as $strConstant => $strValue) {
			$strFileData .= '    public const ' . str_pad($strConstant, $iMaxConstantLength) . ' = \'' . $strValue . '\';' . "\n";
		}
	}

	$strFileData .= '}' . "\n";

	if (file_put_contents($strFilePath, $strFileData) === false) {
		throw new Exception('Unable to save file: ' . $strFilePath);
	}
};
