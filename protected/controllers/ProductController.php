<?php

class ProductController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $model = new Product;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Product'])) {

            $model->attributes = $_POST['Product'];
            $model->image = CUploadedFile::getInstance($model, 'image');
            $file_flyer = CUploadedFile::getInstance($model, 'image');
            if ($model->validate()) {
                if ((is_object($file_flyer) && get_class($file_flyer) === 'CUploadedFile')) {
                    ##make new name for product image
                    //$ext = $file_flyer->getExtensionName();
                    $newname = time() . "_" . $model->image->name;
                    //$newname = $imagename . "." . $ext;
                    $product_images_path = realpath(Yii::app()->basePath . '/../images/products');
                    $file_flyer->saveAs($product_images_path . '/' . $newname);
                    $model->image = $newname;
                }

                if ($model->save()) {
                    /* ##make new directory its name as product id
                      $create_dir = 'images/products/' . $model->id;
                      if (!is_dir($create_dir))
                      mkdir($create_dir, 0777);
                      ##save image to product id dir
                      $product_images_path = realpath(Yii::app()->basePath . '/../' . $create_dir);
                      ##set new name for product image - to store it in db
                      $model->image->saveAs($product_images_path . '/' . $newname); */
                    if (isset($_POST["categories"]) && !empty($_POST["categories"])) {
                        $command = Yii::app()->db->createCommand();
                        $productId = $model->id;
                        $command->delete('productcategory', 'productId=:pid', array(':pid' => $productId));
                        $command->execute();

                        $sql = "INSERT INTO productcategory (productId,categoryId,created) VALUES ";
                        $is_first = 1;
                        foreach ($_POST["categories"] as $c_key => $c_val) {
                            $sql .= $is_first == 1 ? "" : ",";
                            $created = date('Y-m-d H:i:s');
                            $sql .= " ( '$productId','$c_val','$created') ";
                            $is_first++;
                        }
                        $command = Yii::app()->db->createCommand($sql);
                        $command->execute();
                    }


                    $this->redirect(array('view', 'id' => $model->id));
                }
            } else {
                print_r($model->errors);
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $selected_categories = array();
        foreach ($model->categories as $ck => $cv) {
            $selected_categories[$cv->id] = array("selected"=>"selected");
        }
        //pr($selected_categories);
        
        //pr($selected_category_ids);
        //$products = Product::model()->with('categories')->findAll();
        /* $selected_categories = Yii::app()->db->createCommand(array(
          'select' => array('id', 'categoryId'),
          'from' => 'productCategory',
          'where' => 'productId=:pid',
          'params' => array(':pid' => $id),
          ))->queryAll(); */
        //pr($selected_categories);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Product'])) {

            $model->attributes = $_POST['Product'];
            $old_imagename = $model->image;

            $file_flyer = CUploadedFile::getInstance($model, 'image');

            if ((is_object($file_flyer) && get_class($file_flyer) === 'CUploadedFile')) {
                $model->image = $file_flyer;
                ##make new name for product image
                //$ext = $model->image->getExtensionName();
                $newname = time() . "_" . $model->image->name;
                //$newname = $imagename . "." . $ext;
                /* ##make new directory its name as product id
                  $create_dir = 'images/products/' . $model->id;
                  if (!is_dir($create_dir))
                  mkdir($create_dir, 0777);
                  ##save image to product id dir
                  $product_images_path = realpath(Yii::app()->basePath . '/../images/products/' . $create_dir);
                  $model->image->saveAs($product_images_path . '/' . $newname); */

                $product_images_path = realpath(Yii::app()->basePath . '/../images/products');
                $model->image->saveAs($product_images_path . '/' . $newname);


                ##Remove old product image
                if (file_exists($product_images_path . '/' . $old_imagename))
                    unlink($product_images_path . '/' . $old_imagename);

                ##set new name for product image - to store it in db
                $model->image = $newname;
            }
            if ($model->validate()) {
                if ($model->save()) {
                    if (isset($_POST["categories"]) && !empty($_POST["categories"])) {
                        $command = Yii::app()->db->createCommand();
                        $productId = $model->id;
                        $command->delete('productcategory', 'productId=:pid', array(':pid' => $productId));
                        $command->execute();
                        $command->reset();

                        $insert_sql = "INSERT INTO productcategory (productId,categoryId,updated) VALUES ";
                        $is_first = 1;
                        foreach ($_POST["categories"] as $c_key => $c_val) {
                            $insert_sql .= $is_first == 1 ? "" : ",";
                            $updated = date('Y-m-d H:i:s');
                            $insert_sql .= " ( '$productId','$c_val','$updated') ";
                            $is_first++;
                        }
                        $command = Yii::app()->db->createCommand($insert_sql);
                        $command->execute();
                        $command->reset();
                    }
                    $this->redirect(array('view', 'id' => $model->id));
                }
            } else {
                print_r($model->errors);
            }
        }
        $model->selected_categories = $selected_categories;
        $this->render('update', array(
            'model' => $model,
            ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Product');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Product::model()->with('categories')->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Product $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
