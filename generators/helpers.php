<?php
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
function writeInterface(string $strNamespace, string $strInterfaceName, array $arrDocblockComments, array $arrConstants): void
{
    $strFilePath = '../src/' . $strInterfaceName . '.php';

    $strFileData = '';
    $strFileData .= '<?php' . "\n";
    $strFileData .= 'namespace ' . $strNamespace . ';' . "\n";
    $strFileData .= '' . "\n";
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
}

/**
 * Extract classes from CSS/LESS/SCSS file, and return constant indexes list of classes
 *
 * @param string $strCss
 * @param string $strCssPrefix
 * @param string $strConstantPrefix
 * @param string $strCssClassPrefix
 *
 * @return array
 */
function extractClassesFromCss(string $strCss, string $strCssPrefix, string $strConstantPrefix, string $strCssClassPrefix): array
{
    $arrClasses = [];

    $arrLines = explode("\n", $strCss);
    foreach ($arrLines as $iLineIndex => $strLine) {
        if (substr($strLine, 0, 2) === '//') {
            continue;
        }

        if (preg_match('/' . preg_quote($strCssPrefix, '/') . '-([^ ,:{]+)/', $strLine, $arrMatches) === 1) {
            $strCssClass = $arrMatches[1];
            if (strpos($strCssClass, '#{$i}') === 0 && preg_match('/@for \$i from (\d+) through (\d+)/', $arrLines[$iLineIndex - 1], $arrSubMatches) === 1) {
                for ($iLoop = $arrSubMatches[1]; $iLoop <= $arrSubMatches[2]; $iLoop++) {
                    $strSubCssClass = str_replace('#{$i}', $iLoop, $strCssClass);

                    $strConstant = $strConstantPrefix . ' ' . str_replace('-', ' ', $strSubCssClass);
                    $strConstant = ucwords($strConstant);
                    $strConstant = str_replace(' ', '_', $strConstant);

                    $arrClasses[$strConstant] = $strCssClassPrefix . $strSubCssClass;
                }
            } else {
                $strConstant = $strConstantPrefix . ' ' . str_replace('-', ' ', $strCssClass);
                $strConstant = ucwords($strConstant);
                $strConstant = str_replace(' ', '_', $strConstant);

                $arrClasses[$strConstant] = $strCssClassPrefix . $strCssClass;
            }
        }
    }

    return $arrClasses;
}
