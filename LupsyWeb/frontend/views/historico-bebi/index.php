<?php

use frontend\models\HistoricoBebi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Historico Bebis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-bebi-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label' => 'Top Bebidas',
            'value' => function ($model, $key, $index, $widget) {
                return $index + 1;
            },
            'headerOptions' => ['style' => 'text-align: center; font-weight: bold; background-color: #f3ca12;'], // Título em negrito e fundo amarelo
            'contentOptions' => [
            'style' => 'text-align: center; width: 50px; font-weight: bold; background-color: #f3ca12; color: white; font-size: 16px;'
            ],
        ],
        [
            'attribute' => 'cerveja_nome',
            'label' => 'Nome da Cerveja',
        ],
        [
            'attribute' => 'total_consumed',
            'label' => 'Quantidade Bebida',
        ],

    ],
]); ?>


</div>
