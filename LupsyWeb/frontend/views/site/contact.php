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
                    <?= Html::submitButton('Submeter Feedback', ['class' => 'button', 'name' => 'contact-button']) ?>
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


</style>
