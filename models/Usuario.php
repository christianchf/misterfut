<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo par ala tabla de "usuarios".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $password
 * @property string $email
 * @property string $token
 * @property string $created_at
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @var string Escenario para cuando se crea un usuario
     */
    const ESCENARIO_CREATE = 'create';

    /**
     * @var string Campo de contraseña en el formulario de alta y modificación de usuarios
     */
    public $pass;
    /**
     * @var string Campo de confirmación de contraseña en el formulario de alta y
     * modificación de usuarios
     */
    public $passConfirm;

    /**
     * Declara el nombre de la tabla de la base de datos asociada con esta clase.
     * @return string El nombre de la tabla.
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['nombre', 'email'], 'required'],
            [['pass', 'passConfirm'], 'required', 'on' => self::ESCENARIO_CREATE],
            [['pass'], 'safe'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 255],
            [['token'], 'string', 'max' => 32],
            [['nombre'], 'unique'],
            [['passConfirm'], 'confirmarPassword'],
        ];
    }

    /**
     * Devuelve las etiquetas de los atributos.
     * @return array Las etiquetas de los atributos
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'pass' => 'Contraseña',
            'passConfirm' => 'Confirmar contraseña',
            'email' => 'Email',
            'token' => 'Token',
            'created_at' => 'Fecha de creación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['id_usuario' => 'id'])->inverseOf('usuario');
    }

    /**
     * Encuentra una identidad mediante el ID determinado.
     * @param int $id El id a buscar
     * @return yii\web\IdentityInterface El objeto que coincide con el id dado.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Encuentra una identidad por el token dado.
     * @param mixed $token El token a buscar
     * @param mixed $type  El tipo del token
     * @return yii\web\IdentityInterface El objeto que coincide con el token dado.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
    * Busca un usuario por su nombre.
    *
    * @param string $nombre
    * @return static|null
    */
    public static function buscarPorNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }

    /**
     * Devuelve el id del usuario
     * @return int El id del usuario.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Devuelve el token del usuario
     * @return mixed El token del usuario
     */
    public function getAuthKey()
    {
        return $this->token;
    }

    /**
     * Regenera los tokens de los usuarios.
     * @return void
     */
    public function regenerarToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    /**
     * Valida la clave de autenticación dada.
     * @param  string $authKey La clave de autenticación dada.
     * @return boolean True si la clave de autenticación dada es válida.
     */
    public function validateAuthKey($authKey)
    {
        return $this->token == $authKey;
    }

    /**
    * Validar contraseña.
    *
    * @param string $password contraseña a validar
    * @return bool si la contraseña es válida para el usuario actual
    */
    public function validarPassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Comprueba si la  contraseña y la confirmación de la contraseña son iguales
     * @param  mixed $attribute
     * @param  mixed $params
     * @return void
     */
    public function confirmarPassword($attribute, $params)
    {
        if ($this->pass !== $this->passConfirm) {
            $this->addError($attribute, 'Las contraseñas no coinciden');
        }
    }

    /**
     * Comprueba si el usuario es administrador.
     * @return bool si el usuario es administrador
     */
    public function esAdmin()
    {
        return $this->nombre === 'christian';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->pass != '' || $insert) {
                $this->password = Yii::$app->security->generatePasswordHash($this->pass);
            }
            if ($insert) {
                $this->regenerarToken();
            }
            return true;
        } else {
            return false;
        }
    }
}
