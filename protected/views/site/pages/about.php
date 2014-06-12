<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>

<?php 
$this->widget('application.extensions.socialLink.socialLink', array(
    'style'=>'left', //alignment - left, right
	'top'=>'30',  //in percentage
        'media' => array(
		'facebook'=>array(
			'url'=>'http://facebook.com/',
			'target'=>'_blank',
		),
        'twitter'=>array(
			'url'=>'http://twitter.com/',
			'target'=>'_blank',
		),
		'google-plus'=>array(
			'url'=>'https://plus.google.com/',
			'target'=>'_blank',
		),
		'linkedin'=>array(
			'url'=>'http://linkedin.com/',
			'target'=>'_blank',
		),
		'rss'=>array(
			'url'=>'http://rss.com/',
			'target'=>'_blank',
		), 
      )
));
?>