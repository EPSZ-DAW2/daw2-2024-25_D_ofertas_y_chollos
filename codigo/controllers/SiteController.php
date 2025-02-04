<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Ofertas;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                    'logout' => ['post', 'get'],
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
        $recientes = Ofertas::find()
            ->where(['estado' => 'visible'])
            ->orderBy(['fecha_creacion' => SORT_DESC])
            ->limit(9)
            ->all();
    
        return $this->render('index', [
            'recientes' => $recientes,
        ]);
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
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $usuario = Yii::$app->user->identity; // Obtiene el modelo del usuario autenticado


            //Comprobar si ya ha sido confirmado el usuario si no debe esperar a ser aceptado
            if (!$usuario->usuarioConfirmado()) {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'Tu cuenta no está confirmada. Espera la confirmación del administrador.');
                return $this->redirect(['site/login']);
            }



            $fechaUltimoAccesoAnterior = $usuario->fecha_ultimo_acceso; //Guardamos su ultima fecha antes para las notificaciones

            //Guardamos la variable en sesion
            Yii::$app->session->set('fechaUltimoAccesoAnterior', $fechaUltimoAccesoAnterior);


            $usuario->fecha_ultimo_acceso = date('Y-m-d H:i:s'); // Actualizamos la fecha y hora actuales
            $usuario->save(false);



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
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
