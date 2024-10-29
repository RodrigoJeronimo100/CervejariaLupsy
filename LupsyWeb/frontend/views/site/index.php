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

<section class="main-content">
    <div class="content-row">
        <?= Html::img('@web/img/miniMeioCEV.png', ['alt' => 'Bar Scene', 'class' => 'main-img']) ?>

        <div class="text-content">
            <h2>ONDE QUISERES</h2>
            <p>Com a nossa nova plataforma Lupsy podes levar os teus gostos de cerveja para onde quiseres.</p>
            <p>Através da nossa Aplicação Móvel e do nosso Website.</p>
            <p>Junta-te a nós nesta nova aventura.</p>
            <button class="svg">Entrar</button>
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

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Suranna&display=swap');


    body {
        background-color: rgba(219, 213, 190, 0.22);
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
        box-shadow: 0 8px 20px rgba(0, 0, 0, 1);
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
    

    .text-in-image button{
        outline: white;
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
        border-radius: 20px;
        margin-top: -100px;
        margin-bottom: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 1);
    }

    .text-content {
        width: 50%;
        padding: 20px;
        margin-top: -100px;
        margin-bottom: 30px;
    }

    .text-content h2 {
        font-size: 40px;
        font-weight: bolder;
        margin-bottom: 40px;
        font-family: "Space Grotesk", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    .text-content p {
        font-size: 16px;
        line-height: 1;
        font-weight: 500;

    }

    .grid {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 120px;

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
    }


    .grid-item1 {
        width: 35%;
        background-color: #1e1e1e;
        border-radius: 20px;
        padding-bottom: 20px;
        transition: box-shadow 0.3s ease;
    }

    .grid-item1:hover{
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    .grid-item1 img {
        width: 100%;
        height: 338px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .grid-item1 h3 {
        font-size: 70px;
        margin: 10px 0;
        padding-left: 20px;
        color: #e7e7e7;
        font-family: "Suranna", serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    .grid-item1 p {
        font-size: 16px;
        margin-bottom: 10px;
        padding-left: 20px;
        color: #e7e7e7;

    }

    .grid-item2 {
        width: 35%;
        background-color: #e7e7e7;
        border-radius: 20px;
        padding-bottom: 20px;
        transition: box-shadow 0.3s ease;
    }

    .grid-item2:hover{
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    .grid-item2 img {
        width: 100%;
        height: 338px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .grid-item2 h3 {
        font-size: 70px;
        margin: 10px 0;
        padding-left: 20px;
        color: #1e1e1e;
        font-family: "Suranna", serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    .grid-item2 p {
        font-size: 16px;
        margin-bottom: 10px;
        padding-left: 20px;
    }

    .svg{
        -webkit-transition: all 150ms cubic-bezier(0.445, 0.050, 0.550, 0.950);
        position: relative;
        display:block;
        height: 45px;
        width: 150px;
        margin: 10px 7px;
        padding: 5px 5px;
        font-weight: 700;
        font-size: 15px;
        letter-spacing: 2px;
        color: #383736;
        border: 2px #383736 solid;
        border-radius: 15px;
        text-transform: uppercase;
        outline: 0;
        overflow:hidden;
        background: none;
        z-index: 1;
        cursor: pointer;
        transition:         0.08s ease-in;
        -o-transition:      0.08s ease-in;
        -ms-transition:     0.08s ease-in;
        -moz-transition:    0.08s ease-in;

    }

    .svg:before{
        position:absolute;
        content:"";
        background: url(https://f.cl.ly/items/3H3A0D1N281a2T280F3o/heist.svg) no-repeat center center;
        width:100%;
        height:100%;
        top:0;
        left:0;
        z-index:-1;
        opacity:0;
        -webkit-transition: all 250ms cubic-bezier(0.230, 1.000, 0.320, 1.000);
    }

    .svg:after {
        content: "";
        position: absolute;
        background: #d19b26;
        bottom: 0;
        left: 0;
        right: 0;
        top: 100%;
        z-index: -2;
        -webkit-transition: all 250ms cubic-bezier(0.230, 1.000, 0.320, 1.000);
    }

    .svg:hover{
        color:white;
        border: 0px #d19b26 solid;
    }

    .svg:hover:before {
        opacity: .8;
    }

    .svg:hover:after {
        top: 0;
    }


</style>
</html>
