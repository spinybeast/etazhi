<?php

namespace app\controllers;

use app\models\ConsultForm;
use app\models\Managers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\StaticPage;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        $model = new ConsultForm();

        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            Yii::$app->session->setFlash('consultFormSubmitted');

            return $this->refresh();
        }
        return $this->render('index', ['model' => $model]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        return $this->render('contact', [
            'managers' => Managers::find()->all(),
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionStatic($action)
    {
        $page = StaticPage::findOne(['pagekey' => $action, 'enabled' => 1]);
        $view = file_exists($this->viewPath . DIRECTORY_SEPARATOR . $action . '.php') ? $action : 'static';
        return $this->render($view, [
            'page' => $page
        ]);
    }

}
