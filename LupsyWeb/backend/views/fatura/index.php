<?php

use common\models\Fatura;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="fatura-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Filtro de Estados -->
    <div class="filtro-estado mb-3">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
            'options' => ['class' => 'd-flex align-items-center gap-2'], 
        ]); ?>

        <?= Html::label('Filtrar por estado:', 'estado', ['class' => 'form-label me-2']) ?>

        <?= Html::dropDownList('estado', $estado, [
            'todas' => 'Todas',
            'paga' => 'Paga',
            'aberta' => 'Aberta',
        ], ['class' => 'form-select w-auto']) ?>

        <?= Html::submitButton('<i class="fas fa-filter"></i> Filtrar', [
            'class' => 'btn btn-primary btn-sm px-4 py-2 rounded-pill',
            'style' => 'background-color: #007bff; border: none; font-weight: bold;',
        ]) ?>


        <?php ActiveForm::end(); ?>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'id_utilizador',
            [
                'attribute' => 'cliente',
                'value' => function ($model) {
                    return $model->utilizador->nome;
                },
            ],
            'data_fatura',
            'estado',
            'total',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}',
                'urlCreator' => function ($action, Fatura $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>
