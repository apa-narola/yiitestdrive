<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<?php
		$meta_title = isset($this->page_title) ? $this->page_title : CHtml::encode($this->pageTitle);
		$meta_keywords = isset($this->focus_keywords) ? $this->focus_keywords : "";
		$meta_desc = isset($this->meta_desc) ? $this->meta_desc : "";
		?>

		<meta name="description" content="<?php echo $meta_desc; ?>" />
		<meta name="keywords" content="<?php echo $meta_keywords; ?>" />
		<title><?php echo $meta_title; ?></title>
		<!-- blueprint CSS framework -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <!-- <title><?php echo CHtml::encode($this->pageTitle); ?></title> -->


		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.0.min.js"></script>
	</head>

	<body>

		<div class="container" id="page">

			<div id="header">
				<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
				<div  id="language-selector" style="float:right; margin:5px;">
					<?php
					$this->widget('application.components.widgets.LanguageSelector');
					?>
				</div>
				<?php
				$this->widget('application.components.widgets.LangBox');
				?>
			</div><!-- header -->


			<?php
			foreach (Yii::app()->user->getFlashes() as $key => $message) {
				if ($key == 'counters') {
					continue;
				}
				echo "<div class='flash-{$key}'>{$message}</div>";
			}
			Yii::app()->clientScript->registerScript(
				'myHideEffect', '$(".flash-success,.flash-notice,.flash-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
			);
			?>

			<?php
			$page = Yii::app()->createController('page'); //returns array containing controller instance and action index.
			$page = $page[0]; //get the controller instance.

			$page_info = $page->actionGetPages(); //use a public method.
			$pages_header_items = array();
			$pages_footer_items = array();
			foreach ($page_info as $p_key => $p_value) {

				$route = "page/show";

				$params = "";
				$url = "";
				//$params = array("id"=>$p_value['id']);
				$params = array("id" => $p_value['id'], "title" => $p_value['seo_title']);

				//$url = $this->createUrl($route,$params);
				$url = $this->createAbsoluteUrl($route, $params);
				//echo $url."<br/>";


				if ($p_value["menu_option"] == "headmenu")
					array_push($pages_header_items, array('label' => $p_value['page_title'], 'url' => $url));

				if ($p_value["menu_option"] == "footmenu")
					array_push($pages_footer_items, array('label' => $p_value['page_title'], 'url' => $url));
			}
			$header_items = array(
			    array('label' => 'Home', 'url' => array('/site/index')),
			    array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
			    array('label' => 'Contact', 'url' => array('/site/contact')),
			    array('label' => 'Pages', 'url' => '', 'items' => $pages_header_items, 'visible' => Yii::app()->user->isGuest),
			    array('label' => 'CMS', 'url' => array('/page/admin'), 'items' => $this->page_menu, 'visible' => !Yii::app()->user->isGuest),
			    array('label' => 'Category', 'url' => array('/category/admin'), 'items' => $this->category_menu, 'visible' => !Yii::app()->user->isGuest),
			    array('url' => Yii::app()->getModule('user')->loginUrl, 'label' => Yii::app()->getModule('user')->t("Login"), 'visible' => Yii::app()->user->isGuest),
			    array('url' => Yii::app()->getModule('user')->registrationUrl, 'label' => Yii::app()->getModule('user')->t("Register"), 'visible' => Yii::app()->user->isGuest),
			    array('url' => Yii::app()->getModule('user')->profileUrl, 'label' => Yii::app()->getModule('user')->t("Profile"), 'visible' => !Yii::app()->user->isGuest),
			    array('url' => Yii::app()->getModule('user')->logoutUrl, 'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'visible' => !Yii::app()->user->isGuest),
			);

			$footer_items = array(
			    array('label' => 'Home', 'url' => array('/site/index')),
			    // array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
			    // array('label'=>'Contact', 'url'=>array('/site/contact')),
			    array('label' => 'Pages', 'url' => '', 'items' => $pages_footer_items, 'visible' => Yii::app()->user->isGuest),
			    array('label' => 'CMS', 'url' => array('/page/admin'), 'items' => $this->page_menu, 'visible' => !Yii::app()->user->isGuest),
			    array('label' => 'Category', 'url' => array('/category/admin'), 'items' => $this->category_menu, 'visible' => !Yii::app()->user->isGuest),
			    array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
			    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
			);
			?>
			<div id="mainmenu">
				<?php
				$this->widget('zii.widgets.CMenu', array('items' => $header_items, 'encodeLabel' => false,
				    'htmlOptions' => array(
					'class' => 'nav pull-right',
				    ),
				    'submenuHtmlOptions' => array(
					'class' => 'dropdown-menu',
				)));
				?>
			</div><!-- mainmenu -->
			<!-- slider start -->
			<?php
			/*
			  $this->widget('application.extensions.slider.Slider',array(
			  'items'=>array(
			  array(Yii::app()->getBaseUrl(true).'/images/img1.png', 'image1'),
			  array(Yii::app()->getBaseUrl(true).'/images/img2.png', 'image2'),
			  array(Yii::app()->getBaseUrl(true).'/images/img3.png', 'image3'),
			  array(Yii::app()->getBaseUrl(true).'/images/img4.png', 'image4'),
			  array(Yii::app()->getBaseUrl(true).'/images/img5.png', 'image5'),
			  ),
			  )); */
			?>
			<!-- slider end --> 
			<?php if (isset($this->breadcrumbs)): ?>
				<?php
				$this->widget('zii.widgets.CBreadcrumbs', array(
				    'links' => $this->breadcrumbs,
				));
				?><!-- breadcrumbs -->
			<?php endif ?>

			<?php echo $content; ?>

			<div class="clear"></div>

			<div id="footer">
				<?php
				$this->widget('application.extensions.social.social', array(
				    'style' => 'vertical',
				    'networks' => array(
					'twitter' => array(
					    'data-via' => '', //http://twitter.com/#!/YourPageAccount if exists else leave empty
					),
					'googleplusone' => array(
					    "size" => "medium",
					    "annotation" => "bubble",
					),
					'facebook' => array(
					    'href' => 'https://www.facebook.com/NarolaInfotech', //asociate your page http://www.facebook.com/page 
					    'action' => 'recommend', //recommend, like
					    'colorscheme' => 'light',
					    'width' => '120px',
					)
				    )
				));

				/*
				 * Usual parameters to be adjusted: 

				  - style: button's alignment (string: horizontal or vertical).
				  - networks: social network which you must have (twitter, googleplusone, facebook);
				  - data-via:Your Twitter Page Account if exists or leave empty (url: //http://twitter.com/#!/YourPageAccount)
				  - size: google button size (string:small, standard, **medium**, tall)
				  - annotation: google button mode to show annotation(string: **bubble**, inline, none)
				  - href: Your Facebook Page (url: http://www.facebook.com/facebook_page)
				  - action: action for facebook button (string: **recommend** or like)
				  - colorscheme: used color scheme for facebook button (string: **light** or dark)
				  - width: the width for facebook button container (pixels: **120px**)
				 */
				?>
				<div id="footer_links">
					<?php $this->widget('zii.widgets.CMenu', array('items' => $footer_items)); ?>	
				</div>

				<div class="copyright">
					Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
					All Rights Reserved.<br/>
					<?php echo Yii::powered(); ?>
				</div>
			</div><!-- footer -->

		</div><!-- page -->


	</body>
</html>
