<?php
namespace Xicrow\PhpIcons;

/**
 * Class FontAwesome5
 *
 * @package Xicrow\PhpIcons
 */
class FontAwesome5 extends BaseIcon implements FontAwesome5Icons, FontAwesome5Modifiers
{
	/**
	 * Tag name to use
	 *
	 * @var string
	 */
	public static string $strTagName = 'i';

	/**
	 * Default style modifier
	 *
	 * @var string
	 */
	public static string $strDefaultStyleModifier = self::Modifier_Style_Solid;

	/**
	 * List of style modifiers
	 *
	 * @var array
	 */
	public static array $arrStyleModifiers = [self::Modifier_Style_Brands, self::Modifier_Style_Duotone, self::Modifier_Style_Light, self::Modifier_Style_Regular, self::Modifier_Style_Solid];

	/**
	 * Get set style modifer or default if not set
	 *
	 * @return string
	 */
	public function getStyleModifier(): string
	{
		$arrAppliedStyleModifiers = array_intersect($this->arrModifiers, self::$arrStyleModifiers);
		if (count($arrAppliedStyleModifiers) > 0) {
			return (string)end($arrAppliedStyleModifiers);
		}

		return self::$strDefaultStyleModifier;
	}

	/**
	 * @inheritDoc
	 */
	public function render(): string
	{
		$strStyleModifier = $this->getStyleModifier();

		$arrClasses = $this->arrModifiers;

		$mIndex = array_search($strStyleModifier, $arrClasses);
		if ($mIndex !== false) {
			unset($arrClasses[$mIndex]);
		}

		$arrClasses = array_merge([$strStyleModifier], [$this->strIdentifier], $arrClasses);

		return '<' . self::$strTagName . $this->prependAttribute('class', $arrClasses)->renderAttributes() . '></' . self::$strTagName . '>';
	}
}
