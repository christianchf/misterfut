<?php
use app\assets\IndexAsset;
use yii\web\View;

/* @var $this yii\web\View */

IndexAsset::register($this);

$this->title = 'MisterFut';
$js = <<<EOT
    $(document).ready(function(){
        $('.carrusel-slick').slick({
            dots: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            pauseOnHover: false
        });
    });
EOT;
$this->registerJs($js, View::POS_END);
?>
<div class="site-index">
    <div class="body-content">
        <br><br><br>
        <div class="carrusel-slick">
            <div><img src="/images/pelota-campo.jpg" alt="Pelota en campo de fútbol"></div>
            <div><img src="/images/pizarra-tactica.jpg" alt="Pizarra de tácticas"></div>
        </div>
    </div>
</div>
