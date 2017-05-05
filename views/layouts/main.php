<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => '<p><img src="/images/logo.png" alt="Logo" title="Logo" width="30" class="logo" /> MisterFut</p>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-fixed-top navbar-purple',
        ],
    ]);
    $items = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
        ['label' => 'Misterfut', 'url' => ['/site/about']],
        ['label' => 'Contacto', 'url' => ['/site/contact']],
        Yii::$app->user->isGuest ?
        [
            'label' => 'Usuarios',
            'items' => [
                ['label' => 'Login', 'url' => ['/site/login']],
                '<li class="divider"></li>',
                ['label' => 'Registrarse', 'url' => ['usuarios/create']],
            ]
        ] :
        [
            'label' => 'Usuario (' . Yii::$app->user->identity->nombre . ')',
            'items' => [
                [
                    'label' => 'Logout',
                    'url' => ['site/logout'],
                    'linkOptions' => ['data-method' => 'POST']
                ],
                '<li class="divider"></li>',
                ['label' => 'Mis datos', 'url' => ['/usuarios/view']],
            ]
        ]
    ];
    if (Yii::$app->user->esAdmin) {
        end($items);
        $items[key($items)]['items'][] = [
            'label' => 'Gestión de usuarios',
            'url' => ['usuarios/index']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right no-hover'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>
    <?php if (!Yii::$app->user->isGuest) { ?>
    <nav id="submenu" class="navbar-purple navbar navbar-fixed-top">
    <div class="container">
        <ul class="navbar-nav navbar-left no-hover nav">
            <li><?= Html::a('Mis equipos', ['/equipos/index']) ?></li>
            <li><?= Html::a('Historial de equipos', ['/equipos/historial']) ?></li>
        </ul>
    </div>
    </nav>
    <?php } ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Christian Hidalgo Ferrero <?= date('Y') ?></p>

        <p class="pull-right"><img src="/images/logo.png" alt="Logo" title="Logo" width="30" class="logo" /></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
