<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estados_terminacion".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Ofertas[] $ofertas
 */
class EstadosTerminacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estados_terminacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Ofertas]].
     *
     * @return \yii\db\ActiveQuery|OfertasQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(Ofertas::class, ['estado_terminacion_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EstadosTerminacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadosTerminacionQuery(get_called_class());
    }
}
