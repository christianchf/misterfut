<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Usuario;
use yii\console\Controller;

/**
 * Acciones relacionadas con el token de un usuario.
 *
 * @author Christian Hidalgo Ferrero
 * @since 1.0
 */
class TokenController extends Controller
{
    /**
     * Este comando regenera los tokens de todos los usuarios o sólo del usuario
     * indicado
     * @param int $id El ID del usuario al que se desea cambiar el token
     */
    public function actionIndex($id = null)
    {
        $usuarios = Usuario::find();
        if ($id !== null) {
            $usuarios->where(['id' => $id]);
        }
        foreach ($usuarios->each() as $usuario) {
            $usuario->regenerarToken();
            $usuario->token = \Yii::$app->security->generateRandomString();
            $usuario->save(false);
        }
    }
}
