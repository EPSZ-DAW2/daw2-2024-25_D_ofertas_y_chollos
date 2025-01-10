<?php

namespace app\views\etiquetas;

use app\models\Etiqueta;
use yii\helpers\Html;

class EtiquetasWidget
{
    public static function widget()
    {
        // Obtener todas las etiquetas
        $etiquetas = Etiqueta::find()->all();

        // Renderizar las etiquetas
        $output = '<div class="etiquetas-widget">';
        foreach ($etiquetas as $etiqueta) {
            $output .= Html::a(
                Html::encode($etiqueta->nombre),
                ['etiquetas/ver', 'id' => $etiqueta->id], // Ruta corregida para la acción "ver"
                ['class' => 'etiqueta-link']
            ) . ' ';
        }
        $output .= '</div>';

    return $output;
    }


    /*
    public static function widget()
    {
        // Obtener todas las etiquetas
        $etiquetas = Etiqueta::find()->all();

        // Renderizar las etiquetas
        $output = '<div class="etiquetas-widget">';
        foreach ($etiquetas as $etiqueta) {
            $output .= Html::a(
                Html::encode($etiqueta->nombre),
                ['etiqueta/view', 'id' => $etiqueta->id], // Ruta para ver detalles de la etiqueta
                ['class' => 'etiqueta-link']
            ) . ' ';
        }
        $output .= '</div>';

        return $output;
    }
        */

    /*
    <?php foreach ($etiquetas as $etiqueta): ?>
        <a href="<?= yii\helpers\Url::to(['etiqueta/ver', 'id' => $etiqueta->id]) ?>" class="etiqueta-link">
            <?= yii\helpers\Html::encode($etiqueta->nombre) ?>
        </a>
    <?php endforeach; ?>
    */
    
}
