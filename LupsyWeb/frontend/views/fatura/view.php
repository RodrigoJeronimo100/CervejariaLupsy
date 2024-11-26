<?php

use common\models\ItemFatura;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fatura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Nome',
                'value' => $model->utilizador->nome,
            ],
            'data_fatura',
            [
                'label' => 'Total',
                'value' => $model->getTotalFatura(),
                'format' => ['decimal', 2],
            ],
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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ItemFatura $model, $key, $index, $column) {
                    return Url::toRoute(['/item-fatura/' . $action, 'id' => $model->id]);
                 }
            ],
        ],
       
    ]); ?>

</div>
