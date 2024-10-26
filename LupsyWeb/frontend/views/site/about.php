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
            background-color: #eaeaea;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
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

        .button {
            border-radius: 9999px;
            padding: 1rem 2rem;
            font-weight: bold;
            background: none;
            position: relative;
            border: 0.25rem solid;
            color: inherit;
            font-size: 1.5rem;
            font-family: "Fredericka the Great";


            &:hover {
                cursor: pointer;
                color: #fff;
            }

            &::before {
                content: "LUPSY";
                color: #b69036;
                font-size: 4rem;
                padding-left: 0.5rem;
                position: absolute;
                inset: 0;
                transform: translateX(0.75rem) translateY(0.5rem) rotateZ(-3deg) skewX(-10deg);
                background-color: #a6822e;
                z-index: -2;
                border-radius: 1.4rem;
                border-bottom-right-radius: 1rem;
                border-bottom-left-radius: 2.25rem;
                border-top-left-radius: 1.25rem;
                transition: 250ms;
                border: 5rem solid #a6822e;
                border-top: 0 solid transparent;
                border-left: 0 solid transparent;
            }

            &:hover::before {
                color: rgb(175, 151, 13);

                transform: translateX(0) translateY(-0.5rem) rotateZ(0deg) skewX(0) scaleX(25.25) scaleY(0.5);
                border-radius: 0.25rem;
                border-color:  rgb(175, 151, 13);
                border-bottom-right-radius: 0.2rem;
                border-bottom-left-radius: 0.2rem;
                border-top-left-radius: 0.2rem;
                background-color:  rgb(175, 151, 13);
            }
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
        <?= Html::a('Descubra as nossas Cervejas', ['/site/login'], ['class' => 'button']) ?>
    </div>

</div>
</body>


</html>
