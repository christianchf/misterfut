<?php

namespace app\models;

class UsuarioForm extends \yii\base\Model
{
    /**
     * @var string Campo del nombre del usuario.
     */
    public $nombre;
    /**
     * @var string Campo de la contraseña del usuario
     */
    public $password;
    /**
     * @var string Campo de confirmación de la contraseña del usuario.
     */
    public $passwordConfirm;

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['nombre', 'password', 'passwordConfirm'], 'required'],
            [['nombre'], 'string', 'max' => 15],
        ];
    }

    /**
     * Devuelve las etiquetas de los atributos.
     * @return array Las etiquetas de los atributos
     */
    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre',
            'password' => 'Contraseña',
            'passwordConfirm' => 'Confirmar contraseña',
        ];
    }
}
