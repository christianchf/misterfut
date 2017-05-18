<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm es el modelo para el formulario de contacto.
 */
class ContactForm extends Model
{
    /**
     * @var string El nombre de la persona que envia el email.
     */
    public $name;
    /**
     * @var string El email de la persona que envia el email.
     */
    public $email;
    /**
     * @var string El asunto del email.
     */
    public $subject;
    /**
     * @var string El cuerpo del email.
     */
    public $body;
    /**
     * @var string Código de verificación para enviar el email.
     */
    public $verifyCode;


    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * Devuelve las etiquetas de los atributos.
     * @return array Las etiquetas de los atributos
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Código de verificación',
            'name' => 'Nombre',
            'email' => 'Email',
            'subject' => 'Asunto',
            'body' => 'Cuerpo',
        ];
    }

    /**
     * Envía un correo electrónico a la dirección de correo electrónico
     * especificada utilizando la información recopilada por este modelo.
     * @param string $email La dirección
     * @return bool True si el modelo pasa la validación.
     */
    public function contact($email)
    {
        $content = '<p>Email: ' . $this->email . '</p>';
        $content .= '<p>Nombre: ' . $this->name . '</p>';
        $content .= '<p>Asunto: ' . $this->subject . '</p>';
        $content .= '<p>Cuerpo: ' . $this->body . '</p>';
        if ($this->validate()) {
            Yii::$app->mailer->compose('@app/mail/layouts/html', ['content' => $content])
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        } else {
            return false;
        }
    }
}
