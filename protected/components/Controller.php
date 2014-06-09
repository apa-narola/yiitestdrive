<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 * dynamic menu of each crud
	 */
	public $page_menu = array();
	public $category_menu = array();

	public function generate_slug($string) {
		return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
	}

	public function mailsend($options = array()) {
				
		$mail = Yii::app()->Smtpmail;

		// add subject
		$mail->Subject = $options["subject"];

		//add message
		$mail->MsgHTML($options["message"]);

		// add to
		if (isset($options["to"]) && !empty($options["to"])):
			foreach ($options["to"] as $t) :
				$to_email = isset($t["email"]) ? $t["email"] : "";
				$to_name = isset($t["name"]) ? $t["name"] : "";
				$mail->AddAddress($to_email, $to_name);
			endforeach;
		endif;
		// add cc
		if (isset($options["cc"]) && !empty($options["cc"])):
			foreach ($options["cc"] as $c) :
				$cc_email = isset($c["email"]) ? $c["email"] : "";
				$cc_name = isset($c["name"]) ? $c["name"] : "";
				$mail->AddCC($cc_email, $cc_name);
			endforeach;
		endif;
		// add from
		if (isset($options["from"]) && is_array($options["from"]) && !empty($options["from"])):
			$from_email = isset($options["from"]["email"]) ? $options["from"]["email"] : "";
			$from_name = isset($options["from"]["name"]) ? $options["from"]["name"] : "";
			$mail->SetFrom($from_email, $from_name);
		else:
			$mail->SetFrom(Yii::app()->params['adminFromEmail']);

		endif;

		// add attachments
		if (isset($options["attachements"]) && !empty($options["attachements"])):
			foreach ($options["attachements"] as $a) :
				$a_path = isset($a["path"]) ? $a["path"] : "";
				$a_name = isset($a["filename"]) ? $a["filename"] : "";
				$a_encoding = isset($a["encoding"]) ? $a["encoding"] : "base64";
				$a_type = isset($a["type"]) ? $a["type"] : "application/octet-stream";
				$mail->AddAttachment($a_path, $a_name, $a_encoding, $a_type);
			endforeach;
		endif;

		if (!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message sent!";
		}
	}

}