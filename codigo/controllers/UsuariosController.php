<?php

namespace app\controllers;

use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Usuarios models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Usuarios();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->setPassword($model->password); //Encriptamos las contraseñas antes de crear un nuevo modelo


                if ($model->save()) {
                    Yii::$app->session->setFlash('sucess', 'Usuario creado correctamente'); //mensaje de éxito
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {

                    Yii::$app->session->setFlash('error', 'No se ha podido crear el nuevo usuario'); //mensaje de error
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            //si hay cambiamos en la contaseña la encriptamos otra vez
            if ($model->password) {
                $model->setPassword($model->password);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('sucess', 'El usuario ha sido actualizado'); //mensaje de éxito
                return $this->redirect(['view', 'id' => $model->id]);
            } else {

                Yii::$app->session->setFlash('error', 'Error al actualizar'); //mensaje de error
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }




    /**
     * Accion de registro de un nuevo usuario en la aplicación
     */


    public function actionRegistro()
    {
        $model = new Usuarios();
        //Comprobamos si se ha enviado el formulario
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->registro_confirmado = 0;
                $model->fecha_registro = date('Y-m-d H:i:s');
                $model->accesos_fallidos = 0;
                $model->bloqueado = 0;
                $model->rol = 5;

                //Encriptamos la contraseña
                $model->setPassword($model->password);

                $model->registro_confirmado = 0; //sera 0 hasta que un admin y la acepte


                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Registro correcto. Espera hasta que tu cuenta sea aceptada');
                    return $this->redirect(['site/login']);
                } else {
                    Yii::$app->session->setFlash('error', 'Error al registrar el usuario.');
                }
            }
        }
        return $this->render('registro', [
            'model' => $model,
        ]);
    }



    /**
     * Accion para acceder a la vista de gestion de usuarios por parte del administrador de la aplicación
     */

    public function actionFichaUsuariosAdmin()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('fichaUsuariosAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    /**
     * Accion para confirmar un usuario en la aplicacion por parte del administrador
     */

    public function actionConfirmarUsuario($id)
    {
        //Buscamos el usuario por su id y modificamos el valor de resgitro 1 
        $model = $this->findModel($id);

        if ($model->registro_confirmado == 0) {
            $model->registro_confirmado = 1;
            $model->save(false); //no se vuelve a validar
            Yii::$app->session->setFlash('success', 'Usuario confirmado.');
        } else {
            Yii::$app->session->setFlash('info', 'Este usuario ya está confirmado.');
        }

        return $this->redirect(['ficha-usuarios-admin']);
    }


    /**
     * Accion de administrador para bloquear o desbloquear a los usuarios
     */

    public function actionBloquearUsuario($id)
    {
        //Buscar usuario con ese id
        $model = $this->findModel($id);

        //comprobamos si esta bloqueado o no el usuario
        if ($model->bloqueado == 1) {


            $model->bloqueado = 0;
            //Modificamos valores en base de datos 
            $model->fecha_bloqueo = null;
            $model->motivo_bloqueo = null;
            Yii::$app->session->setFlash('success', 'El usuario ha sido desbloqueado.');
        } else { //Si no se bloquea modificando la fecha y el motivo

            $model->bloqueado = 1;
            //Modificamos valores en base de datos 
            $model->fecha_bloqueo = date('Y-m-d H:i:s');
            $model->motivo_bloqueo = 'Bloqueado por el Administrador';
            Yii::$app->session->setFlash('success', 'El usuario ha sido bloqueado.');
        }

        $model->save(false); //guardamos las modificaciones realizadas

        //redirigir a la ficha del administrador
        return $this->redirect(['ficha-usuarios-admin']);
    }
}
