<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Incidencias".
 *
 * @property int $id
 * @property string|null $fecha_hora
 * @property string|null $clase
 * @property string|null $texto
 * @property int|null $usuario_origen_id
 * @property int|null $usuario_destino_id
 * @property int|null $oferta_id
 * @property int|null $comentario_id
 * @property string|null $fecha_lectura
 * @property string|null $fecha_aceptado
 */
class Incidencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Incidencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_hora', 'fecha_lectura', 'fecha_aceptado'], 'safe'],
            [['texto'], 'string'],
            [['usuario_origen_id', 'usuario_destino_id', 'oferta_id', 'comentario_id'], 'integer'],
            [['clase'], 'string', 'max' => 50],
            [['usuario_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_origen_id' => 'id']],
            [['usuario_destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_destino_id' => 'id']],
            [['oferta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ofertas::class, 'targetAttribute' => ['oferta_id' => 'id']],
            [['comentario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::class, 'targetAttribute' => ['comentario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_hora' => Yii::t('app', 'Fecha Hora'),
            'clase' => Yii::t('app', 'Clase'),
            'texto' => Yii::t('app', 'Texto'),
            'usuario_origen_id' => Yii::t('app', 'Usuario Origen ID'),
            'usuario_destino_id' => Yii::t('app', 'Usuario Destino ID'),
            'oferta_id' => Yii::t('app', 'Oferta ID'),
            'comentario_id' => Yii::t('app', 'Comentario ID'),
            'fecha_lectura' => Yii::t('app', 'Fecha Lectura'),
            'fecha_aceptado' => Yii::t('app', 'Fecha Aceptado'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return IncidenciasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IncidenciasQuery(get_called_class());
    }
}
