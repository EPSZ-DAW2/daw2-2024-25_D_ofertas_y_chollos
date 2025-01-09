<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $nick;
    public $password;
    public $recordarme = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['nick', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['recordarme', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, 'Usuario o contraseña incorrectos');
            }

            //Verifcar si el usuario no esta bloqueado
            if ($user->bloqueado) {
                $this->addError($attribute, 'La cuenta esta bloqueada, un administrador debe desbloquearla');
                return;
            }

            //Comprobar si la comtraseña que ha introducido es correcta 
            if (!$user->validatePassword($this->password)) {
                //incrementamos los intentos del usuario
                $user->accesos_fallidos++;
                if ($user->accesos_fallidos >= 3) {
                    $user->bloqueado = 1;
                    $user->fecha_bloqueo = date('Y-m-d H:i:s');
                }

                $user->save(false); //Almacenar en usuario
                $this->addError($attribute, 'Usuario o contraseña incorrectos');
                return;
            }

            //si ha iniciado sesion eliminamos los posibles intentos fallidos
            $user->accesos_fallidos = 0;
            $user->save(false);
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->recordarme ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuarios::findOne(['nick' => $this->nick]);
        }

        return $this->_user;
    }
}
