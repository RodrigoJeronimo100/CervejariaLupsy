<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCssFile("@web/css/login.css"); ?>
</head>
<body>
<div class="login">
    <h1><?= Html::encode($this->title) ?></h1>

    <form method="post">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Password') ?>

            <?= $form->field($model, 'rememberMe')->checkbox(['template' => "{input}<span class='custom-checkbox'></span>{label}"])->label('Lembrar') ?>

            <div  class="mini-txt">
                <?= Html::a('Esqueceste-te da password?', ['site/request-password-reset'],['class' => 'yellow-link']) ?>
                <br>
                <?= Html::a('Não tens conta? Cria Conta', ['site/signup'],['class' => 'yellow-link']) ?>
            </div>

            <div class="button-container">
                <?= Html::submitButton('Entrar', ['class' => 'button b-green rot-135', 'name' => 'login-button']) ?>
            </div>

    </form>
</div>
</body>
            <?php ActiveForm::end(); ?>

