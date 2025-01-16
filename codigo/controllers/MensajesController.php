<?php

namespace app\controllers;

use Yii;
use app\models\Mensajes;
use app\models\MensajesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Usuarios;
use app\models\Roles;


/**
 * MensajesController implements the CRUD actions for Mensajes model.
 */
class MensajesController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Muestra los mensajes del usuario que ha iniciado sesión
     *
     * @return string
     */
    public function actionIndex()
    {
        // Usuario autenticado
        $usuarioId = Yii::$app->user->id;

        //Consultamos los mensajes que ha recibido el usuario despues de la fecha de su ultimo login
        $mensajesNoLeidos = Mensajes::find()
            ->where(['usuario_destino_id' => $usuarioId])
            //Comprobamos que la hora sea posterior a la hora del ultimo login del usuario
            ->andWhere(['>', 'fecha_hora', Yii::$app->session->get('fechaUltimoAccesoAnterior', '2000-01-01 00:00:00')])
            ->orderBy(['fecha_hora' => SORT_DESC]) //ordenamos por la hora de entrada del mensaje
            ->all();


        //Consultamos los demas mensajes, tanto los que le han enviado antes como los que ha enviado
        $mensajesOtros = Mensajes::find()
            ->where([
                'or',
                ['usuario_destino_id' => $usuarioId],
                ['usuario_origen_id' => $usuarioId]
            ])
            ->orderBy(['fecha_hora' => SORT_DESC]) //ordenamos por la hora de entrada del mensaje
            ->all();


        //Mostramos la vista con los mensajes de la consulta
        return $this->render('index', [
            'mensajesNoLeidos' => $mensajesNoLeidos,
            'mensajesOtros' => $mensajesOtros,
        ]);
    }



    /**
     * Muestra los avisos de administradores
     *
     * @return string
     */
    public function actionAdmin()
    {
        // Usuario autenticado
        $usuarioId = Yii::$app->user->id;


        $rolesAdmin = Roles::find()
            ->select('id')
            ->where(['nombre' => ['admin', 'sysadmin', 'moderador']])
            ->column();

        if (empty($rolesAdmin)) {
            throw new \yii\web\ServerErrorHttpException('No se encontraron roles de administrador.');
        }

        //Consultamos los mensajes que ha recibido el usuario despues de la fecha de su ultimo login
        $mensajesNoLeidos = Mensajes::find()
            ->joinWith('usuarioOrigen')
            ->where(['usuario_destino_id' => $usuarioId])
            ->andWhere(['usuarios.rol' => $rolesAdmin])
            ->andWhere(['>', 'fecha_hora', Yii::$app->session->get('fechaUltimoAccesoAnterior', '2000-01-01 00:00:00')])

            ->orderBy(['fecha_hora' => SORT_DESC])
            ->all();


        //Consultamos los demas mensajes, tanto los que le han enviado antes como los que ha enviado
        $mensajesOtros = Mensajes::find()

            ->joinWith('usuarioOrigen')
            ->where(['usuario_destino_id' => $usuarioId])
            ->andWhere(['usuarios.rol' => $rolesAdmin])
            ->orderBy(['fecha_hora' => SORT_DESC])
            ->all();

        //Mostramos la vista con los mensajes de la consulta
        return $this->render('avisos-admin', [
            'mensajesNoLeidos' => $mensajesNoLeidos,
            'mensajesOtros' => $mensajesOtros,
        ]);
    }






    /**
     * Ver el contenido de un mensaje 
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        //Verificar si el usuario que ha enviado o recibido el mensaje es el que intenta acceder a ver el mensaje
        if (!in_array(Yii::$app->user->id, [$model->usuario_origen_id, $model->usuario_destino_id])) {
            throw new ForbiddenHttpException('No tienes permiso para ver este mensaje.');
        }

        //Renderizamos la vista
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Mensajes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     *//*
    public function actionCreate()
    {
        $model = new Mensajes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
*/
    /**
     * Updates an existing Mensajes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    /*
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing Mensajes model.
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
     * Finds the Mensajes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Mensajes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mensajes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
