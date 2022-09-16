<?php
namespace Xicrow\PhpIcons;

use JsonException;

/**
 * Class BaseIcon
 *
 * @package Xicrow\PhpIcons
 */
abstract class BaseIcon
{
	/**
	 * Icon identifier
	 *
	 * @var string
	 */
	protected string $strIdentifier = '';

	/**
	 * Icon modifiers
	 *
	 * @var string[]
	 */
	protected array $arrModifiers = [];

	/**
	 * Icon attributes
	 *
	 * @var string[]
	 */
	protected array $arrAttributes = [];

	/**
	 * Get new instance of the icon
	 *
	 * @param string $strIdentifier
	 * @param string ...$arrModifiers
	 *
	 * @return static
	 */
	public static function Icon(string $strIdentifier, string ...$arrModifiers): self
	{
		return new static($strIdentifier, ...$arrModifiers);
	}

	/**
	 * BaseIcon constructor.
	 *
	 * @param string   $strIdentifier
	 * @param string[] $arrModifiers
	 */
	public function __construct(string $strIdentifier, string ...$arrModifiers)
	{
		$this->strIdentifier = $strIdentifier;
		$this->arrModifiers  = array_unique($arrModifiers);
	}

	/**
	 * Call render() when cast to string
	 *
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->render();
	}

	/**
	 * Add an attribute to the icon
	 *
	 * @param string     $strAttribute
	 * @param mixed|null $mValue
	 *
	 * @return static
	 */
	public function attribute(string $strAttribute, $mValue = null): self
	{
		$this->arrAttributes[$strAttribute] = $mValue;

		return $this;
	}

	/**
	 * Modify the icon (add one or more modifiers)
	 *
	 * @param string ...$arrModifiers
	 *
	 * @return static
	 */
	public function modify(string ...$arrModifiers): self
	{
		foreach ($arrModifiers as $strModifier) {
			$this->appendModifier($strModifier);
		}

		return $this;
	}

	/**
	 * Render the icon
	 *
	 * @return string
	 */
	abstract public function render(): string;

	/**
	 * Append an attribute (to the end of the list)
	 *
	 * @param string     $strAttribute
	 * @param mixed|null $mValue
	 *
	 * @return $this
	 */
	protected function appendAttribute(string $strAttribute, $mValue = null): self
	{
		// Merge value with existing value
		if (array_key_exists($strAttribute, $this->arrAttributes)) {
			$mValue = $this->mergeAttributeValue($strAttribute, $this->arrAttributes[$strAttribute], $mValue);
		}

		// Remove existing attribute to eliminate duplicates
		$this->removeAttribute($strAttribute);

		// Append to list of attributes
		$this->arrAttributes = array_merge($this->arrAttributes, [$strAttribute => $mValue]);

		return $this;
	}

	/**
	 * Merge two attribute values
	 *
	 * @param string     $strAttribute
	 * @param mixed|null $mExistingValue
	 * @param mixed|null $mValue
	 *
	 * @return mixed
	 */
	protected function mergeAttributeValue(string $strAttribute, $mExistingValue, $mValue)
	{
		if ($strAttribute == 'class') {
			if (is_string($mExistingValue)) {
				$mExistingValue = explode(' ', $mExistingValue);
			}
			if (is_string($mValue)) {
				$mValue = explode(' ', $mValue);
			}
			if (is_array($mExistingValue) && is_array($mValue)) {
				$mValue = array_unique(array_merge($mExistingValue, $mValue));
			}
		}

		return $mValue;
	}

	/**
	 * Prepend an attribute (to the beginning of the list)
	 *
	 * @param string     $strAttribute
	 * @param mixed|null $mValue
	 *
	 * @return $this
	 */
	protected function prependAttribute(string $strAttribute, $mValue = null): self
	{
		// Merge value with existing value
		if (array_key_exists($strAttribute, $this->arrAttributes)) {
			$mValue = $this->mergeAttributeValue($strAttribute, $this->arrAttributes[$strAttribute], $mValue);
		}

		// Remove existing attribute to eliminate duplicates
		$this->removeAttribute($strAttribute);

		// Prepend to list of attributes
		$this->arrAttributes = array_merge([$strAttribute => $mValue], $this->arrAttributes);

		return $this;
	}

	/**
	 * Remove an attribute
	 *
	 * @param string $strAttribute
	 *
	 * @return $this
	 */
	protected function removeAttribute(string $strAttribute): self
	{
		if (array_key_exists($strAttribute, $this->arrAttributes)) {
			unset($this->arrAttributes[$strAttribute]);
		}

		return $this;
	}

	/**
	 * Append a modifier (to the end of the list)
	 *
	 * @param string $strModifier
	 *
	 * @return $this
	 */
	protected function appendModifier(string $strModifier): self
	{
		// Remove existing modifer to eliminate duplicates
		$this->removeModifier($strModifier);

		// Append to list of modifiers
		$this->arrModifiers = array_merge($this->arrModifiers, [$strModifier]);

		return $this;
	}

	/**
	 * Prepend a modifier (to the beginning of the list)
	 *
	 * @param string $strModifier
	 *
	 * @return $this
	 */
	protected function prependModifier(string $strModifier): self
	{
		// Remove existing modifer to eliminate duplicates
		$this->removeModifier($strModifier);

		// Prepend to list of modifiers
		$this->arrModifiers = array_merge([$strModifier], $this->arrModifiers);

		return $this;
	}

	/**
	 * Remove a modifier
	 *
	 * @param string $strModifier
	 *
	 * @return $this
	 */
	protected function removeModifier(string $strModifier): self
	{
		$mModifierIndex = array_search($strModifier, $this->arrModifiers);
		if ($mModifierIndex !== false) {
			unset($this->arrModifiers[$mModifierIndex]);
		}

		return $this;
	}

	/**
	 * Render attributes
	 *
	 * @return string
	 */
	protected function renderAttributes(): string
	{
		$strAttributes = '';

		foreach ($this->arrAttributes as $strKey => $mValue) {
			if (is_array($mValue)) {
				switch ($strKey) {
					case 'class':
						$mValue = implode(' ', $mValue);
					break;
					default:
						try {
							$mValue = json_encode($mValue, JSON_THROW_ON_ERROR);
						} catch (JsonException $oException) {
						}
					break;
				}
			} elseif (is_object($mValue)) {
				try {
					$mValue = json_encode($mValue, JSON_THROW_ON_ERROR);
				} catch (JsonException $oException) {
				}
			} elseif (is_bool($mValue)) {
				$mValue = $mValue ? 'true' : 'false';
			}

			if ($mValue === null) {
				$strAttributes .= ' ' . $strKey;
			} else {
				$strAttributes .= ' ' . $strKey . '="' . $mValue . '"';
			}
		}

		return $strAttributes;
	}
}
