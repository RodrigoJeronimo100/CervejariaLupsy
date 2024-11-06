<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Utilizador $model */

$this->title = Html::encode($model->nome);
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilizador-update custom-view">
    <h1 class="view-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <div class="actions">
        <?= Html::a('Atualizar Dados', ['update', 'id' => $model->id], ['class' => 'btn-shineE']) ?>
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
        margin-top: 20px;
        }

        .btn-shineE {
        padding: 12px 48px;
        color: #fff;
        background: linear-gradient(to right, rgba(86, 170, 31, 0.8) 0, #fff 10%, rgba(61, 121, 23, 0.8) 20%);
        background-position: 0;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s infinite linear;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        font-family: "Poppins", sans-serif;
        border: none;
        cursor: pointer;
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