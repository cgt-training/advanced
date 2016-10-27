<?php

namespace backend\controllers;

use Yii;
use backend\models\Company;
use backend\models\CompanySearch;
use backend\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
        /*echo "<pre>";
        print_r($_FILES);
        print_r($_REQUEST);
        exit;*/

        if(!yii::$app->user->can('create company'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        if ($model->load(Yii::$app->request->post())) {
     
            $Upload_Model = new UploadForm();

            if (Yii::$app->request->isPost) {
                
                $model->c_logo = UploadedFile::getInstance($model, 'c_logo');
                $Upload_Model->imageFile = UploadedFile::getInstance($model, 'c_logo');

                if ($Upload_Model->upload() || 1) {
                     if($model->save())
                     {
                        $searchModel = new CompanySearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        return $this->renderAjax('index', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                            ]);
                     }
                        //return $this->redirect(['view', 'id' => $model->c_id]);
                    else{
                           return $this->render('index', [
                            'model' => $model,
                        ]);
                    // file is uploaded successfully
                    //return;
                }
            }
            else{
                echo "Error in uploading";
                exit;
            }
        }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!yii::$app->user->can('edit company'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $Upload_Model = new UploadForm();

            if (Yii::$app->request->isPost) {
                $model->c_logo = UploadedFile::getInstance($model, 'c_logo');
                $Upload_Model->imageFile = UploadedFile::getInstance($model, 'c_logo');

                if ($Upload_Model->upload() || 1) {
                    if($model->save())
                    {
                        //return $this->redirect(['view', 'id' => $model->c_id]);
                        $searchModel = new CompanySearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        return $this->renderAjax('index', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                            ]);
                    }
                    else{
                           return $this->renderAjax('create', ['model' => $model,]);
                    // file is uploaded successfully
                    //return;
                }
            }
            else{
                echo "Error in uploading";
                exit;
            }
          }
      }
     else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!yii::$app->user->can('delete company'))
        {
            return $this->renderAjax('notallowed');
            exit;
        }

        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
