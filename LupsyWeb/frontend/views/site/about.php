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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap');

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0 30px;

        }


        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            color: #555;
            margin-top: 20px;
        }

        p {
            color: #666;
            margin-bottom: 15px;
        }

        .mission {
            background-color: rgba(219, 213, 190, 0.8);
            padding: 15px;
            border-radius: 10px;
        }

        .mission h2 {
            color: #333;
        }

        .mission p {
            color: #444;
        }

        .team {
            margin-top: 30px;
        }

        .team h2 {
            color: #333;
        }

        .team p {
            color: #444;
        }

        .cta {
            text-align: center;
            margin-top: 30px;
            padding-bottom: 30px;
        }

        .svg{
            -webkit-transition: all 150ms cubic-bezier(0.445, 0.050, 0.550, 0.950);
            position: relative;
            height: 45px;
            width: 150px;
            text-decoration: none;
            margin: 10px 7px;
            padding: 10px 5px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 2px;
            color: #383736;
            border: 2px #383736 solid;
            border-radius: 20px;
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
            text-underline: none;

        }

        .svg:before{
            position:absolute;
            content:"";
            background: url(https://f.cl.ly/items/3H3A0D1N281a2T280F3o/heist.svg) no-repeat center center;
            width:100%;
            height:100%;
            top:0;
            left:0;
            border-radius: 20px;
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
            border-radius: 20px;
        }

        .svg:hover{
            color:white;
            border-radius: 20px;
            border: 0px #d19b26 solid;
        }

        .svg:hover:before {
            opacity: .8;
        }

        .svg:hover:after {
            top: 0;
        }

        .title-n{
            font-family: "Space Grotesk", sans-serif;
            font-weight: 700;

        }

        .content-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .text-content {
            width: 50%;
        }

        .met-met2 {
            width: 30%;
            margin-right: 120px;
            margin-bottom: 60px;

        }


        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
                align-items: center;
            }

            .text-content, .met-met2 {
                width: 100%;
                margin-left: 0;
                text-align: center;
            }
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
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
