<?php

use frontend\models\HistoricoBebi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cervejas Bebidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->registerCssFile("@web/css/index_historico.css"); ?>
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
            'headerOptions' => ['style' => 'text-align: center; font-weight: bold;  background-color: #1e1e1e; color: #e7e7e7'],
            'contentOptions' => [
            'style' => 'text-align: center; width: 50px; font-weight: bold; color: white; padding: 10px 0 10px 0; font-size: 16px;'
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

