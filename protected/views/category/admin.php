<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
    'Categories' => array('index'),
    'Manage',
);

$this->renderPartial('/partial/common_menu');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Categories</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'category-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'slug',
        'short_description',
        'long_description',
        array(
            'name' => 'parent_id', // col title
            'value' => function (Category $data) {
                if ($data->parent_id)
                    return $data->rel_parent_cat->name; // "parent" - relation name, defined in "relations" method 

                return "Root";
            }
        ),
        /*
          'created',
          'modified',
         */
        array(
            'class' => 'CButtonColumn',
            //'deleteConfirmation'=>"js:'Record with ID '+$(this).parent().parent().children(':first-child').text()+' and will be deleted! Continue?'"
            'deleteConfirmation' => "Are you sure you really want to delete this category ? Please make sure it will delete all their subcategories under this category ! Continue?"
        ),
    ),
));
?>
