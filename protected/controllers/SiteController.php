<?php

class SiteController extends MyController {

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
		    // captcha action renders the CAPTCHA image displayed on the contact page
		    'captcha' => array(
			'class' => 'CCaptchaAction',
			'backColor' => 0xFFFFFF,
		    ),
		    // page action renders "static" pages stored under 'protected/views/site/pages'
		    // They can be accessed via: index.php?r=site/page&view=FileName
		    'page' => array(
			'class' => 'CViewAction',
		    ),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate()) {
				$name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
				$subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
				$headers = "From: $name <{$model->email}>\r\n" .
					"Reply-To: {$model->email}\r\n" .
					"MIME-Version: 1.0\r\n" .
					"Content-Type: text/plain; charset=UTF-8";
				$image_dir_path = Yii::app()->params['pathImagesDir'];
				//send mail method 1
				/* $body = "Hi Admin, <p> $model->name want to contact you via " . CHtml::encode(Yii::app()->name) . "</p>";
				  $body .="<p>Below is the complete contact details :</p>";
				  $body .="<p><strong> Name </strong>: " . $model->name . "</p>";
				  $body .="<p><strong> Email </strong>: " . $model->email . "</p>";
				  $body .="<p><strong> Subject </strong>: " . $model->subject . "</p>";
				  $body .="<p><strong> Body </strong>: " . $model->body . "</p>";
				  $body .="<br/> Thanks,<br/>" . CHtml::encode(Yii::app()->name);
				  //mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);

				  $mail_options = array();
				  $mail_options["subject"] = $subject;
				  $mail_options["to"] = array(
				  array("name" => "Ashish Patel", "email" => "apa.narola@narolainfotech.com"),
				  array("name" => "Maulik Patel", "email" => "mk.narola@narolainfotech.com")
				  );
				  //				$mail_options["cc"] = array(
				  //				    array("name" => "Suresh Dankhra", "email" => "sd.narola@narolainfotech.com"),
				  //				    array("name" => "Siddharth Patel", "email" => "sip.narola@narolainfotech.com")
				  //				);
				  $mail_options["attachements"] = array(
				  array("path" => $image_dir_path . "img1.PNG", "name" => "img1"),
				  array("path" => $image_dir_path . "img2.PNG", "name" => "img2"),
				  array("path" => $image_dir_path . "img3.PNG", "name" => "img3"),

				  );
				  $mail_options["message"] = $body;

				  $this->mailsend($mail_options);
				 */

				//send mail method 2
				$message = new YiiMailMessage;
				$message->view = 'contact-mail';
				//userModel is passed to the view
				$message->setBody(array('contactModel' => $model), 'text/html');
				$message->subject = $subject;
				$message->addTo(Yii::app()->params['adminEmail']);
				$message->from = Yii::app()->params['adminFromEmail'];
				$swiftAttachment = Swift_Attachment::fromPath($image_dir_path . "img1.PNG");
				$message->attach($swiftAttachment);
				Yii::app()->mail->send($message);

				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array('model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionMap() {
		$this->render('map');
	}

}