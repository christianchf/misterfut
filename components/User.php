<?php

 namespace app\components;

class User extends \yii\web\User
{
    /**
    * Comprueba si el usuario es administrador.
    * @return bool si el usuario es administrador
    */
    public function getEsAdmin()
    {
        return ($this->identity) ? $this->identity->esAdmin() : false;
    }
}
