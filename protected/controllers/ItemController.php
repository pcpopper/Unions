<?php

class ItemController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
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
            array('allow',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Item;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Item'])) {
            $model->attributes = $_POST['Item'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->item_id));
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
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Item'])) {
            $model->attributes = $_POST['Item'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->item_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
// we only allow deletion via POST request
            $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Item');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Item('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Item']))
            Item::model()->attributes = $_GET['Item'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionClaim(){
        $model = new ItemClaim('search');

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ItemClaim']))
            $model->attributes = $_GET['ItemClaim'];

        $this->render('//itemClaim/admin', array(
            'model' => $model,
        ));
    }

    public function actionClaimItem(){
        if (isset($_POST['ItemClaim'])) {
            $model = new ItemClaim();
            $model->attributes = $_POST['ItemClaim'];
            $item = Item::model()->findByPk($model->item_id);
            $item->status = 2;
            $item->save();

            if(!$model->validate()){
                throw new CHttpException(400);
            } else {
                $model->save();
                $item = new Item('search');
                $this->renderPartial('admin', array('model'=>$item), false, true);
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Item::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'item-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function setNavbar(){
        $this->navbar = array(
            array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'htmlOptions' => array('style' => 'padding-right: 10px;'),
                'items' => array(
                    array('label' => 'Back to Main', 'url' => array('/')),
                ),
            ),
            array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'htmlOptions' => array('class' =>'pull-right'),
                'items' => array(
                    array('label' => 'View All Items', 'url' => array('/lostandfound/index'), 'visible' => Yii::app()->user->isGuest),
                    array('label' => 'View All Items', 'url' => array('/lostandfound/admin'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Add Item', 'url' => array('/lostandfound/create')),
                    array('label' => 'Show Claimed Items', 'url' => array('claim'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Show Pending Items', 'url' => array('itemtype/admin'), 'visible' => !Yii::app()->user->isGuest),
                )
            )
        );
    }
}
