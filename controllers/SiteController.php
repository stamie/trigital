<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['password'])){
            $user = new Users(); 
            $user->fullname = $_POST['fullname'];
            $user->username = $_POST['username'];
            $user->is_use = (isset($_POST['is_use'])&&$_POST['is_use']=="on")?1:0;
            $user->userpassword = $_POST['password'];
            $user->save(); 
            $this->redirect(["site/users"]);

        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->POST()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionUsers()
    {
        $request = Yii::$app->request;
        $condition = [];
        
        if ($request->get('status')) {
            $status = intval($request->get('status')) - 1;
            $condition['is_use'] = $status;
        }
        $users = Users::find()->where($condition);
        if ($request->get('orderby')) {
            switch ($request->get('orderby')) {
                case 'fullname':
                    $users = $users->orderBy('fullname');
                    break;
                case 'username':
                    $users = $users->orderBy('username');
                    break;
                
            }
        }
        $allUsers = $users->all();

        return $this->render('users', ['allUsers' => $allUsers]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionRawmaterials()
    {
        return $this->render('rawmaterials');
    }
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionRecepts()
    {
        return $this->render('recepts');
    }
}
