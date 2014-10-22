<?php
namespace Plugin\Application;

class Slot {
	public static function submitTestimonial($params)
	{
		$form = Helper::createTestimonialForm();
		$formHtml = $form->render();
		return $formHtml;
	}

	public static function sendContactEmailForm($params)
	{
		$form = Helper::createContactForm();
		$formHtml = $form->render();
		return $formHtml;
	}
}