<?php echo CHtml::form(); ?>
<div id="langdrop">
	<?php
	echo CHtml::dropDownList('_lang', $currentLang, $languages, array('onchange'=>'this.form.submit()'));
	?>
</div>
<?php echo CHtml::endForm(); ?>