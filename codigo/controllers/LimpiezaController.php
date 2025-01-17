<?php

namespace app\controllers;

use Yii;
use yii\console\Controller;

class LimpiezaController extends Controller
{
    /**
     * Elimina registros obsoletos de usuarios, comentarios, etc.
     */
    public function actionRun()
    {
        $diasObsoletos = Yii::$app->params['diasRegistroObsoleto'];
        $fechaLimite = date('Y-m-d H:i:s', strtotime("-{$diasObsoletos} days"));

        // Eliminar usuarios obsoletos
        Usuarios::deleteAll(['<', 'fecha_registro', $fechaLimite, 'registro_confirmado' => 0]);

        // Eliminar comentarios obsoletos
        Comentario::deleteAll(['<', 'fecha_creacion', $fechaLimite]);

        echo "Eliminación de registros obsoletos completada.\n";
    }
}
