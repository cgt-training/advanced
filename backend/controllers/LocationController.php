<?php

namespace backend\controllers;

use Yii;
use backend\models\Location;
use backend\models\LocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

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
                /*'actions' => [
                    'delete' => ['POST'],
                ],*/
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

        $Locations = Location::find()->select(['loc_id','zip_code','city','province'])
                                    ->orderBy('zip_code')
                                    ->all();

        return $this->render('index', 
                ['searchModel' => $searchModel,'dataProvider' => $dataProvider,'Locations_Data' => $Locations,]);
    }

    /**
     * Displays a single Location model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id),]);
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
            return $this->render('notallowed');
            exit;
        }

        $model = new Location();

        if ($model->load(Yii::$app->request->post())) {

            $command = (new \yii\db\Query())
                                ->select(['MAX(loc_id)+1 as L_Max_Id'])
                                ->from('location')
                                ->createCommand();

            // returns all rows of the query result
            $rows = $command->queryAll();
            $model->loc_id = $rows[0]['L_Max_Id'];
            if(!$model->save()){
                \Yii::$app->getSession()->setFlash('response_msg', 'Record not saved..');
            }

            $searchModel = new LocationSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $Locations = Location::find()->select(['loc_id','zip_code','city','province'])
                                    ->orderBy('zip_code')
                                    ->all();

            \Yii::$app->getSession()->setFlash('response_msg', 'Record Saved Successfully..');

            return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,'Locations_Data' => $Locations,]);

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
            return $this->render('notallowed');
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->loc_id]);
            $searchModel = new LocationSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $Locations = Location::find()->select(['loc_id','zip_code','city','province'])
                                    ->orderBy('zip_code')
                                    ->all();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'Locations_Data' => $Locations,
            ]);
        } else {
            return $this->render('update', ['model' => $model,]);
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
            return $this->render('notallowed');
            exit;
        }

        $this->findModel($id)->delete();

        $searchModel = new LocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $Locations = Location::find()->select(['loc_id','zip_code','city','province'])
                                    ->orderBy('zip_code')
                                    ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Locations_Data' => $Locations,
        ]);
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
