<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Department;
use frontend\models\Company;
use frontend\models\Branches;
use frontend\models\DepartmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends Controller
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

    function init()
    {
        $query = Company::find();
        $query1 = Branches::find();

        $Companies = $query->orderBy('c_name')
                            ->all();

        foreach ($Companies as $Company_sub_arr):
            $this->List_Company_Arr[$Company_sub_arr->c_id] = $Company_sub_arr->c_name;
        endforeach;

        $Branches = $query1->orderBy('br_name')
                            ->all();

        foreach ($Branches as $Branch_sub_arr):
            $this->List_Branches_Arr[$Branch_sub_arr->b_id] = $Branch_sub_arr->br_name;
        endforeach;
    }

    /**
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex()
    {
        $Send_Mail = Yii::$app->mailer->compose()
                         ->setFrom('pankajsharma55@gmail.com')
                         ->setTo('pankaj.sharma@cgt.co.in')
                         ->setSubject('Testing Mail...')
                         ->setTextBody('Plain text content')
                         ->setHtmlBody('<b>HTML content</b>')
                         ->send();

        
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Department model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
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
            return $this->renderAjax('notallowed');
            exit;
        }

        $model = new Department();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->dept_id]);
            $searchModel = new DepartmentSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
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
            return $this->renderAjax('notallowed');
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $searchModel = new DepartmentSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->renderAjax('update', [
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
            return $this->renderAjax('notallowed');
            exit;
        }

        $this->findModel($id)->delete();

        $searchModel = new DepartmentSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
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
