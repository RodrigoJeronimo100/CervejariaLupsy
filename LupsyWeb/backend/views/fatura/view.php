<?php

use yii\grid\GridView;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="fatura-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_utilizador',
            'data_fatura',
            'total',
            'estado',
        ],
    ]) ?>
 <h2>Itens da Fatura</h2>
    <?= GridView::widget([
        'dataProvider' => new yii\data\ArrayDataProvider([
            'allModels' => $model->itemFaturas,  
            'pagination' => [
                'pageSize' => 10,
            ],
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'nome_cerveja',
                'value' => function ($model) {
                    return $model->cerveja ? $model->cerveja->nome : 'Sem nome';
                },
            ],
            'quantidade',
            'preco_unitario',
            [
                'attribute' => 'preco',
                'value' => function ($model) {
                    return $model->quantidade * $model->preco_unitario;
                },
                'format' => ['decimal', 2],
            ],
          
        ],
       
    ]); ?>
</div>
