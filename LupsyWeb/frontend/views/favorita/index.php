<?php

use common\models\Favorita;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Favoritas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorita-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'attribute' => 'cerveja.nome',
                'label' => 'Nome da Cerveja',
            ],
            [
                'attribute' => 'cerveja.descricao',
                'label' => 'Descrição da Cerveja',
            ],
            [
                'attribute' => 'data_adicao',
                'label' => 'Data de Adição',
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, Favorita $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
