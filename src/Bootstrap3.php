<?php
namespace Xicrow\PhpIcons;

/**
 * Class Bootstrap3
 *
 * @package Xicrow\PhpIcons
 */
class Bootstrap3 extends BaseIcon implements Bootstrap3Glyphicons
{
	/**
	 * Tag name to use
	 *
	 * @var string
	 */
	public static string $strTagName = 'span';

	/**
	 * @inheritDoc
	 */
	public function render(): string
	{
		$arrClasses = array_merge(['glyphicon'], [$this->strIdentifier], $this->arrModifiers);

		return '<' . self::$strTagName . $this->prependAttribute('class', $arrClasses)->appendAttribute('aria-hidden', true)->renderAttributes() . '></' . self::$strTagName . '>';
	}
}
