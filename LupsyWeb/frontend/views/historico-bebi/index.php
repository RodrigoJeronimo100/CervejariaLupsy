<?php

use frontend\models\HistoricoBebi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cervejas Bebidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->registerCssFile("@web/css/index_historico.css"); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<div class="historico-bebi-index">

    <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Home', 'url' => ['/site/index']],
        'links' => [
            ['label' => 'Histórico de Cervejas', 'url' => null],
        ],
        'options' => ['class' => 'breadcrumb', 'style' => 'background-color: #f7f5f0; margin-bottom: -8px;'],
        'itemTemplate' => "<li style='display: inline-block; margin-right: 5px;'>{link}</li> &nbsp; > &nbsp; ",
        'activeItemTemplate' => "<li style='display: inline-block; margin-right: 5px; font-weight: bold;'>{link}</li>",
    ]); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label' => 'Top Bebidas',
            'value' => function ($model, $key, $index, $widget) {
                switch ($index) {
                    case 0:
                        return '<i class="fa fa-trophy" style="color: gold; font-size: 18px;"></i>';
                    case 1:
                        return '<i class="fa fa-trophy" style="color: #939393; font-size: 18px;"></i>';
                    case 2:
                        return '<i class="fa fa-trophy" style="color: #cd7f32; font-size: 18px;"></i>';
                    default:
                        return $index + 1;
                }
            },
            'format' => 'raw',
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
<style>
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');

h1{
    font-family: "Space Grotesk", sans-serif;
    display: flex;
    justify-content: center;
    padding-left: 15px;
    padding-right: 15px;
    font-weight: bold;
}

.breadcrumb {
    font-size: 14px;
    color: #333;
}
.breadcrumb a {
    text-decoration: none;
    color: #373737;
}
.breadcrumb a:hover {
    text-decoration: none;
}
</style>