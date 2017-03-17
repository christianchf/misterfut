<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
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
     * Escenario para cuando se crea un usuario
     * @var string
     */
    const ESCENARIO_CREATE = 'create';

    /**
     * Campo de contraseña en el formulario de alta y modificación de usuarios
     * @var string
     */
    public $pass;
    /**
     * Campo de confirmación de contraseña en el formulario de alta y
     * modificación de usuarios
     * @var string
     */
    public $passConfirm;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
    * @inheritDoc
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
    * @inheritDoc
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * @inheritDoc
    */
    public function getAuthKey()
    {
        return $this->token;
    }

    /**
     * Regenera los tokens de los usuarios.
     */
    public function regenerarToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    /**
    * @inheritDoc
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
     * @param  [type] $attribute [description]
     * @param  [type] $params    [description]
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
