<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $short_description
 * @property string $long_description
 * @property integer $parent_id
 * @property string $created
 * @property string $modified
 */
class Category extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id', 'numerical', 'integerOnly' => true),
            //array('category_image', 'file', 'allowEmpty' => true, 'types' => 'jpg, gif, png'),
            array('category_image', 'file', 'allowEmpty' => true, 'types' => 'jpg, gif, png'),
            array('name, slug', 'length', 'max' => 255),
            array('name,short_description', 'required'),
            array('short_description, long_description, created, modified', 'safe'),
            array('parent_id', 'default', 'setOnEmpty' => true, 'value' => 0),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, slug, short_description, long_description, parent_id, created, modified', 'safe', 'on' => 'search'),
        );
    }

    public function beforeSave() {
        if ($this->isNewRecord)
            $this->created = new CDbExpression('NOW()');
        else
            $this->modified = new CDbExpression('NOW()');

        return parent::beforeSave();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'rel_parent_cat' => array(self::BELONGS_TO, 'Category', 'parent_id'),
            'rel_child_cat' => array(self::HAS_MANY, 'Category', 'parent_id', 'order' => 'id ASC'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'short_description' => 'Short Description',
            'long_description' => 'Long Description',
            'parent_id' => 'Parent',
            'created' => 'Created',
            'modified' => 'Modified',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('short_description', $this->short_description, true);
        $criteria->compare('long_description', $this->long_description, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
