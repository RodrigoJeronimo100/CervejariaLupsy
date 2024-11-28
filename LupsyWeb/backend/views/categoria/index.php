<?php

use backend\models\Categoria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="categoria-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'nome',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Categoria $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>

<style>
    .table tbody tr:nth-child(odd) {
        background-color: #dbd5bd;
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .table thead th {
        background-color: #323232;
        font-weight: bold;
    }

    .table thead th a {
        color: #fff;
        text-decoration: none;
    }

    .table thead th a:hover {
        color: #e4e4e4;
    }

    .m-0{
        font-weight: bolder;
    }
</style>
