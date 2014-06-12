<?php echo CHtml::form(); ?>
<div id="langdrop">
	<?php
	echo CHtml::dropDownList('_lang', $currentLang, array(
	    'en_us' => 'English', 'is_is' => 'Icelandic'), array('onchange'=>'this.form.submit()'));
	?>
</div>
<?php echo CHtml::endForm(); ?>