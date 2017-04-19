<?php

namespace app\models;

class UsuarioForm extends \yii\base\Model
{
    /**
     * Campo del nombre del usuario.
     * @var string
     */
    public $nombre;
    /**
     * Campo de la contraseña del usuario
     * @var string
     */
    public $password;
    /**
     * Campo de confirmación de la contraseña del usuario.
     * @var string
     */
    public $passwordConfirm;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'password', 'passwordConfirm'], 'required'],
            [['nombre'], 'string', 'max' => 15],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre',
            'password' => 'Contraseña',
            'passwordConfirm' => 'Confirmar contraseña',
        ];
    }
}
