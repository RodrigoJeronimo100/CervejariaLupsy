<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Cerveja $model */

$this->params['breadcrumbs'][] = ['label' => 'Cervejas', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="cerveja-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                    return  number_format($model->preco, 2) . '€'; // Adds € symbol with 2 decimal places
                },
            ],
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return $model->estado ? 'Ativo' : 'Inativo';
                },
            ],
            [
                'attribute' => 'fornecedor',
                'value' => function ($model) {
                    return $model->fornecedor->nome;
                },
            ],
            [
                'attribute' => 'categoria',
                'value' => function ($model) {
                    return $model->categoria->nome;
                },
            ],
        ],
    ]) ?>

</div>