<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Login para el cambio de contraseña
 *
 * @property-read User|null $user
 *
 */
class FormCambiarContrasena extends Model
{
    public $contrasena_actual;
    public $nueva_contrasena;
    public $confirmar_contrasena;




    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['contrasena_actual', 'nueva_contrasena', 'confirmar_contrasena'], 'required'],
            [['nueva_contrasena'], 'string', 'min' => 8],
            [['confirmar_contrasena'], 'compare', 'compareAttribute' => 'nueva_contrasena', 'message' => 'Las contraseñas no coinciden.'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function attributeLabels()
    {
        return [
            'contrasena_actual' => 'Contraseña Actual',
            'nueva_contrasena' => 'Nueva Contraseña',
            'confirmar_contrasena' => 'Confirmar Contraseña',
        ];
    }
}
