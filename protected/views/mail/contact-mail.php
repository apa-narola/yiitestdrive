<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Screen1</title>
		<link href="http://clientapp.narolainfotech.com/test/contact-mail-template.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<!-----------main-box----------->
		<div class="main-box">
			<div class="top_text">If this e-mail is not displayed properly, <a href="#">please click here.</a></div>
			<div class="cr"></div>
			<!-----------White-box----------->
			<div class="white_main">
				<!-----------logo_part----------->
				<div class="logo-outer">
					<div class="logo_left"><a href="#"><img src="http://clientapp.narolainfotech.com/test/images/logo.png" title="Logo" /></a></div>
					<div class="logo_right">Contact</div>
				</div>
				<div class="cr"></div>
				<!-----------logo_part----------->
				<div class="headding_tetx">Hello Admin,</div>
				<div class="cr"></div>
				<p> <?php echo $contactModel->name; ?> wants to contact you.</p>
				<div class="cr"></div>
				<div class="flo_outer">
					<label class="label_01">Name :</label>
					<div class="lab_text"><?php echo $contactModel->name; ?></div>
				</div>
				<div class="cr"></div>
				<div class="flo_outer">
					<label class="label_01">Email :</label>
					<div class="lab_text"><?php echo $contactModel->email; ?></div>
				</div>
				<div class="cr"></div>
				<div class="flo_outer">
					<label class="label_01">Subject :</label>
					<div class="lab_text"><?php echo $contactModel->subject; ?></div>
				</div>
				<div class="cr"></div>
				<div class="flo_outer">
					<label class="label_01">Message :</label>
					<div class="lab_text"><?php echo $contactModel->message; ?></div>
				</div>
				<div class="cr"></div>
				<div class="btn_outer">
					<input type="button" class="btn_subscribe" value="Subscribe" />
					<a href="#" class="link_subscribe">Subscribe</a>
				</div>
				<div class="cr"></div>
				<div class="alert_outer">
					<div class="alert_left"><a href="#"><img src="http://clientapp.narolainfotech.com/test/images/alert.png" /></a></div>
					<div class="alert_text">Please note that without any new subscription on your part, and at the terms of this
						delay, your account will be removed and your mobile applications deleted from the
						downloading platforms.<br />
						The downloading platforms owners may remove your apps in case of a prolonged
						inactivity before this delay.  </div>
				</div>
				<div class="cr"></div>
				<p>Best regards,</p>
				<div class="cr"></div>
				<div class="headding_tetx"><?php echo CHtml::encode(Yii::app()->name);?></div>
				<div class="cr"></div>
				<!-----------Footer-part----------->
				<div class="footer1">© Copyright Show-Up 2013 - This e-mail was sent automatically - Please do not respond</div>
				<!-----------Footer-part----------->
				<div class="cr"></div>
			</div>
			<!-----------White-box----------->
			<div class="cr"></div>
		</div>
		<!-----------main-box----------->
	</body>
</html>
