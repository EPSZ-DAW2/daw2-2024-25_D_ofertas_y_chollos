<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ofertas_etiquetas".
 *
 * @property int $id
 * @property int|null $oferta_id
 * @property int|null $etiqueta_id
 *
 * @property Etiquetas $etiqueta
 * @property Ofertas $oferta
 */
class OfertaEtiqueta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ofertas_etiquetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oferta_id', 'etiqueta_id'], 'integer'],
            //[['oferta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ofertas::class, 'targetAttribute' => ['oferta_id' => 'id']],
            [['etiqueta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Etiqueta::class, 'targetAttribute' => ['etiqueta_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'oferta_id' => Yii::t('app', 'Oferta ID'),
            'etiqueta_id' => Yii::t('app', 'Etiqueta ID'),
        ];
    }

    /**
     * Gets query for [[Etiqueta]].
     *
     * @return \yii\db\ActiveQuery|EtiquetasQuery
     */
    public function getEtiqueta()
    {
        return $this->hasOne(Etiqueta::class, ['id' => 'etiqueta_id']);
    }

    /**
     * Gets query for [[Oferta]].
     *
     * @return \yii\db\ActiveQuery|OfertasQuery
     */
    /*
    public function getOferta()
    {
        return $this->hasOne(Ofertas::class, ['id' => 'oferta_id']);
    }
        */

    /**
     * {@inheritdoc}
     * @return OfertasEtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OfertasEtiquetasQuery(get_called_class());
    }
}
