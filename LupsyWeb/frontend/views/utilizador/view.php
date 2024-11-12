<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Utilizador $model */


$this->title = Html::encode($model->nome);
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="utilizador-view custom-view">
    <div class="image-container">
    <?= Html::img('@web/img/logonobg.png', ['alt' => 'Foto de Perfil', 'class' => 'toprowimg']); ?>
    </div>

    <h1 class="view-title"><?= Html::encode($this->title) ?></h1>


    <div class="details-container">
        <div class="detail-item">
            <div class="detail-title">Nome</div>
            <div class="detail-content"><?= Html::encode($model->nome) ?></div>
        </div>
        <div class="detail-item">
            <div class="detail-title">NIF</div>
            <div class="detail-content"><?= Html::encode($model->nif) ?></div>
        </div>
        <div class="detail-item">
            <div class="detail-title">Telefone</div>
            <div class="detail-content"><?= Html::encode($model->telefone) ?></div>
        </div>
        <div class="detail-item">
            <div class="detail-title">Morada</div>
            <div class="detail-content"><?= Html::encode($model->morada) ?></div>
        </div>
    </div>

    <div class="actions">
        <?= Html::a('Atualizar Dados', ['update', 'id' => $model->id], ['class' => 'btn-shineE']) ?>
        <?= Html::beginForm(['/site/logout'], 'post', ['class' => ''])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn-shineL']


            )
            . Html::endForm();
        ?>
        <?= Html::a('Excluir Conta', ['delete', 'id' => $model->id], [
            'class' => 'btn-shineD',
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir esta conta?',
                'method' => 'post',
            ],
        ]);

        ?>
    </div>

</div>

<style>

    .custom-view {
        max-width: 40%;
        margin: 0 auto;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .view-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .details-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .detail-item {
        width: 48%;
        padding: 10px;
    }

    .detail-title {
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }

    .detail-content {
        color: #333;
    }

    .image-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .toprowimg{
        height: auto;
        border-radius: 50%;
        width:50%;
    }

    .btn-shineE {

        padding: 12px 48px;
        color: #fff;
        background: linear-gradient(to right, rgba(86, 170, 31, 0.8) 0, #fff 10%, rgba(61, 121, 23, 0.8) 20%);
        background-position: 0;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s infinite linear;
        animation-fill-mode: forwards;
        -webkit-text-size-adjust: none;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        white-space: nowrap;
        font-family: "Poppins", sans-serif;
    }
    .btn-shineD {

        padding: 12px 48px;
        color: #fff;
        background: linear-gradient(to right, #a61919 0, #fff 10%, #731010 20%);
        background-position: 0;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s infinite linear;
        animation-fill-mode: forwards;
        -webkit-text-size-adjust: none;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        white-space: nowrap;
        font-family: "Poppins", sans-serif;
    }

    .btn-shineL {

        border: none;
        padding: 12px 48px;
        color: #fff;
        background: linear-gradient(to right, #eca523 0, #fff 10%, #9f7b20 20%);
        background-position: 0;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s infinite linear;
        animation-fill-mode: forwards;
        -webkit-text-size-adjust: none;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        white-space: nowrap;
        font-family: "Poppins", sans-serif;
    }
    @-moz-keyframes shine {
        0% {
            background-position: 0;
        }
        60% {
            background-position: 180px;
        }
        100% {
            background-position: 180px;
        }
    }
    @-webkit-keyframes shine {
        0% {
            background-position: 0;
        }
        60% {
            background-position: 180px;
        }
        100% {
            background-position: 180px;
        }
    }
    @-o-keyframes shine {
        0% {
            background-position: 0;
        }
        60% {
            background-position: 180px;
        }
        100% {
            background-position: 180px;
        }
    }
    @keyframes shine {
        0% {
            background-position: 0;
        }
        60% {
            background-position: 180px;
        }
        100% {
            background-position: 180px;
        }
    }
</style>