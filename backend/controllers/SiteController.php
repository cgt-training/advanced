<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Company;
use common\models\Branches;
use common\models\Department;
use common\models\Customer;

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
        $Company_Arr = Company::find()->orderBy('c_name')->all();

        $comp_count = count($Company_Arr);

        /* Branches Count */

        $Branches_Arr = Branches::find()->select(['branches.*','company.c_name'])
                                         ->orderBy('br_name')
                                          ->joinWith('company')
                                          ->all();

        $bran_count = count($Branches_Arr);

        /* Department Count */

        $Department_Arr = Department::find()->orderBy('dept_name')
                                            ->joinWith('branch')
                                            ->joinWith('company')
                                            ->all();

        //$dept_count = $Dept_Arr->department_count;
        $dept_count = count($Department_Arr);

        /* Customer Count */

        $Customer_Arr = Customer::find()->orderBy('cust_name')->all();

        //$cust_count = $Cust_Arr->customer_count;
        
        $cust_count = count($Customer_Arr);

        return $this->render('index',
                                    [
                                        'Company_Arr'=>$Company_Arr,'company_count'=>$comp_count,
                                        'Branches_Arr' => $Branches_Arr, 'branch_count'=>$bran_count,
                                        'Department_Arr'=>$Department_Arr, 'department_count'=>$dept_count,
                                        'Customer_Arr'=>$Customer_Arr, 'customer_count' => $cust_count,
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
