<?php

namespace Plugin\Application;


class SiteController extends \Ip\Controller {
	public function sendTestimonial()
	{
		$name = ipRequest()->getPost('name');
		$mailTo = "jakob.grannas@gmail.com";
		$templateVars = array(
			'message' => __('Tack för att du hjälper oss att förbättras!', 'Hjartesorg', false)
		);

		// Validate form
		$form = Helper::createTestimonialForm();

		$postData = ipRequest()->getPost();
		$errors = $form->validate($postData);

		if($errors) {
			$data = $this->getErrorData($errors);
			return new \Ip\Response\Json($data);
		}

		// Send email
		$emailData = array(
			'type' => 'testimonial',
			'author' => $name,
			'rating' => ipRequest()->getPost('rating'),
			'allowedOnWebsite' => ipRequest()->getPost('allowedOnWebsite'),
			'message' => ipRequest()->getPost('message')
		);

		$emailHtml = ipEmailTemplate($emailData);
		ipSendEmail("omdome@hjartesorg.se", $name, $mailTo, 'Hjärtesorg.se', "Nytt kundomdöme från " . $name, $emailHtml);

		$data = $this->getSuccessData($templateVars);
		return new \Ip\Response\Json($data);
	}

	public function sendContactEmail()
	{
		$name = ipRequest()->getPost('name');
		$email = ipRequest()->getPost('email');
		$mailTo = "jakob.grannas@gmail.com";
		$templateVars = array(
			'message' => __('Meddelande skickat!', 'Hjartesorg', false)
		);

		// Validate form
		$form = Helper::createContactForm();

		$postData = ipRequest()->getPost();
		$errors = $form->validate($postData);

		if($errors) {
			$data = $this->getErrorData($errors);
			return new \Ip\Response\Json($data);
		}

		// Send email
		$emailData = array(
			'type' => 'contactEmail',
			'author' => $name,
			'email' => $email,
			'message' => ipRequest()->getPost('message')
		);

		$emailHtml = ipEmailTemplate($emailData);
		ipSendEmail($email, $name, $mailTo, 'Hjärtesorg.se', "Nytt mejl från " . $name, $emailHtml);

		$data = $this->getSuccessData($templateVars);
		return new \Ip\Response\Json($data);
	}

	private function getSuccessData ($vars = array()) {
		$renderedHtml = ipView('view/success.php', $vars)->render();
		$status = array(
			'status' => 'success',
			'html' => $renderedHtml
		);
		return $status;
	}

	private function getErrorData ($errors = array()) {
		$renderedHtml = ipView('view/error.php', $errors)->render();
		$status = array(
			'status' => 'error',
			'html' => $renderedHtml
		);
		return $status;
	}
} 