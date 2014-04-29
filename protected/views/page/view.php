<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->id,
);

$this->renderPartial('/partial/common_menu',array("model"=>$model));
?>

<h1>View Page #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'page_title',
		'page_content',
		'menu_option',
		'sitemap_visibility',
		'seo_title',
		'focus_keywords',
		'meta_desc',
	),
)); ?>
