<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\RecuperarForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * Devuelve un listado con los comportamientos del componente.
     * @return mixed
     */
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

    /**
     * Devuelve parametros de configuración
     * @return mixed
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
     * Muestra la página principal.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Permite realizar la acción de login.
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
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Permite realizar la acción de logout.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Muestra la página de contacto.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Muestra un formulario y envia un email al correo indicado en el formulario,
     * para que el usuario pueda recuperar su contraseña.
     * @return mixed
     */
    public function actionRecuperar()
    {
        $model = new RecuperarForm;
        if ($model->load(Yii::$app->request->post())) {
            $usuario = Usuario::findOne(['email' => $model->email]);
            if ($usuario !== null) {
                $model->sendEmail();
                Yii::$app->session->setFlash('emailEnviado');

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('emailInvalido');

                return $this->render('recuperar', [
                    'model' => $model,
                ]);
            }
        }
        return $this->render('recuperar', [
            'model' => $model,
        ]);
    }

    /**
     * Modifica la contraseña del usuario por una nueva.
     * @return mixed
     */
    public function actionCambiar()
    {
        $model = new RecuperarForm([
            'scenario' => RecuperarForm::ESCENARIO_RECUPERAR,
        ]);
        if ($model->load(Yii::$app->request->post())) {
            $usuario = Usuario::findOne(['token' => $model->token]);
            if ($usuario !== null) {
                $model->cambiarContrasenia();
                Yii::$app->session->setFlash('contraseniaCambiada');

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('tokenInvalido');

                return $this->render('cambiar', [
                    'model' => $model,
                ]);
            }
        }
        return $this->render('cambiar', [
            'model' => $model,
        ]);
    }

    /**
     * Muestra la página de about.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
