<?php
$controller_id = $this->id;
$action_id = $this->action->id;
//Yii::app()->controller->id and Yii::app()->controller->action->id
$menu = $controller_id . "_menu";
switch ($action_id) {
    case 'index':
        $this->$menu = array(
            array('label' => 'Create '.ucfirst($controller_id), 'url' => array('create')),
            array('label' => 'Manage '.ucfirst($controller_id), 'url' => array('admin')),
        );
        break;
    case 'admin':
        $this->$menu = array(
            array('label' => 'List '.ucfirst($controller_id), 'url' => array('index')),
            array('label' => 'Create '.ucfirst($controller_id), 'url' => array('create')),
        );
        break;
    case 'create':
        $this->$menu = array(
            array('label' => 'List '.ucfirst($controller_id), 'url' => array('index')),
            array('label' => 'Manage '.ucfirst($controller_id), 'url' => array('admin')),
        );
        break;
    case 'update':
        $this->$menu = array(
            array('label' => 'List '.ucfirst($controller_id), 'url' => array('index')),
            array('label' => 'Create '.ucfirst($controller_id), 'url' => array('create')),
            array('label' => 'View '.ucfirst($controller_id), 'url' => array('view', 'id' => $model->id)),
            array('label' => 'Manage '.ucfirst($controller_id), 'url' => array('admin')),
        );
        break;
    case 'view':
        $this->$menu = array(
            array('label' => 'List '.ucfirst($controller_id), 'url' => array('index')),
            array('label' => 'Create '.ucfirst($controller_id), 'url' => array('create')),
            array('label' => 'Update '.ucfirst($controller_id), 'url' => array('update', 'id' => $model->id)),
            array('label' => 'Delete '.ucfirst($controller_id), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
            array('label' => 'Manage '.ucfirst($controller_id), 'url' => array('admin')),
        );
        break;

    default:
        break;
}
 
?>