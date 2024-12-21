<?php

use common\models\Fatura;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="fatura-index">
    <?php $this->registerCssFile("@web/css/index_fatura.css"); ?>
    <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Home', 'url' => ['/site/index']],
        'links' => [
            ['label' => 'Fatura', 'url' => null],
        ],
        'options' => ['class' => 'breadcrumb', 'style' => 'background-color: #f7f5f0; margin-top: 8pn; margin-bottom: -8px;'],
        'itemTemplate' => "<li style='display: inline-block; margin-right: 5px;'>{link}</li> &nbsp; > &nbsp; ",
        'activeItemTemplate' => "<li style='display: inline-block; margin-right: 5px; font-weight: bold;'>{link}</li>",
    ]); ?>
    <h1><?= Html::encode($title = 'Carrinho') ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            'data_fatura',
            'total',
            [
                'class' => yii\grid\ActionColumn::className(),
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fas fa-eye"></i>', // View icon
                            $url,
                            [
                                'title' => 'View',
                                'style' => 'color: black;', // Icon color: black
                            ]
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="fas fa-trash"></i>', // Delete icon
                            $url,
                            [
                                'title' => 'Delete',
                                'data-confirm' => 'Tem certeza de que deseja excluir este item?',
                                'data-method' => 'post',
                                'style' => 'color: black;', // Icon color: black
                            ]
                        );
                    },
                ],
                'urlCreator' => function ($action, Fatura $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
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