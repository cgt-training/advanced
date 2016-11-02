<?php

namespace backend\controllers;

use Yii;
use backend\models\AuthItem;
use backend\models\AuthItemChild;
use backend\models\SearchAuthItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends Controller
{
    /**
     * @inheritdoc
     */

    public $Auth_Item_Child_Arr;

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
        $query = AuthItem::find();

        $AuthItems = $query->orderBy('name')
                            ->where(['type' => '2'])
                            ->all();


        foreach ($AuthItems as $AuthItems_Sub):
            $this->Auth_Item_Child_Arr[$AuthItems_Sub->name] = $AuthItems_Sub->name;
        endforeach;
    }


    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchAuthItem();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $AuthUsers = AuthItem::find()->orderBy('name')
                                 ->where(['type'=>1])
                                 ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'AuthUsers' => $AuthUsers,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();
        $model->type=2;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAssignright()
    {
        $model = new AuthItem();
        $modelAuthItemChild = [new AuthItemChild];

        if ($model->load(Yii::$app->request->post())) {

                $modelAuthItemChild = $model::createMultiple(AuthItemChild::classname());
                $model::loadMultiple($modelAuthItemChild, Yii::$app->request->post());

                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelAuthItemChild),
                        ActiveForm::validate($model)
                    );
                }


                // validate all models
                $valid = $model->validate();
                $valid = $model::validateMultiple($modelAuthItemChild) && $valid;

                if ($valid || 1) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        $model->type=1;
                        if ($flag = $model->save(false)) {
                            foreach ($modelAuthItemChild as $modelAuthItemChild_1) {
                                $modelAuthItemChild_1->parent = $model->name;
                                if (! ($flag = $modelAuthItemChild_1->save(false))) {
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

            return $this->redirect(['index']);
        } else {
            return $this->render('assignright', [
                'model' => $model,
                'Auth_Item_Child_Arr' => $this->Auth_Item_Child_Arr,
                'modelAuthItemChild' => (empty($modelAuthItemChild)) ? [new AuthItemChild] : $modelAuthItemChild,
            ]);
        }
    }
}
