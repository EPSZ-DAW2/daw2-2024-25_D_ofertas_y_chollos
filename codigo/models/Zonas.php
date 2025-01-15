<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zonas".
 *
 * @property int $id
 * @property string $clase
 * @property string $nombre
 * @property int|null $zona_padre_id
 *
 * @property ModeradoresZonas[] $moderadoresZonas
 * @property Ofertas[] $ofertas
 * @property Proveedores[] $proveedores
 * @property UsuariosZonas[] $usuariosZonas
 * @property Zonas $zonaPadre
 * @property Zonas[] $zonas
 */
class Zonas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zonas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clase', 'nombre'], 'required'],
            [['zona_padre_id'], 'integer'],
            [['clase'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 100],
            [['clase', 'nombre'], 'unique', 'targetAttribute' => ['clase', 'nombre']],
            [['zona_padre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zonas::class, 'targetAttribute' => ['zona_padre_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clase' => 'Clase',
            'nombre' => 'Nombre',
            'zona_padre_id' => 'Zona Padre ID',
        ];
    }

    /**
     * Gets query for [[ModeradoresZonas]].
     *
     * @return \yii\db\ActiveQuery|ModeradoresZonasQuery
     */
    public function getModeradoresZonas()
    {
        return $this->hasMany(ModeradoresZonas::class, ['zona_id' => 'id']);
    }

    /**
     * Gets query for [[Ofertas]].
     *
     * @return \yii\db\ActiveQuery|OfertasQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(Ofertas::class, ['zona_id' => 'id']);
    }

    /**
     * Gets query for [[Proveedores]].
     *
     * @return \yii\db\ActiveQuery|ProveedoresQuery
     */
    public function getProveedores()
    {
        return $this->hasMany(Proveedores::class, ['zona_id' => 'id']);
    }

    /**
     * Gets query for [[UsuariosZonas]].
     *
     * @return \yii\db\ActiveQuery|UsuariosZonasQuery
     */
    public function getUsuariosZonas()
    {
        return $this->hasMany(UsuariosZonas::class, ['zona_id' => 'id']);
    }

    /**
     * Gets query for [[ZonaPadre]].
     *
     * @return \yii\db\ActiveQuery|ZonasQuery
     */
    public function getZonaPadre()
    {
        return $this->hasOne(Zonas::class, ['id' => 'zona_padre_id']);
    }

    /**
     * Gets query for [[Zonas]].
     *
     * @return \yii\db\ActiveQuery|ZonasQuery
     */
    public function getZonas()
    {
        return $this->hasMany(Zonas::class, ['zona_padre_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ZonasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZonasQuery(get_called_class());
    }
}
