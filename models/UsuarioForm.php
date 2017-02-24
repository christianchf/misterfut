<?php

namespace app\models;

class UsuarioForm extends \yii\base\Model
{
    public $nombre;
    public $password;
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
