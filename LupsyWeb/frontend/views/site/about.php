<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sobre Nós - Cervejaria Lupsy</title>
    <?php $this->registerCssFile("@web/css/about.css"); ?>
</head>
<body>
<div class="container">
    <p class="title-n" style="padding:30px; font-size: 50px;">Sobre a Cervejaria Lupsy</p>

    <div class="content-wrapper">
        <div class="text-content">
            <p class="met-met">A <strong>Cervejaria Lupsy</strong> nasceu da paixão por cervejas artesanais e da vontade de criar uma comunidade onde amantes de cerveja possam descobrir, partilhar e avaliar diferentes estilos e marcas de cerveja. O nosso objetivo é proporcionar uma experiência única para quem deseja explorar o universo das cervejas artesanais e melhorar o seu conhecimento sobre elas.</p>
            <br>
            <p class="">No nosso website e app, os utilizadores podem avaliar as cervejas que experimentaram, contabilizar o número de cervejas provadas e descobrir novas opções recomendadas pela nossa comunidade de entusiastas.</p>
            <br>
            <p class="met-met">Além de ser um ponto de encontro para os apaixonados por cervejas, a <strong>Cervejaria Lupsy</strong> oferece uma plataforma onde os utilizadores podem explorar informações detalhadas sobre cada cerveja, desde os ingredientes até às técnicas de produção, permitindo uma experiência mais rica e educativa para todos.</p>
        </div>
            <?= Html::img('@web/img/logonobg.png', ['alt' => 'Logo', 'class' => 'met-met2']) ?>

    </div>

    <div class="mission">
        <h2 class="title-n">Nossa Missão</h2>
        <p>A nossa missão é simples: unir pessoas que compartilham a mesma paixão por cervejas artesanais e oferecer uma plataforma onde possam registar, avaliar e comentar sobre as suas experiências com diferentes cervejas. Queremos ajudar os utilizadores a descobrir novas marcas, explorar diferentes estilos e expandir o seu paladar.</p>
    </div>

    <div class="team">
        <h2 class="title-n">O que Oferecemos</h2>
        <p>Na <strong>Cervejaria Lupsy</strong>, oferecemos:</p>
        <ul>
            <li>Uma plataforma fácil de usar para avaliar e descobrir cervejas artesanais;</li>
            <li>A possibilidade de contabilizar o número e a variedade de cervejas que experimentou;</li>
            <li>Acesso a um carrinho de compras para adquirir as suas cervejas favoritas diretamente pelo nosso site ou app;</li>
            <li>Espaço para os utilizadores deixarem comentários e opiniões sobre as suas cervejas favoritas.</li>
        </ul>
    </div>

    <div class="cta">
        <?= Html::a('Descubra as nossas Cervejas', ['/site/login'], ['class' => 'svg']) ?>
    </div>



</div>
</body>


</html>
