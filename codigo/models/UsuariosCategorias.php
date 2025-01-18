<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_categorias".
 *
 * @property int $id
 * @property string $usuario_id
 * @property string|null $categoria_id
 *
 */
class UsuariosCategorias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'categoria_id'], 'required'],
            [['usuario_id', 'categoria_id'], 'integer'],
            [['usuario_id', 'categoria_id'], 'unique', 'targetAttribute' => ['usuario_id', 'categoria_id'], 'message' => 'Ya estas siguiendo esta categoría'],
            //Comprobamos que el usuario y categoria existan en nuestra bbdd
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'Usuario'),
            'categoria_id' => Yii::t('app', 'Categoría'),
        ];
    }

    /**
     * 
     * Relacion con modelo usuarios
     * 
     */
    public function getUsuarios()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_id']);
    }

    /**
     * Relacion con modelo categorias
     *
     * 
     * */

    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id' => 'categoria_id']);
    }
}
