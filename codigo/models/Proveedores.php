<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property int $id
 * @property string $razon_social
 * @property string $telefono_contacto
 * @property string $email
 * @property int|null $zona_id
 * @property string|null $url_web
 *
 * @property Ofertas[] $ofertas
 * @property Zonas $zona
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['razon_social', 'telefono_contacto', 'email'], 'required'],
            [['zona_id'], 'integer'],
            [['razon_social', 'url_web'], 'string', 'max' => 255],
            [['telefono_contacto'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
            [['zona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zonas::class, 'targetAttribute' => ['zona_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'razon_social' => 'Razon Social',
            'telefono_contacto' => 'Telefono Contacto',
            'email' => 'Email',
            'zona_id' => 'Zona ID',
            'url_web' => 'Url Web',
        ];
    }

    /**
     * Gets query for [[Ofertas]].
     *
     * @return \yii\db\ActiveQuery|OfertasQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(Ofertas::class, ['proveedor_id' => 'id']);
    }

    /**
     * Gets query for [[Zona]].
     *
     * @return \yii\db\ActiveQuery|ZonasQuery
     */
    public function getZona()
    {
        return $this->hasOne(Zonas::class, ['id' => 'zona_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProveedoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProveedoresQuery(get_called_class());
    }
}
