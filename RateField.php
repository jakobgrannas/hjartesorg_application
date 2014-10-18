<?php

/**
 * @package ImpressPages
 *
 */

namespace Plugin\Application;

use Ip\Form\Field\Radio;

class RateField extends Radio
{
	private $values;
	private $stolenId;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct($options = array())
	{
		if (isset($options['values'])) {
			$this->values = $options['values'];
		} else {
			$this->values = array();
		}
		parent::__construct($options);
		$this->stolenId = $this->getAttribute('id');
		$this->removeAttribute(
			'id'
		); // We need to put id only on the first input. So we will remove it from attributes list. And put it temporary to stolenId.
	}

	/**
	 * Render field
	 *
	 * @param string $doctype
	 * @param $environment
	 * @return string
	 */
	public function render($doctype, $environment)
	{
		$answer = '';

		foreach ($this->getValues() as $key => $value) {
			if ($value[0] == $this->value) {
				$checked = ' checked="checked"';
			} else {
				$checked = '';
			}
			$id = ' id="heart' . $key . '"';

			$answer .= '
                    <input ' . $this->getAttributesStr($doctype) . $id . ' class="visually-hidden ' . implode(
					' ',
					$this->getClasses()
				) . '" name="' . htmlspecialchars(
					$this->getName()
				) . '" type="radio" ' . $this->getValidationAttributesStr(
					$doctype
				) . $checked . ' value="' . htmlspecialchars($value[0]) . '" />
				<label for="heart'. $key .'" class="rate-label"></label>';
		}

		return $answer;
	}

	/**
	 * Set values
	 *
	 * @param string $values
	 */
	public function setValues($values)
	{
		$this->values = $values;
	}

	/**
	 * Get values
	 *
	 * @return array
	 */
	public function getValues()
	{
		return $this->values;
	}

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->stolenId;
	}

	public function getTypeClass() {
		return 'heart';
	}
}


