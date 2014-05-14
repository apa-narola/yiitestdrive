<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $title
 * @property string $subTitle
 * @property string $image
 * @property string $shortDesc
 * @property string $longDesc
 * @property integer $status
 * @property string $created
 * @property string $updated
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
         public $selected_categories = array();
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, subTitle, shortDesc', 'required'),
                        array('image', 'file', 'allowEmpty' => true, 'types' => 'jpg, gif, png'),
                        array('longDesc','safe'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title, subTitle, image', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, subTitle, image, shortDesc, longDesc, status, created, updated', 'safe', 'on'=>'search'),
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
                    'categories' => array(self::MANY_MANY, 'Category', 'productCategory(categoryId,productId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'subTitle' => 'Sub Title',
			'image' => 'Image',
			'shortDesc' => 'Short Desc',
			'longDesc' => 'Long Desc',
			'status' => 'Status',
			'created' => 'Created',
			'updated' => 'Updated',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('subTitle',$this->subTitle,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('shortDesc',$this->shortDesc,true);
		$criteria->compare('longDesc',$this->longDesc,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
