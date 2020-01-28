<?php
namespace Xicrow\PhpIcons;

/**
 * Class Devicons1
 *
 * @package Xicrow\PhpIcons
 */
class Devicons1 extends BaseIcon implements Devicons1Icons
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
		$arrClasses = array_merge(['devicons'], [$this->strIdentifier], $this->arrModifiers);

		return '<' . self::$strTagName . $this->prependAttribute('class', $arrClasses)->renderAttributes() . '></' . self::$strTagName . '>';
	}
}
