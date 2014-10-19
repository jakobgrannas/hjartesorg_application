<?php

namespace Plugin\Application;


class SiteController extends \Ip\Controller {
	public function sendTestimonial()
	{
		// Validate form
		$form = Helper::createForm();

		$postData = ipRequest()->getPost();
		$errors = $form->validate($postData);

		if($errors) {
			$data = $this->getErrorData($errors);
			return new \Ip\Response\Json($data);
		}

		// Send email
		$emailData = array(
			'author' => ipRequest()->getPost('name'),
			'rating' => ipRequest()->getPost('rating'),
			'allowedOnWebsite' => ipRequest()->getPost('allowedOnWebsite'),
			'comment' => ipRequest()->getPost('message')
		);

		$emailHtml = ipEmailTemplate($emailData);
		ipSendEmail("omdome@hjartesorg.se", "Hjärtesorg.se", "jakob.grannas@gmail.com", "Recipient name", "Nytt kundomdöme från " . ipRequest()->getPost('name'), $emailHtml);

		$data = $this->getSuccessData();
		return new \Ip\Response\Json($data);
	}

	private function getSuccessData ($message = array()) {
		$renderedHtml = ipView('view/success.php', $message)->render();
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