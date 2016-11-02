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

        $Company_Arr = Company::find()->orderBy('c_name')
                              ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Company_Arr' => $Company_Arr,
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
        $model = new Company();
        $modelBranches = [new Branches];
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

                $command = (new \yii\db\Query())
                                ->select(['MAX(c_id)+1 as C_Max_Id'])
                                ->from('company')
                                ->createCommand();

                // returns all rows of the query result
                $rows = $command->queryAll();
                
                $model->c_id = $rows[0]['C_Max_Id'];
                $model->c_start_date = date('Y-m-d H:i:s');
                $model->c_create_date = date('Y-m-d H:i:s');


                $branch_command = (new \yii\db\Query())
                                 ->select(['MAX(b_id)+1 as B_Max_Id'])
                                  ->from('branches')
                                  ->createCommand();

                // returns all rows of the query result
                $branches_rows = $branch_command->queryAll();
                $Max_Branch_Id = $branches_rows[0]['B_Max_Id'];
                
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

                
                // $errors = $model->errors;
                // print_r($errors);

               // exit;

                $Error_Msg = '';

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {

                        $Upload_Model->upload();

                        if ($flag = $model->save(false)) {
                            foreach ($modelBranches as $modelBranches) {

                                $modelBranches->b_id = $Max_Branch_Id;
                                $modelBranches->c_id = $model->c_id;
                                $modelBranches->br_created = date('Y-m-d H:i:s');

                                if (! ($flag = $modelBranches->save(false))) {
                                    $transaction->rollBack();
                                    \Yii::$app->getSession()->setFlash('response_msg', 'Record Not Saved ..');
                                    break;
                                }
                                $Max_Branch_Id++;
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            \Yii::$app->getSession()->setFlash('response_msg', 'Record Save Successful..');                            
                            return $this->redirect(['index',]);
                        }
                    } catch (Exception $e) {
                        \Yii::$app->getSession()->setFlash('response_msg', 'Record Not Saved ..');
                        $transaction->rollBack();
                    }
                }
                else
                  {
                    $errors = $model->errors;
                    if(isset($errors['c_email'][0]) && $errors['c_email'][0])
                      $Error_Msg = $errors['c_email'][0];

                    if(isset($errors['c_name'][0]) && $errors['c_name'][0])
                      $Error_Msg = $errors['c_name'][0];
                  }
                  
                \Yii::$app->getSession()->setFlash('response_msg', $Error_Msg);

                return $this->redirect(['index',]);

                /*if ($Upload_Model->upload() || 1) {
                     if($model->save())
                     {
                        $searchModel = new CompanySearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        return $this->render('index', [
                                'searchModel' => $searchModel,
                                'recordProvider' => $dataProvider,
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
                              \Yii::$app->getSession()->setFlash('response_msg', 'Record Updated Successful..');
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
                \Yii::$app->getSession()->setFlash('response_msg', 'Error in file uploading..');
                return $this->redirect(['index',]);
            }
          }
      }
     else {
            return $this->render('update', [
                'model' => $model,
                'modelBranches' => (empty($modelBranches)) ? [new Branches] : $modelBranches,
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
      
        \Yii::$app->getSession()->setFlash('response_msg', 'Record deleted successfully..');

        return $this->redirect(['index',]);
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
