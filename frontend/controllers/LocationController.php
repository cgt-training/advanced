<?php

namespace frontend\controllers;

use Yii;
use common\models\Location;
use common\models\LocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LocationController implements the CRUD actions for Location model.
 */
class LocationController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single Location model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Creates a new Location model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!yii::$app->user->can('create location'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        $model = new Location();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $searchModel = new LocationSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->renderAjax('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,]);

            //return $this->redirect(['view', 'id' => $model->loc_id]);
        } else {
            return $this->renderAjax('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing Location model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!yii::$app->user->can('edit location'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->loc_id]);
            $searchModel = new LocationSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->renderAjax('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Location model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!yii::$app->user->can('delete location'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        $this->findModel($id)->delete();

        $searchModel = new LocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,]);
        //return $this->redirect(['index']);
    }

    /**
     * Finds the Location model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Location the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Location::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
