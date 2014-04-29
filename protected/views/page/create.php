<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);
 $this->renderPartial('/partial/common_menu', array('model'=>$model)); 

?>

<h1>Create Page</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>