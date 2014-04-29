<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id
 * @property string $page_title
 * @property string $page_content
 * @property string $menu_option
 * @property string $sitemap_visibility
 * @property string $seo_title
 * @property string $focus_keywords
 * @property string $meta_desc
 */
class Page extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_title, page_content, menu_option, sitemap_visibility, seo_title, focus_keywords, meta_desc,meta_url', 'required'),
			array('page_title, seo_title, focus_keywords, meta_desc', 'length', 'max'=>255),
			array('menu_option', 'length', 'max'=>8),
			array('sitemap_visibility', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, page_title, page_content, menu_option, sitemap_visibility, seo_title, focus_keywords, meta_desc,meta_url', 'safe', 'on'=>'search'),
		);
	}

	    
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'page_title' => 'Page Title',
			'page_content' => 'Page Content',
			'menu_option' => 'Menu Option',
			'sitemap_visibility' => 'Sitemap Visibility',
			'seo_title' => 'Seo Title',
			'focus_keywords' => 'Focus Keywords',
			'meta_desc' => 'Meta Description',
			'meta_url' => 'Meta URL'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_content',$this->page_content,true);
		$criteria->compare('menu_option',$this->menu_option,true);
		$criteria->compare('sitemap_visibility',$this->sitemap_visibility,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('focus_keywords',$this->focus_keywords,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('meta_url',$this->meta_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
