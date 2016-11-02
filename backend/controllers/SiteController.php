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
        $Company_Arr = Company::find()->all();

        $comp_count = count($Company_Arr);

        /* Branches Count */

        $Branch_Arr = Branches::find()->all();

        $bran_count = count($Branch_Arr);

        /* Department Count */

        $Dept_Arr = Department::find()->all();

        //$dept_count = $Dept_Arr->department_count;
        $dept_count = count($Dept_Arr);

        /* Customer Count */

        $Cust_Arr = Customer::find()->all();

        //$cust_count = $Cust_Arr->customer_count;
        
        $cust_count = count($Cust_Arr);

        return $this->render('index',
                                    [
                                        'Company_Arr'=>$Company_Arr,'company_count'=>$comp_count,
                                        'Branch_Arr' => $Branch_Arr, 'branch_count'=>$bran_count,
                                        'Dept_Arr'=>$Dept_Arr, 'department_count'=>$dept_count,
                                        'Cust_Arr'=>$Cust_Arr, 'customer_count' => $cust_count,
                                    ]
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
                \Yii::$app->getSession()->setFlash('response_msg', 'You are not allowed to access this page..');
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
