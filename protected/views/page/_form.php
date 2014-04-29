<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'page_title'); ?>
		<?php echo $form->textField($model,'page_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'page_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_content'); ?>
		<?php //echo $form->textArea($model,'page_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php $this->widget(
	'application.extensions.NHCKEditor.CKEditorWidget', 
	array(
		//	[Required] CModel object
		'model' => $model,
		'attribute' => 'page_content',
		
		//	[Optional] CSS file to be included
		//'cssFile' => Yii::app()->request->baseURL.'/css/screen.css',
		
		//	[Optional] Options based on CKEditor API documentation
		/*'editorOptions' => array(
		    
		    //  Now supports PHP array and javascript code (must begin with js:)
		    
			//'width' => 800,
			//'height' => 480,
			//'language' => 'th',
			
			
			//'toolbar' => 'Full',              //	format #1:	String
            
            //'toolbar' => array(		        //	format #2:	PHP array
            //	array('Source', '-', 'Save')
            //),
            
            //'toolbar' => "js:[		        //	format #3:	javascript code
            //	['Source', '-', 'Save']
            //]",
            
			//'uiColor' => '',
			
			//	... your own options
		),*/
		
		//	[Optional] htmlOptions based on Yii implementation
		/*'htmlOptions' => array(
		    
		),*/
	)
); ?>
		<?php echo $form->error($model,'page_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_option'); ?>
		<?php //echo $form->textField($model,'menu_option',array('size'=>8,'maxlength'=>8)); ?>
		<?php 
		$menu_opts = array(
		"headmenu"=>"Header Menu",
		"footmenu"=>"Footer Menu",
		);
		$html_opts =array(
		'selected'=>"headmenu"
		);
		echo $form->dropDownList($model,'menu_option',$menu_opts); ?>
		<?php echo $form->error($model,'menu_option'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sitemap_visibility'); ?>
		<?php
            $sitemap_opts = array(
                "yes" => "Yes",
                "no" => "No"
            );
            echo $form->radioButtonList($model, 'sitemap_visibility', $sitemap_opts,$htmlOptions=array('separator'=>'','labelOptions'=>array('style'=>'display:inline;margin-right:10px;')));
            ?>

            <?php echo $form->error($model, 'sitemap_visibility'); ?>
	</div>
	<div class="row ">
	<div id="preview_seo_title" class="seo_title"></div>
	<div id="preview_meta_url" class="seo_url"></div>
	<div id="preview_meta_desc" class="seo_desc"></div>
	<!-- Wordpress SEO Plugin - Search Engine Optimization Plugin - Yoast -->
	<!-- The most complete Wordpress SEO Plugin, Yoast`s Wordpress SEO plugin is all in One SEO solution for your Wordpress blog. used by experts worldwide. -->

	</div>
	<div class="clearfix"></div>
	<div class="row">
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textField($model,'seo_title',array("id"=>"seoTitle",'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'focus_keywords'); ?>
		<?php echo $form->textField($model,'focus_keywords',array("id"=>"seoKeywords",'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'focus_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_desc'); ?>
		<?php echo $form->textField($model,'meta_desc',array("id"=>"seoDesc",'size'=>60,'maxlength'=>255)); ?>
		
		<?php echo $form->error($model,'meta_desc'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'meta_url'); ?>
		<?php echo $form->textField($model,'meta_url',array("id"=>"seoURL",'size'=>60,'maxlength'=>255)); ?>
		
		<?php echo $form->error($model,'meta_url'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery("#seoTitle").on("keyup",function(){
		var st = jQuery(this).val();
		jQuery(".seo_title").html(st);;
	});
	jQuery("#seoDesc").on("keyup",function(){
		var sd = jQuery(this).val();
		jQuery(".seo_desc").html(sd);;
		jQuery("#seoKeywords").trigger("keyup");
	});
	jQuery("#seoURL").on("keyup",function(){
		var su = jQuery(this).val();
		var seo_title_dash = jQuery("#seoTitle").val().split("-");
		//jQuery(".seo_url").html( seo_title_dash[seo_title_dash.length-1] + ".com" + su);;
		jQuery("#seoKeywords").trigger("keyup");
	});
	jQuery("#seoKeywords").on("keyup",function(){

	var sk = jQuery(this).val();
	if(jQuery.trim(sk).length > 0)
	{
		   
		var sk_words_orig = jQuery(this).val().split(" ");
		var seoTitle = jQuery("#seoTitle").val();
		var seo_title_dash = jQuery("#seoTitle").val().split("-");
		var st_words_orig = jQuery("#seoTitle").val().split(" ");
		var seoDesc = jQuery("#seoDesc").val();
		var sd_words_orig = jQuery("#seoDesc").val().split(" ");
		var seoURL = jQuery("#seoURL").val();
		var su_words_orig = jQuery("#seoURL").val().split("/");

		var st_words = new Array();
		var sk_words = new Array();
		var sd_words = new Array();
		var su_words = new Array();

		$.map( sk_words_orig, function( val, i ) {
  			sk_words.push(val.toLowerCase());
		});
		$.map( st_words_orig, function( val, i ) {
  			st_words.push(val.toLowerCase());
		});
		$.map( sd_words_orig, function( val, i ) {
  			sd_words.push(val.toLowerCase());
		});
		$.map( su_words_orig, function( val, i ) {
  			su_words.push(val.toLowerCase());
		});

		var str='';
		jQuery.each(st_words_orig,function(i,v){
			
			if ($.inArray(v.toLowerCase(), sk_words) !== -1)
			{
				str +='<strong> ' +v+'</strong>';
			}else{
				str += " " + 	v;
			}
		});

		jQuery(".seo_title").html(str);

		var desc_str='';
		jQuery.each(sd_words_orig,function(i,v){
						
			if ($.inArray(v.toLowerCase(), sk_words) !== -1)
			{
				desc_str +='<strong> ' +v+'</strong>';
			}else{
				desc_str += " " + 	v;
			}
		});
		jQuery(".seo_desc").html(desc_str);
		jQuery(".seo_url").html(seo_title_dash[seo_title_dash.length-1]);

		var su_str = seo_title_dash[seo_title_dash.length-1] + ".com";
		jQuery.each(su_words_orig,function(i,v){
						
			if ($.inArray(v.toLowerCase(), sk_words) !== -1)
			{
				su_str +='/<strong> '+v+'</strong>';
			}else{
				su_str +="/" + v;
			}
		});
		su_str += " <span> - Cached</span>"; 

		jQuery(".seo_url").html(su_str);
		
	}
});

jQuery("#seoKeywords").trigger("keyup");
	});
</script>

