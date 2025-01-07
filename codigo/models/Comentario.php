<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property int $anuncio_id
 * @property string $texto
 * @property int|null $comentario_origen_id
 * @property bool $cerrado
 * @property int $denuncias
 * @property string|null $fecha_primer_denuncia
 * @property string|null $motivo_denuncia
 * @property bool $bloqueado
 * @property string|null $fecha_bloqueo
 * @property string|null $motivo_bloqueo
 * @property int $usuario_id
 * @property string $fecha_creacion
 * @property string|null $fecha_modificacion
 *
 * @property Anuncio $anuncio
 * @property Comentario $comentarioOrigen
 * @property Usuario $usuario
 * @property Comentario[] $comentarios
 */
class Comentario extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'comentarios';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['anuncio_id', 'texto', 'usuario_id'], 'required'],
			[['anuncio_id', 'comentario_origen_id', 'denuncias', 'usuario_id'], 'integer'],
			[['texto', 'motivo_denuncia', 'motivo_bloqueo'], 'string'],
			[['cerrado', 'bloqueado'], 'boolean'],
			[['fecha_primer_denuncia', 'fecha_bloqueo', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
			[['anuncio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anuncio::class, 'targetAttribute' => ['anuncio_id' => 'id']],
			[['comentario_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::class, 'targetAttribute' => ['comentario_origen_id' => 'id']],
			[['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['usuario_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'anuncio_id' => 'Anuncio ID',
			'texto' => 'Comentario',
			'comentario_origen_id' => 'Comentario Origen',
			'cerrado' => 'Cerrado',
			'denuncias' => 'Denuncias',
			'fecha_primer_denuncia' => 'Fecha Primera Denuncia',
			'motivo_denuncia' => 'Motivo Denuncia',
			'bloqueado' => 'Bloqueado',
			'fecha_bloqueo' => 'Fecha Bloqueo',
			'motivo_bloqueo' => 'Motivo Bloqueo',
			'usuario_id' => 'Usuario ID',
			'fecha_creacion' => 'Fecha Creación',
			'fecha_modificacion' => 'Fecha Modificación',
		];
	}

	/**
	 * Gets query for [[Anuncio]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getAnuncio()
	{
		return $this->hasOne(Anuncio::class, ['id' => 'anuncio_id']);
	}

	/**
	 * Gets query for [[ComentarioOrigen]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getComentarioOrigen()
	{
		return $this->hasOne(Comentario::class, ['id' => 'comentario_origen_id']);
	}

	/**
	 * Gets query for [[Usuario]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getUsuario()
	{
		return $this->hasOne(Usuario::class, ['id' => 'usuario_id']);
	}

	/**
	 * Gets query for [[Comentarios]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getComentarios()
	{
		return $this->hasMany(Comentario::class, ['comentario_origen_id' => 'id']);
	}
}
