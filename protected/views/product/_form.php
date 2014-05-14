<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'subTitle'); ?>
        <?php echo $form->textField($model, 'subTitle', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'subTitle'); ?>
    </div>
    <div class="row">
        <div>
            <?php
            $product_image_path = realpath(Yii::app()->basePath . '/../images/products');

            if (!empty($model->image) && file_exists($product_image_path . '/' . $model->image)):
                ?>
                <img height="140" width="210" src="<?php echo Yii::app()->baseUrl . '/images/products' . '/' . $model->image; ?>" />
            <?php else:
                ?>
                <img height="140" width="210" src="<?php echo Yii::app()->baseUrl . '/images/noimage.jpg'; ?>" />

            <?php
            endif;
            ?>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->fileField($model, 'image'); ?>
        <?php echo $form->error($model, 'image'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'shortDesc'); ?>
        <?php echo $form->textArea($model, 'shortDesc', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'shortDesc'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'longDesc'); ?>
        <?php echo $form->textArea($model, 'longDesc', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'longDesc'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'Categories'); ?>
        <?php
        $list = CHtml::listData(Category::model()->findAll(array('order' => 'name')), 'id', 'name'); //table_col_name1 is value of option, table_col_name2 is label of option
        // echo $form->dropDownList($model, 'product_type_id', $list);
        $selected = $model->selected_categories;
        $catHtmlOptions = array('size' => '10', 'prompt'=>'Use CTRL to Select Multiple Categories', 'multiple' => 'true', 'options' => $selected);
        echo CHtml::dropDownList('categories', $model, $list,$catHtmlOptions);
        ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php
        $status_opts = array(
            "1" => "Enable",
            "0" => "Disable",
        );

        echo $form->dropDownList($model, 'status', $status_opts, array('options' => array($model->status => array('selected' => true))));
        ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <!--	<div class="row">
    <?php echo $form->labelEx($model, 'created'); ?>
    <?php echo $form->textField($model, 'created'); ?>
    <?php echo $form->error($model, 'created'); ?>
            </div>
    
            <div class="row">
    <?php echo $form->labelEx($model, 'updated'); ?>
    <?php echo $form->textField($model, 'updated'); ?>
    <?php echo $form->error($model, 'updated'); ?>
            </div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->