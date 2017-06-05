<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<br />
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        El error anterior se produjo mientras el servidor Web estaba procesando su solicitud.
    </p>
    <p>
        Póngase en <?= Html::a('contacto', ['site/contact']) ?> con nosotros si cree que se trata de un error de servidor. Gracias.
    </p>

</div>
