<?php

namespace app\controllers;

use app\models\Usuarios;
use app\models\Roles;
use app\models\Mensajes;
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
                        'delete' => ['POST', 'GET'],
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
        $roles = Roles::getListaRoles();



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
            'roles' => $roles, //pasamos roles para el desplegable
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


        $roles = Roles::getListaRoles();

        if ($this->request->isPost && $model->load($this->request->post())) {
            //si hay cambiamos en la contaseña la encriptamos otra vez
            if (empty($model->password)) {
                $model->password = $model->getOldAttribute('password');
            } else {
                // Si se introduce una nueva contraseña la encriptamos
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
            'roles' => $roles,
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

        Yii::$app->session->setFlash('sucess', 'Usuario eliminado correctamente');

        return $this->redirect(['ficha-usuarios-admin']);
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
            if ($model->load($this->request->post()) && $model->validate()) {



                //Encriptamos la contraseña
                $model->setPassword($model->password);
                //Valores predeterminados
                $model->registro_confirmado = 0; //sera 0 hasta que un admin y la acepte
                $model->fecha_registro = date('Y-m-d H:i:s');
                $model->accesos_fallidos = 0;
                $model->bloqueado = 0;
                $model->rol = 5;



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
            $model->accesos_fallidos = 0; //iniciamos a 0 los intentos del usario una vez se le desbloquea
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






    /**
     * Cambio de campos de su perfil de usuario
     * @return string|Yii\web\Response
     */
    public function actionMiPerfil()
    {
        // Obtener el modelo del usuario autenticado
        $usuario = Yii::$app->user->identity;

        //Recuperamos de la sesion el la ultima vez que inicio sesion
        $fechaUltimoAccesoAnterior = Yii::$app->session->get('fechaUltimoAccesoAnterior', '2000-01-01 00:00:00');

        //obtener las notificaciones de administradores o de moderadores
        $mensajesAdmin = Mensajes::obtenerMensajesDeAdministradores(($usuario->id));


        // Comprobar si se envió el formulario y guardar los datos
        if ($usuario->load(Yii::$app->request->post()) && $usuario->save()) {
            Yii::$app->session->setFlash('success', 'Tu perfil se actualizó correctamente.');
            return $this->redirect(['mi-perfil']); // Redirigir para evitar reenvío de formulario
        }

        $mensajesNuevos = Mensajes::find()
            ->where(['usuario_destino_id' => $usuario->id])
            ->andWhere(['>', 'fecha_hora', $fechaUltimoAccesoAnterior])
            ->count();



        $mensajesAdminNuevos = Mensajes::find()
            ->joinWith('usuarioOrigen')
            ->where([
                'usuario_destino_id' => $usuario->id,
            ])
            ->andWhere(['>', 'fecha_hora', $fechaUltimoAccesoAnterior])
            ->andWhere([
                'usuarios.rol' => Roles::find()
                    ->select('id')
                    ->where(['nombre' => ['admin', 'sysadmin', 'moderador']])
            ])
            ->count();

        // Mostrar la vista con el modelo del usuario
        return $this->render('mi-perfil', [
            'model' => $usuario,
            'mensajesNuevos' => $mensajesNuevos, //Mostramos los mensajes nuevos de ese usuario
            'mensajesAdminNuevos' => $mensajesAdminNuevos, //Mostramos notificaciones de admin
        ]);
    }



    /**
     * Cambio de contraseña de un usuario
     */
    public function actionCambiarContrasena()
    {
        $usuario = Yii::$app->user->identity; // Usuario autenticado

        $model = new \app\models\FormCambiarContrasena(); // Usamos un modelo de formulario creado 

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Validar que la contraseña actual es correcta
            if (!$usuario->validatePassword($model->contrasena_actual)) {
                Yii::$app->session->setFlash('error', 'La contraseña actual es incorrecta.');
            } else {
                // Actualizar la contraseña
                $usuario->setPassword($model->nueva_contrasena);
                if ($usuario->save()) {
                    Yii::$app->session->setFlash('success', 'Tu contraseña se ha actualizado correctamente.');
                    return $this->redirect(['mi-perfil']); // Redirigir al perfil
                } else {
                    Yii::$app->session->setFlash('error', 'No se ha podido actualizar la contraseña.');
                }
            }
        }

        return $this->render('cambiar-contrasena', [
            'model' => $model,
        ]);
    }


    /**
     * Eliminar la cuenta de un usuario por pedir baja
     */


    public function actionSolicitarBaja()
    {
        //Buscamos quien es el usuario que esta accediendo
        $usuario = Yii::$app->user->identity;


        if (!$usuario) {
            throw new NotFoundHttpException('No se ha encontrado el usuario.');
        }

        //Eliminamos al usuario y los datos relacionados con el
        if ($usuario->delete()) {

            Yii::$app->user->logout();


            Yii::$app->session->setFlash('success', 'Tu cuenta y datos han sido eliminados correctamente.');
            return $this->redirect(['site/index']);
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo procesar tu solicitud de baja.');
        }

        // Redirigir al perfil del usuario en caso de fallo
        return $this->redirect(['mi-perfil']);
    }
}
