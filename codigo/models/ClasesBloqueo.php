<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clases_bloqueo".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Ofertas[] $ofertas
 */
class ClasesBloqueo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clases_bloqueo';
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
        return $this->hasMany(Ofertas::class, ['clase_bloqueo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ClasesBloqueoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClasesBloqueoQuery(get_called_class());
    }
}
