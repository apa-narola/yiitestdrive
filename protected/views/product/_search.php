<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subTitle'); ?>
		<?php echo $form->textField($model,'subTitle',array('size'=>60,'maxlength'=>128)); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'shortDesc'); ?>
		<?php echo $form->textArea($model,'shortDesc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->label($model,'longDesc'); ?>
		<?php echo $form->textArea($model,'longDesc',array('rows'=>6, 'cols'=>50)); ?>
	</div>-->

    <div class="row">
        <?php echo $form->label($model,'status'); ?>
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
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->