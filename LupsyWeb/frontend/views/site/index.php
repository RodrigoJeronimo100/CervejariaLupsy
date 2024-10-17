<?php

use yii\helpers\Html;

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../web/css/pagina-frontal.css">

</head>
<body>
    <div class="menu-icon">
        <button>&#9776;</button>
    </div>




<!-- Banner Section -->
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
            <button class="button-sh">Descobrir</button>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="main-content">
    <div class="content-row">
        <?= Html::img('@web/img/miniMeioCEV.png', ['alt' => 'Bar Scene', 'class' => 'main-img']) ?>

        <div class="text-content">
            <h2>Your Title Here</h2>
            <p>Your description or text goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </div>

    <div class="grid">
        <div class="grid-item">
            <?= Html::img('@web/img/cardBottomCEV.png', ['alt' => 'IBU', 'class' => 'grid-img']) ?>
            <!--<img src="../../web/img/cardBottomCEV.png" alt="IBU" class="grid-img">-->
            <h3>IBU   <a href="#" class="arrow-link"></a></h3>
            <p>Medida utilizada para quantificar o nível de amargor em cervejas, com base na concentração de compostos amargos, como os ácidos presentes no lúpulo.</p>

        </div>
        <div class="grid-item">
            <img src="../../web/img/card2BottomCEV.png" alt="Teor de Álcool" class="grid-img">
            <h3>Teor de Álcool</h3>
            <p>Porcentagem de álcool presente em uma bebida, geralmente expressa em volume, indicando a concentração de etanol e a intensidade alcoólica da bebida.</p>
            <a href="#">Learn More &raquo;</a>
        </div>
    </div>
</section>

</body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');

    .container{
        max-width: 1920px;
        --bs-gutter-x: 0rem !important;
    }
    main > .container, main > .container-fluid{
        padding: 0;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        background-color: #f5f5f5;
        cursor: url('data:image/x-icon;base64,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'), auto;
    }

    .logo h1 {
        font-size: 24px;
        font-weight: bold;
    }

    .top-middle-content{
        margin-top: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 400px;
        text-align: center;
    }

    .middle-img{
        max-width: 70%;
        height: auto;
        border-radius: 20px;
    }


    .menu-icon button {
        font-size: 24px;
        background: none;
        border: none;
        color: #fff;
        cursor: pointer;
    }

    .banner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #1E1E1E;
        color: #fff;

    }

    .banner img {
        width: 100%;
        height: auto;
        margin-top: 20px;
    }

    .text-in-image{
        margin-left: 800px;
        margin-top: -320px;
        margin-bottom: 300px;
        
    }

    .button-sh{
        width: 155px;
        height: 45px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        color: #000;
        background-color: #ccceda;
        border: none;
        border-radius: 15px;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease 0s;
        cursor: pointer;
        outline: 2px solid #ffffff;
        font-family: "Space Grotesk", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    .button-sh:hover {
        background-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0px 15px 20px rgba(46, 229, 157, 0);
        transform: translateY(-7px);
    }
    }

    .text-in-image button{
        outline: white;
    }

    .bg-dark{
        background-color: #1B1B1B !important;
        padding-left: 20px;
        padding-right: 20px;
    }

    .text-in-image p {
        color: white;
        line-height: 2;
    }

    .overlay {
        margin-top: 60px;
    }

    .overlay h1 {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .overlay p {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .overlay button {
        padding: 10px 20px;
        font-size: 18px;
        background-color: rgba(255, 255, 255, 0);
        color: #fff;

    }

    .main-content {
        margin-top: 100px;
        padding: 20px;
    }

    .content-row {
        display: flex;
        align-items: center;
        margin-bottom: 40px;
    }

    .main-img {
        width: 50%;
        height: auto;
    }

    .text-content {
        width: 50%;
        padding: 20px;
    }

    .text-content h2 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .text-content p {
        font-size: 16px;
        line-height: 1.5;
    }

    .grid {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 120px;

    }

    .grid-item {
        width: 35%;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 20px;
        padding-bottom: 20px;
    }

    .grid-item img {
        width: 100%;
        height: auto;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .grid-item h3 {
        font-size: 22px;
        margin: 10px 0;
        padding-left: 20px;
    }

    .grid-item p {
        font-size: 16px;
        margin-bottom: 10px;
        padding-left: 20px;
    }

    .grid-item a {
        font-size: 16px;
        color: #000;
        text-decoration: none;
    }

    .grid-item a:hover {
        text-decoration: underline;
    }

    .arrow-link {
        display: inline-flex;
        align-items: center;
        margin-left: 5px;
        text-decoration: none;
        color: inherit;
    }

    .arrow-link::after {
        content: '';
        display: inline-block;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid currentColor;
        margin-left: 5px; transform: rotate(270deg);
    }</style>
</html>
