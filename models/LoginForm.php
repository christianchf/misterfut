<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuario;

/**
 * LoginForm es el modelo para el formulario de login.
 *
 * @property User|null $user Esta propiedad es solo de lectura.
 *
 */
class LoginForm extends Model
{
    /**
     * Campo del nombre del usuario.
     * @var string
     */
    public $username;
    /**
     * Campo de la contraseña del usuario.
     * @var string
     */
    public $password;
    /**
     * Campo opcional para recordar al usuario logueado.
     * @var string
     */
    public $rememberMe = true;

    /**
    * La instancia del usuario correspondiente, o false si no existe o todavía
    * no se ha buscado.
    * @var bool|Usuario
    */
    private $_user = false;


    /**
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Nombre',
            'password' => 'Contraseña',
            'rememberMe' => 'Recuérdame',
        ];
    }

    /**
     * Valida la constraseña.
     * Este método sirve como validación en línea para la contraseña.
     *
     * @param string $attribute El atributo que se está validando actualmente.
     * @param array $params Los pares nombre-valor adicionales dados en la regla.
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validarPassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Loguea a un usuario utilizando el nombre de usuario y la contraseña proporcionados.
     * @return bool True si el usuario a iniciado sesión correctamente.
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Encuentra un usuario por su [[username]]
     *
     * @return Usuario|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::buscarPorNombre($this->username);
        }

        return $this->_user;
    }
}
