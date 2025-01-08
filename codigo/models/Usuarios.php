<?php


namespace app\models;


use Yii;
use Yii\helpers\Html;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $nick
 * @property string|null $nombre
 * @property string|null $apellidos
 * @property string|null $fecha_registro
 * @property int|null $registro_confirmado
 * @property string|null $fecha_ultimo_acceso
 * @property int|null $accesos_fallidos
 * @property int|null $bloqueado
 * @property string|null $fecha_bloqueo
 * @property string|null $motivo_bloqueo
 * @property int|null $rol
 *
 * @property Comentario[] $comentarios
 * @property Incidencia[] $incidencias
 * @property Incidencia[] $incidencias0
 * @property Mensaje[] $mensajes
 * @property Mensaje[] $mensajes0
 * @property ModeradoresZona[] $moderadoresZonas
 * @property Oferta[] $ofertas
 * @property Oferta[] $ofertas0
 * @property OfertasValoraciones[] $ofertasValoraciones
 * @property Roles $rol
 * @property Seguimiento[] $seguimientos
 * @property UsuariosCategoria[] $usuariosCategorias
 * @property UsuariosEtiqueta[] $usuariosEtiquetas
 * @property UsuariosZona[] $usuariosZonas
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'nick'], 'required'],
            [['fecha_registro', 'fecha_ultimo_acceso', 'fecha_bloqueo'], 'safe'],
            [['registro_confirmado'], 'boolean'],
            ['registro_confirmado', 'filter', 'filter' => function ($value) {
                return $value ? 1 : 0;
            }], //Asegurar que siempre sea 1 o 0            
            [['accesos_fallidos', 'bloqueado', 'rol'], 'integer'],
            [['email', 'nombre', 'apellidos'], 'string', 'max' => 100],
            [['password', 'motivo_bloqueo'], 'string', 'max' => 255],
            [['nick'], 'string', 'max' => 50],
            [['email'], 'unique'],
            [['nick'], 'unique'],
            [['rol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::class, 'targetAttribute' => ['rol' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'nick' => Yii::t('app', 'Nick'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'registro_confirmado' => Yii::t('app', 'Confirmado (Si/No)'),
            'fecha_ultimo_acceso' => Yii::t('app', 'Fecha Ultimo Acceso'),
            'accesos_fallidos' => Yii::t('app', 'Accesos Fallidos'),
            'bloqueado' => Yii::t('app', 'Bloqueado'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha Bloqueo'),
            'motivo_bloqueo' => Yii::t('app', 'Motivo Bloqueo'),
            'rol' => Yii::t('app', 'Rol'),
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Incidencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncidenciasOrigen()
    {
        return $this->hasMany(Incidencia::class, ['usuario_origen_id' => 'id']);
    }

    /**
     * Gets query for [[IncidenciasDestino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncidenciasDestino()
    {
        return $this->hasMany(Incidencia::class, ['usuario_destino_id' => 'id']);
    }

    /**
     * Gets query for [[Mensajes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMensajesEnviados()
    {
        return $this->hasMany(Mensaje::class, ['usuario_origen_id' => 'id']);
    }

    /**
     * Gets query for [[MensajesRecibidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMensajesRecibidos()
    {
        return $this->hasMany(Mensaje::class, ['usuario_destino_id' => 'id']);
    }

    /**
     * Gets query for [[ModeradoresZonas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModeradoresZonas()
    {
        return $this->hasMany(ModeradoresZona::class, ['moderador_id' => 'id']);
    }

    /**
     * Gets query for [[Ofertas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfertasCreadas()
    {
        return $this->hasMany(Oferta::class, ['usuario_creador_id' => 'id']);
    }

    /**
     * Gets query for [[OfertasModificadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfertasModificadas()
    {
        return $this->hasMany(Oferta::class, ['usuario_modificador_id' => 'id']);
    }

    /**
     * Gets query for [[OfertasValoraciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfertasValoraciones()
    {
        return $this->hasMany(OfertasValoraciones::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Rol0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Roles::class, ['id' => 'rol']);
    }

    /**
     * Gets query for [[Seguimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos()
    {
        return $this->hasMany(Seguimiento::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[UsuariosCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosCategorias()
    {
        return $this->hasMany(UsuariosCategoria::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[UsuariosEtiquetas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosEtiquetas()
    {
        return $this->hasMany(UsuariosEtiqueta::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[UsuariosZonas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosZonas()
    {
        return $this->hasMany(UsuariosZona::class, ['usuario_id' => 'id']);
    }



    /**
     * Encriptacion del atributo password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /** 
     * Verificación de la contraseña
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    /**
     * Getter para que devuelva registroConfirmado en tipo booleano
     */
    public function getRegistroConfirmado()
    {
        return (bool) $this->registro_confirmado;
    }


    /**
     * Setter para que da valor al registroConfirmado en tipo booleano
     */
    public function setRegistroConfirmado($value)
    {
        $this->registro_confirmado = $value ? 1 : 0; //Guardamos un 1 si es true, 0 false
    }


    /**
     * Getter para mostrar si o no en las vistas de admin ademas de el boton de confirmacion
     */
    public function getRegistroConfirmadoVista()
    {
        $textoConfirmado = $this->registro_confirmado ? Yii::t('app', 'Sí') : Yii::t('app', 'No');
        if (!$this->registro_confirmado) {
            $boton = Html::a(
                Yii::t('app', 'Confirmar'),
                ['usuarios/confirmar-usuario', 'id' => $this->id],
                [
                    'class' => 'btn btn-success btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', '¿Estás seguro de que quieres confirmar a este usuario?'),
                        'method' => 'post',
                    ],
                ]
            );

            return $textoConfirmado . ' ' . $boton;
        }
        return $textoConfirmado;
    }

    /**
     * Getter para como se muestra en la tabla y para crear boton de bloqueo
     * @return string
     */
    public function getEstadoBloqueoVista()
    {
        $textoBloqueo = $this->bloqueado ? Yii::t('app', 'Sí') : Yii::t('app', 'No');

        $boton = Html::a(
            $this->bloqueado ? Yii::t('app', 'Desbloquear') : Yii::t('app', 'Bloquear'),
            ['usuarios/bloquear-usuario', 'id' => $this->id],
            [
                'class' => $this->bloqueado ? 'btn 1' : 'btn 2',
                'data' => [
                    'confirm' => $this->bloqueado
                        ? Yii::t('app', '¿Estás seguro de que quieres desbloquear a este usuario?')
                        : Yii::t('app', '¿Estás seguro de que quieres bloquear a este usuario?'),
                    'method' => 'post',
                ],
            ]
        );

        return $textoBloqueo . ' ' . $boton;
    }
}
