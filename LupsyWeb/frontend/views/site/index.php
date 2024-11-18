<?php

use yii\helpers\Html;

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?= $this->registerCssFile("@web/css/index_geral.css"); ?>

</head>
<body>
    <div class="menu-icon">
        <button>&#9776;</button>
    </div>



<section class="banner">
    <div class="banner-content">
        <?= Html::img('@web/img/capaCEV.jpg', ['alt' => 'Cervejaria Lupsy Banner', 'class' => 'banner-img']) ?>

    </div>
</section>

<section>
    <div class="top-middle-content">
        <?= Html::img('@web/img/meioCEV.png', ['alt' => 'metade', 'class' => 'middle-img']) ?>
    </div>
    <div class="text-in-image">
        <p>Descobre uma nova experiência de cervejas com a nossa <br> aplicação e website que une amantes de cervejas a <br>  partir da nossa comunidade.</p>
        <p>O website oferece uma interface intuitiva para explorares, <br> avaliares e rastreares cervejas que já bebeste.</p>
        <div class="overlay">
            <?= Html::a('Descobrir', ['/site/login'], ['class' => 'button-sh']) ?>
        </div>
    </div>
</section>

<section class="main-content">
    <div class="content-row">
        <?= Html::img('@web/img/miniMeioCEV.png', ['alt' => 'Bar Scene', 'class' => 'main-img']) ?>

        <div class="text-content">
            <h2>ONDE QUISERES</h2>
            <p>Com a nossa nova plataforma Lupsy podes levar os teus gostos de cerveja para onde quiseres.</p>
            <p>Através da nossa Aplicação Móvel e do nosso Website.</p>
            <p>Junta-te a nós nesta nova aventura.</p>
            <?= Html::a('Entrar', ['/site/login'], ['class' => 'svg']) ?>
        </div>
    </div>

    <div class="grid">
        <div class="grid-item1">
            <?= Html::img('@web/img/cardBottomCEV.png', ['alt' => 'IBU', 'class' => 'grid-img']) ?>
            <!--<img src="../../web/img/cardBottomCEV.png" alt="IBU" class="grid-img">-->
            <h3 style="display:flex;">IBU   <a href="#" class="arrow-link" style="color:#E7E7E7; padding:10px"></a></h3>
            <p>Medida utilizada para quantificar o nível de amargor em cervejas, com base na concentração de compostos amargos, como os ácidos presentes no lúpulo.
                <br>  Sabe mais no nosso Website.</p>

        </div>
        <div class="grid-item2">
            <?= Html::img('@web/img/card2BottomCEV.png', ['alt' => 'Teor Alcool', 'class' => 'grid-img']) ?>
            <h3 style="display:flex;">Teor de Álcool <a href="#" style="color:#1e1e1e; padding:10px" class="arrow-link"></a></h3>
            <p>Porcentagem de álcool presente em uma bebida, geralmente expressa em volume, indicando a concentração de etanol e a intensidade alcoólica da bebida.
                <br> Sabe mais na nossa Aplicação.</p>
        </div>
    </div>
</section>

</body>


</html>
