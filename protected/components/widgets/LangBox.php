<?php
class LangBox extends CWidget
{
    public function run()
    {
        $currentLang = Yii::app()->language;
	$languages = Yii::app()->params->languages;
        $this->render('langBox', array('currentLang' => $currentLang, 'languages'=>$languages));
    }
}
?>