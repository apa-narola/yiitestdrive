<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_title')); ?>:</b>
	<?php echo CHtml::encode($data->page_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_content')); ?>:</b>
	<?php echo CHtml::encode($data->page_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_option')); ?>:</b>
	<?php echo CHtml::encode($data->menu_option); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sitemap_visibility')); ?>:</b>
	<?php echo CHtml::encode($data->sitemap_visibility); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_title')); ?>:</b>
	<?php echo CHtml::encode($data->seo_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('focus_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->focus_keywords); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_desc')); ?>:</b>
	<?php echo CHtml::encode($data->meta_desc); ?>
	<br />

	*/ ?>

</div>