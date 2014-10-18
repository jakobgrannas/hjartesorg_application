<?php
namespace Plugin\Application;

class Slot {
	public static function submitTestimonial($params)
	{
		$form = new \Ip\Form();

		$field = new \Ip\Form\Field\Text(
			array(
				'name' => 'name',
				'label' => __('Namn', 'Hjartesorg', false),
				'css' => 'input-field'
			));
		$form->addField($field);

		$field = new \Plugin\Application\RateField(
			array(
				'name' => 'rate',
				'label' => __('Betyg', 'Hjartesorg', false),
				'values' => array('1', '2', '3', '4', '5'),
				'css' => 'rate'
			));
		$form->addField($field);

		$field = new \Ip\Form\Field\TextArea(
			array(
				'name' => 'message',
				'label' => __('Meddelande', 'Hjartesorg', false),
				'css' => 'input-field'
			));
		$form->addField($field);

		$field = new \Plugin\Application\CheckboxField(
			array(
				'layout' => \Plugin\Application\CheckboxField::LAYOUT_NO_LABEL,
				'name' => 'allowedOnWebsite',
				'label' => __('Ja, det är OK att visa mitt omdöme på hemsidan', 'Hjartesorg', false),
				'checked' => 1,
				'css' => 'checkbox-field visually-hidden'
			));
		$form->addField($field);

		$field = new \Ip\Form\Field\Submit(
			array(
				'value' => __('Skicka', 'Hjartesorg', false),
				'css' => 'button-positive--filled'
			)
		);
		$form->addField($field);

		$formHtml = $form->render();
		return $formHtml;
	}
}