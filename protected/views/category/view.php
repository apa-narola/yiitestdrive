<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	$model->name,
);

$this->renderPartial('/partial/common_menu', array('model' => $model)); 
?>

<h1>View Category #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'slug',
		'short_description',
		'long_description',
		array(
            'name' => 'Parent Category', // col title
            'value' => function (Category $data) {
                if ($data->parent_id)
                    return $data->rel_parent_cat->name; // "parent" - relation name, defined in "relations" method 

                return "Root";
            }
        ),
		'created',
		'modified',
	),
)); ?>
