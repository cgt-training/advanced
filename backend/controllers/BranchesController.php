<?php

namespace backend\controllers;

use Yii;
use backend\models\Branches;
use backend\models\Company;
use backend\models\BranchesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
{
    /**
     * @inheritdoc
     */
    public $List_Company_Arr;
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
        $query = Company::find();

        $Companies = $query->orderBy('c_name')
                            ->all();
        foreach ($Companies as $Company_sub_arr):
            $this->List_Company_Arr[$Company_sub_arr->c_id] = $Company_sub_arr->c_name;
        endforeach;
    }

    /**
     * Lists all Branches models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //$this->layout = '';
        if(!yii::$app->user->can('create branch'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        $model = new Branches();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->b_id]);
            $searchModel = new BranchesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            exit;
            //return $this->renderAjax('index');
            //exit;
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'List_Company_Arr'=>$this->List_Company_Arr,
            ]);
        }
    }

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!yii::$app->user->can('Edit branch'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            {
                //return $this->redirect(['view', 'id' => $model->b_id]);
                //$model = new Branches();

                //return $this->redirect(['index']);
                $searchModel = new BranchesSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->renderAjax('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'List_Company_Arr'=>$this->List_Company_Arr,
            ]);
        }
    }

    /**
     * Deletes an existing Branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!yii::$app->user->can('delete branch'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        $this->findModel($id)->delete();

        $model = new Branches();

        //return $this->redirect(['index']);
        $searchModel = new BranchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branches::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
