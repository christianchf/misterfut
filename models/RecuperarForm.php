<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RecuperarForm extends Model
{
    /**
     * Campo de email del formulario de recuperación de contraseña.
     * @var string
     */
    public $email;
    /**
     * Campo de código de verificación del formulario de recuperación de contraseña.
     * @var string
     */
    public $verifyCode;
    /**
     * Campo de contraseña del formulario de recuperación de contraseña.
     * @var string
     */
    public $pass;
    /**
     * Campo de repetición de contraseña del formulario de recuperación de
     * contraseña.
     * @var string
     */
    public $repeatPass;
    /**
     * Campo de token del formulario de recuperación de contraseña.
     * @var string
     */
    public $token;
    /**
     * Escenario para la recuperación de contraseña.
     * @var string
     */
    const ESCENARIO_RECUPERAR = 'recuperar';

    /**
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['email'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['email'], 'email'],
            [['email'], 'exist', 'targetClass' => Usuario::className(), 'targetAttribute' => ['email' => 'email']],
            [['verifyCode'], 'captcha'],
            [['pass', 'repeatPass', 'token'], 'required', 'on' => self::ESCENARIO_RECUPERAR],
            ['repeatPass', function ($attr) {
                if ($this->$attr !== $this->pass) {
                    $this->addError($attr, 'Las contraseñas no coinciden');
                }
            }, 'on' => self::ESCENARIO_RECUPERAR],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'verifyCode' => 'Responda a la siguiente pregunta para que se le envíe un correo',
            'pass' => 'Nueva contraseña',
            'repeatPass' => 'Repite la nueva contraseña',
        ];
    }

    /**
     * Envia un email para la recuperación de la contraseña.
     * @return bool true si el email se ha enviado correctamente
     */
    public function sendEmail()
    {
        $model = Usuario::find()->where(['email' => $this->email])->one();
        $mail = Yii::$app->mailer->compose('redirect', ['model' => $model])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($model->email)
                ->setSubject('Recuperar contraseña de MisterFut')
                ->send();
        return true;
    }

    /**
     * Permite al usuario cambiar su contraseña por una nueva.
     */
    public function cambiarContrasenia()
    {
        $usuario = Usuario::find()->where(['token' => $this->token])->one();
        $usuario->password = Yii::$app->security->generatePasswordHash($this->pass);
        if ($usuario->save(true, ['password'])) {
            $usuario->regenerarToken();
            $usuario->save(true, ['token']);
        }
    }
}
