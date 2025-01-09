<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anuncios".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descripcion
 * @property float $precio
 * @property string $fecha
 * @property int $oferta_id
 *
 * @property Ofertas $oferta
 */
class Anuncio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anuncios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'precio', 'fecha', 'oferta_id'], 'required'],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['fecha'], 'safe'],
            [['oferta_id'], 'integer'],
            [['titulo'], 'string', 'max' => 255],
            [['oferta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ofertas::class, 'targetAttribute' => ['oferta_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titulo' => Yii::t('app', 'Titulo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'precio' => Yii::t('app', 'Precio'),
            'fecha' => Yii::t('app', 'Fecha'),
            'oferta_id' => Yii::t('app', 'Oferta ID'),
        ];
    }

    /**
     * Gets query for [[Oferta]].
     *
     * @return \yii\db\ActiveQuery|OfertasQuery
     */
    public function getOferta()
    {
        return $this->hasOne(Ofertas::class, ['id' => 'oferta_id']);
    }

    /**
     * {@inheritdoc}
     * @return AnunciosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnunciosQuery(get_called_class());
    }



        //Función para obtener un registro aleatorio de la tabla anuncios
    public static function getAnuncioAleatorio()
    {
        $anuncio = Anuncio::find()->orderBy('rand()')->one();
        return $anuncio;
    }

    
}
