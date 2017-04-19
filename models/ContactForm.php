<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    /**
     * El nombre de la persona que envia el email.
     * @var string
     */
    public $name;
    /**
     * El email de la persona que envia el email.
     * @var string
     */
    public $email;
    /**
     * El asunto del email.
     * @var string
     */
    public $subject;
    /**
     * El cuerpo del email.
     * @var string
     */
    public $body;
    /**
     * Código de verificación para enviar el email.
     * @var string
     */
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Codigo de verificación',
            'name' => 'Nombre',
            'email' => 'Email',
            'subject' => 'Asunto',
            'body' => 'Cuerpo',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
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
