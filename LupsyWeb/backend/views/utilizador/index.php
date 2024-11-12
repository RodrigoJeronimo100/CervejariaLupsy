<?php

use common\models\Utilizador;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */


?>
<div class="utilizador-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'nif',
            'telefone',
            'morada',
            //'id_user',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, Utilizador $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
