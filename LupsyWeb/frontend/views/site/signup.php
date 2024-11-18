<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCssFile("@web/css/signup.css"); ?>
</head>
<body>
<div class="site-signup">

    <h1><?= Html::encode($this->title) ?></h1>


    <form method="post">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="form-container">
            <div class="left-box">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Password') ?>
            </div>
            <div class="right-box">
            <?= $form->field($model, 'nome')->textInput() ?>

            <?= $form->field($model, 'nif')->textInput() ?>

            <?= $form->field($model, 'telefone')->textInput() ?>
            </div>


        </div>

        <div class="button-container">
            <?= $form->field($model, 'morada')->textInput() ?>
            <?= Html::submitButton('Signup', ['class' => 'button b-green rot-135', 'name' => 'signup-button']) ?>
        </div>

    </form>



</div>
</body>
    <?php ActiveForm::end(); ?>


