<?php

namespace app\views\etiquetas;

use app\models\Etiqueta;
use yii\helpers\Html;

class EtiquetasWidget
{
    public static function widget()
    {
        // Obtener todas las etiquetas con el conteo de ofertas
        $etiquetas = Etiqueta::find()->ofertaCount()->asArray()->all();

        // Encuentra los valores mínimo y máximo de `num_ofertas`
        $min = min(array_column($etiquetas, 'num_ofertas'));
        $max = max(array_column($etiquetas, 'num_ofertas'));

        // Define los tamaños mínimo y máximo en píxeles o em
        $minSize = 16; // Tamaño mínimo
        $maxSize = 24; // Tamaño máximo

        // Renderizar las etiquetas
        $output = '<div class="etiquetas-widget">';
        foreach ($etiquetas as $etiqueta) {
            // Escala lineal para calcular el tamaño
            $size = $min === $max
                ? $maxSize // Si todos tienen el mismo número de ofertas
                : $minSize + (($etiqueta['num_ofertas'] - $min) / ($max - $min)) * ($maxSize - $minSize);

            $output .= Html::a(
                Html::encode($etiqueta['nombre']),
                ['etiquetas/ver', 'id' => $etiqueta['id']], 
                ['class' => 'etiqueta-link', 'style' => 'font-size: ' . round($size, 2) . 'px;']
            ) . ' ';
        }
        $output .= '</div>';

        return $output;
    }
}
