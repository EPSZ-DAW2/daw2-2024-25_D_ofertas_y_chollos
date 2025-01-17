<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class RbacController extends Controller
{


    /**
     * Asgina un rol a un usuario
     * @param mixed $nombreRol
     * @param mixed $usuarioId
     * @return string
     */
    public function actionAsignarRol($nombreRol, $usuarioId)
    {
        $auth = Yii::$app->authManager;

        $role = $auth->getRole($nombreRol);
        if ($role) {
            $auth->assign($role, $usuarioId);
            return "Rol '{$nombreRol}' asignado al usuario con ID {$usuarioId}.";
        }

        return "Rol '{$nombreRol}' no encontrado.";
    }

    /**
     * 
     * Comprueba si un usuario tiene el rol necesario
     * @param mixed $usuarioId
     * @param mixed $nombreRol
     * @return void
     */
    public function actionComprobarPermiso($usuarioId, $nombreRol)
    {
        Yii::$app->user->identityClass = 'app\models\Usuarios';
        Yii::$app->user->login(Yii::$app->user->identityClass::findOne($usuarioId));

        if (Yii::$app->user->can($nombreRol)) {
            return "El usuario con ID {$usuarioId} tiene permiso para '{$nombreRol}'.";
        }

        return "El usuario con ID {$usuarioId} NO tiene permiso para '{$nombreRol}'.";
    }
}
