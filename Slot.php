<?php
namespace Plugin\Application;

class Slot {
	public static function submitTestimonial($params)
	{
		$form = Helper::createForm();
		$formHtml = $form->render();
		return $formHtml;
	}
}