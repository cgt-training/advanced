<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Company;
use backend\models\Branches;
use backend\models\Department;
use backend\models\Customer;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */


    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /* Company Count */
        $Company_Arr = Company::find()
                            ->select(['COUNT(*) AS company_count'])
                            ->all();

        $comp_count = $Company_Arr[0]['company_count'];

        /* Branches Count */

        $Branch_Arr = Branches::find()
                                ->select(['COUNT(*) AS branch_count'])
                                ->all();

        $bran_count = $Branch_Arr[0]['branch_count'];

        /* Department Count */

        $Dept_Arr = Department::find()
                                ->select(['COUNT(*) AS department_count'])
                                ->all();

        //$dept_count = $Dept_Arr->department_count;
        $dept_count = $Dept_Arr[0]['department_count'];

        /* Customer Count */

        $Cust_Arr = Customer::find()
                                ->select(['COUNT(*) AS customer_count'])
                                ->all();

        //$cust_count = $Cust_Arr->customer_count;
        
        $cust_count = $Cust_Arr[0]['customer_count'];

        return $this->render('index',
                                    ['company_count'=>$comp_count,'branch_count'=>$bran_count,
                                    'department_count'=>$dept_count,'customer_count' => $cust_count,]
                            );
        //exit;
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $User_Arr = Yii::$app->user->identity->toArray();
            if($User_Arr['role']=='admin'){
                return $this->goBack();
            }
            else
            {
                Yii::$app->user->logout();
                return $this->goHome();
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
