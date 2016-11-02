<?php

namespace backend\controllers;

use Yii;
use backend\models\Company;
use backend\models\Branches;
use backend\models\CompanySearch;
use backend\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


class AuthItemController extends Controller
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
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        return $this->render('view', [
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
        $model = new AuthItemChild();
        $modelBranches = [new AuthItemChild];
        //$modelBranches = [new Address];
        /*echo "<pre>";
        print_r($_FILES);
        print_r($_REQUEST);
        exit;*/

        if(!yii::$app->user->can('create company'))
        {
            return $this->render('notallowed');
            exit;
        }

        if ($model->load(Yii::$app->request->post())) {
     
            $Upload_Model = new UploadForm();

            if (Yii::$app->request->isPost) {
                
                $model->c_logo = UploadedFile::getInstance($model, 'c_logo');
                $Upload_Model->imageFile = UploadedFile::getInstance($model, 'c_logo');

                $modelBranches = $model::createMultiple(Branches::classname());
                $model::loadMultiple($modelBranches, Yii::$app->request->post());

                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelBranches),
                        ActiveForm::validate($model)
                    );
                }

                // validate all models
                $valid = $model->validate();
                $valid = $model::validateMultiple($modelBranches) && $valid;

                if ($valid || 1) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {

                        $Upload_Model->upload();

                        if ($flag = $model->save(false)) {
                            foreach ($modelBranches as $modelBranches) {
                                $modelBranches->c_id = $model->c_id;
                                if (! ($flag = $modelBranches->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['index',]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }

                return $this->redirect(['index',]);

                /*if ($Upload_Model->upload() || 1) {
                     if($model->save())
                     {
                        $searchModel = new CompanySearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        return $this->render('index', [
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
            }*/
        }
        } else {

            return $this->render('create', [
                'model' => $model,
                'modelBranches' => (empty($modelBranches)) ? [new Branches] : $modelBranches
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
            return $this->render('notallowed');
            exit;
        }

        $model = $this->findModel($id);
        $modelBranches = $model->branches;

        if ($model->load(Yii::$app->request->post())) {

            $Upload_Model = new UploadForm();

            if (Yii::$app->request->isPost) {
                $model->c_logo = UploadedFile::getInstance($model, 'c_logo');
                $Upload_Model->imageFile = UploadedFile::getInstance($model, 'c_logo');

                if ($Upload_Model->upload() || 1) {

                  $oldIDs = ArrayHelper::map($modelBranches, 'b_id', 'b_id');

                  $modelBranches = $model::createMultiple(Branches::classname(), $modelBranches);

                  $model::loadMultiple($modelBranches, Yii::$app->request->post());
                  $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelBranches, 'b_id', 'b_id')));

                  // ajax validation
                  if (Yii::$app->request->isAjax) {
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      return ArrayHelper::merge(
                          ActiveForm::validateMultiple($modelBranches),
                          ActiveForm::validate($model)
                      );
                  }

                  // validate all models
                  $valid = $model->validate();
                  $valid = $model::validateMultiple($modelBranches) && $valid;
                  
                  if (1) {
                      $transaction = \Yii::$app->db->beginTransaction();
                      try {
                          if ($flag = $model->save(false)) {
                              if (! empty($deletedIDs)) {
                                  Branches::deleteAll(['b_id' => $deletedIDs]);
                              }
                              foreach ($modelBranches as $modelBranch) {
                                  $modelBranch->c_id = $model->c_id;
                                  //echo "<pre>";
                                  //print_r($modelBranch);
                                  //exit;
                                  if (! ($flag = $modelBranch->save(false))) {
                                      $transaction->rollBack();
                                      break;
                                  }
                              }
                          }
                          if ($flag) {
                              $transaction->commit();
                              return $this->redirect(['index',]);
                          }
                      } catch (Exception $e) {
                          $transaction->rollBack();
                      }
                  }
                    /*if($model->save())
                    {
                        //return $this->redirect(['view', 'id' => $model->c_id]);
                        $searchModel = new CompanySearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        return $this->render('index', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                            ]);
                    }
                    else{
                           return $this->render('create', ['model' => $model,]);
                    // file is uploaded successfully
                    //return;
                }*/
            }
            else{
                echo "Error in uploading";
                exit;
            }
          }
      }
     else {
            return $this->render('update', [
                'model' => $model,
                'modelBranches' => $modelBranches,
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
            return $this->render('notallowed');
            exit;
        }

        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
