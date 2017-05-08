<?php
use yii\helpers\Url;
?>
<div>
    <p> Por favor usa este enlace para recuperar tu contraseña:<br />
        <?= Url::to(["/site/cambiar", 'token' => $model->token], true); ?>
    </p>
</div>
