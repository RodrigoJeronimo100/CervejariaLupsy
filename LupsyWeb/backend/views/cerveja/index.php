<?php

use common\models\Cerveja;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cervejas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cerveja-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Cerveja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
            'descricao',
            [
                'attribute' => 'teor_alcoolico',
                'value' => function ($model) {
                    return $model->teor_alcoolico . '%'; // Adds % symbol
                },
            ],
            [
                'attribute' => 'preco',
                'value' => function ($model) {
                    return number_format($model->preco, 2) . '€'; // Adds € symbol with 2 decimal places
                },
            ],
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return $model->estado ? 'Ativo' : 'Inativo';
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cerveja $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>

<style>
    .cerveja-index table tbody tr:nth-child(odd) {
        background-color: #dbd5bd;
    }

    .cerveja-index table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .cerveja-index table thead th {
        background-color: #323232;
        font-weight: bold;
    }

    .cerveja-index table thead th a {
        color: #fff;
        text-decoration: none;
    }

    .cerveja-index table thead th a:hover {
        color: #e4e4e4;
    }
</style>