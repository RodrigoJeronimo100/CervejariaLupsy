<?php

use common\models\Nota;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Notas';
?>
<div class="nota-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id_user',
            [
                'attribute' => 'Utilizador',
                'value' => function ($model) {
                    return $model->utilizador->nome;
                },
            ],
            'id_cerveja',
            [
                'attribute' => 'Cerveja',
                'value' => function ($model) {
                    return $model->cerveja->nome;
                },
            ],
            'nota',

        ],
    ]); ?>


</div>
