<?php

namespace backend\controllers;

use Yii;
use common\models\Department;
use common\models\Company;
use common\models\Branches;
use common\models\DepartmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\components\CommonFunctionController;

/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends CommonFunctionController
{
    /**
     * @inheritdoc
     */
    public $List_Company_Arr;
    public $List_Branches_Arr;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    function init()
    {
        $Companies = Company::find()->orderBy('c_name')->all();

        $Branches = Branches::find()->orderBy('br_name')->all();

        $this->List_Company_Arr = ArrayHelper::map($Companies,'c_id','c_name');
        $this->List_Branches_Arr = ArrayHelper::map($Branches,'b_id','br_name');
    }

    /**
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$Send_Mail = Yii::$app->mailer->compose()
                         ->setFrom('pankajsharma55@gmail.com')
                         ->setTo('pankaj.sharma@cgt.co.in')
                         ->setSubject('Testing Mail...')
                         ->setTextBody('Plain text content')
                         ->setHtmlBody('<b>HTML content</b>')
                         ->send();
        */
        
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $Department_Arr = Department::find()->orderBy('dept_name')
                                            ->joinWith('branch')
                                            ->joinWith('company')
                                            ->all();
                                            

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Department_Arr' => $Department_Arr,
        ]);
    }

    /**
     * Displays a single Department model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!yii::$app->user->can('create department'))
        {
            return $this->render('notallowed');
            exit;
        }

        $model = new Department();

        if ($model->load(Yii::$app->request->post())) {

            $model->dept_id = $this->getMaxId('department','dept_id');
            $model->dept_created_date = date('Y-m-d H:i:s');

            if(!$model->save()){
                \Yii::$app->getSession()->setFlash('response_msg', 'Record not saved..');
            }
            //return $this->redirect(['view', 'id' => $model->dept_id]);
            //$searchModel = new DepartmentSearch();
            //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            \Yii::$app->getSession()->setFlash('response_msg', 'Record Saved Successful..');

            return $this->redirect('index');
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'List_Company_Arr' => $this->List_Company_Arr,
                'List_Branches_Arr' => $this->List_Branches_Arr,
            ]);
        }
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!yii::$app->user->can('edit department'))
        {
            return $this->render('notallowed');
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //$searchModel = new DepartmentSearch();
            //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            \Yii::$app->getSession()->setFlash('response_msg', 'Record Updated successfully..');
            return $this->redirect('index');

        } else {
            return $this->render('update', [
                'model' => $model,
                'List_Company_Arr' => $this->List_Company_Arr,
                'List_Branches_Arr' => $this->List_Branches_Arr,
            ]);
        }
    }

    /**
     * Deletes an existing Department model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!yii::$app->user->can('delete department'))
        {
            return $this->render('notallowed');
            exit;
        }

        $this->findModel($id)->delete();

        //$searchModel = new DepartmentSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        \Yii::$app->getSession()->setFlash('response_msg', 'Record deleted successfully..');

        return $this->redirect('index');
    }

    public function actionGetbranch($Company_Id = null)
    {
        if(isset($_REQUEST['c_id']) && $_REQUEST['c_id']){
            $model = new Branches();

            $query1 = Branches::find();
            $List_Branches_Arr = array();
        
            $Branches = $query1->orderBy('br_name')
                                ->where(['c_id' => $_REQUEST['c_id']])
                                ->all();

            foreach ($Branches as $Branch_sub_arr):
                $List_Branches_Arr[$Branch_sub_arr->b_id] = $Branch_sub_arr->br_name;
            endforeach;

            return $this->render('getbranch', [
                'model' => $model,
                'List_Branches_Arr' => $List_Branches_Arr,
            ]);
        }
    }

    /**
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Department the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
