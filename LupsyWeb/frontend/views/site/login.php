<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>
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

            <?php ActiveForm::end(); ?>
</div>
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);


    * { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

    html { width: 100%; height:100%; overflow:hidden; }

    body {
        width: 100%;
        height:100%;
        font-family: 'Open Sans', sans-serif;
        background-image: url(https://i.ibb.co/TW9rm2G/loginbgimg.png);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
    }
    .login {
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -150px 0 0 -150px;
        width:300px;
        height:300px;
    }
    .login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.7); letter-spacing:4px; font-weight: bold; text-align:center; margin-bottom:20px;}

    input {
        width: 100%;
        margin-bottom: 10px;
        background: rgba(219, 213, 190, 0.84);
        outline: none;
        padding: 10px;
        font-size: 13px;
        color: #fff;
        text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
        border: 1px solid rgb(0, 0, 0);
        border-radius: 10px;
        box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
        -webkit-transition: box-shadow .5s ease;
        -moz-transition: box-shadow .5s ease;
        -o-transition: box-shadow .5s ease;
        -ms-transition: box-shadow .5s ease;
        transition: box-shadow .5s ease;
    }
    input:focus { box-shadow: inset 0 -5px 45px rgb(228, 200, 26), 0 1px 1px rgb(159, 123, 32); }


    .mini-txt{
        font-size: 12px;
    }
    .button-container {
        position: relative;
        display: inline-block;
    }

    .button {
        position: relative;
        margin-top: 10px;
        padding: 15px 35px;
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        background-color: #ffcc00;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        overflow: hidden;
        outline: none;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #f5a623;
    }



    .button-container::before,
    .button-container::after {
        content: '';
        position: absolute;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        pointer-events: none;
        opacity: 0;
    }

    .button-container::before {
        width: 10px;
        height: 10px;
        bottom: 10px;
        left: 20%;
        animation: bubbles 4s infinite ease-in-out;
    }

    .button-container::after {
        width: 6px;
        height: 6px;
        bottom: 10px;
        left: 60%;
        animation: bubbles 3s infinite ease-in-out;
    }

    .button-container:hover::before,
    .button-container:hover::after {
        opacity: 1;
    }


    @keyframes bubbles {
        0% {
            transform: translateY(0);
            opacity: 1;
        }
        100% {
            transform: translateY(-100px);
            opacity: 0;
        }
    }



    .field-loginform-rememberme input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        width: 0;
        height: 0;
    }

    .custom-checkbox {
        width: 15px;
        height: 15px;
        border: 2px solid #ccc;
        border-radius: 3px;
        display: inline-block;
        position: relative;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .field-loginform-rememberme input[type="checkbox"]:checked + .custom-checkbox {
        background-color: #ffcc00;
        border-color: #ffcc00;
        animation: checkbox-bounce 0.3s ease;
    }

    .custom-checkbox::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 5px;
        width: 4px;
        height: 8px;
        border: solid white;
        border-width: 0 2px 2px 0;
        opacity: 0;
        transform: rotate(45deg) scale(0);
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .field-loginform-rememberme input[type="checkbox"]:checked + .custom-checkbox::after {
        opacity: 1;
        transform: rotate(45deg) scale(1);
    }

    @keyframes checkbox-bounce {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
        }
    }

    .field-loginform-rememberme label {
        cursor: pointer;
        padding: 5px;


    }

    .yellow-link {
        color: #917605;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .yellow-link:hover {
        color: #a67c09;
        text-decoration: underline;
    }



</style>

