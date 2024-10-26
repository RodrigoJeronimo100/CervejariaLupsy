<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contactos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="cta">
                    <?= Html::submitButton('Submeter Feedback', ['class' => 'svg', 'name' => 'contact-button']) ?>
                </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

<style>
    body{
        padding: 0 30px;
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
        width: 300px;
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
        border-radius: 16px;
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
