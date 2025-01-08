<?php

use common\models\ItemFatura;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>

<div class="fatura-view">
    <?php $this->registerCssFile("@web/css/view_fatura.css"); ?>

    <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Home', 'url' => ['/site/index']],
        'links' => [
            ['label' => 'Fatura', 'url' => ['/fatura/index']],
            ['label' => 'Detalhes da Fatura', 'url' => null],
        ],
        'options' => ['class' => 'breadcrumb', 'style' => 'background-color: #f7f5f0; margin-top: 8pn; margin-bottom: -8px;'],
        'itemTemplate' => "<li style='display: inline-block; margin-right: 5px;'>{link}</li> &nbsp; > &nbsp; ",
        'activeItemTemplate' => "<li style='display: inline-block; margin-right: 5px; font-weight: bold;'>{link}</li>",
    ]); ?>

    <h1><?= Html::encode('Fatura') ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            [
                'label' => 'Estado',
                'value' => $model->estado,
            ],
        ],
    ]) ?>
    <?php if ($model->estado === 'aberta'): ?>
        <?= Html::a('<i class="fas fa-check"></i> Pagar', ['fatura/pagar', 'id' => $model->id], [
                'class' => 'btn btn-outline-success',
                'style' => 'background-color: #28a745; border-color: #28a745; color: white;',
                'data' => [
                    'confirm' => 'Tem certeza que deseja marcar esta fatura como paga?',
                    'method' => 'post',
                ],
            ]) ?>
    <?php endif; ?>
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
                'class' => yii\grid\ActionColumn::className(),
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fas fa-trash"></i>', // FontAwesome icon
                            $url,
                            [
                                'title' => 'Delete',
                                'data-confirm' => 'Tem certeza de que deseja excluir este item?',
                                'data-method' => 'post',
                                'style' => 'color: black;', // Make the icon black
                            ]
                        );
                    },
                ],
                'urlCreator' => function ($action, ItemFatura $model, $key, $index, $column) {
                    return Url::toRoute(['/item-fatura/' . $action, 'id' => $model->id]);
                }
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
        padding: 15px;
        font-weight: bold;
    }
    h2{
        font-family: "Space Grotesk", sans-serif;
        display: flex;
        justify-content: center;
        padding: 15px;
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
