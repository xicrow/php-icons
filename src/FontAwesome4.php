<?php
namespace Xicrow\PhpIcons;

/**
 * Class FontAwesome4
 *
 * @package Xicrow\PhpIcons
 */
class FontAwesome4 extends BaseIcon implements FontAwesome4Icons, FontAwesome4Modifiers
{
	/**
	 * Tag name to use
	 *
	 * @var string
	 */
	public static string $strTagName = 'i';

	/**
	 * @inheritDoc
	 */
	public function render(): string
	{
		$arrClasses = array_merge(['fa'], [$this->strIdentifier], $this->arrModifiers);

		return '<' . self::$strTagName . $this->prependAttribute('class', $arrClasses)->renderAttributes() . '></' . self::$strTagName . '>';
	}
}
