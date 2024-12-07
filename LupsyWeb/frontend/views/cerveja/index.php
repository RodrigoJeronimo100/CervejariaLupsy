<?php

use common\models\Cerveja;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cerveja-index">
    <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Home', 'url' => ['/site/index']],
        'links' => [
            ['label' => 'Cervejas', 'url' => null],
        ],
        'options' => ['class' => 'breadcrumb', 'style' => 'background-color: #f7f5f0; margin-top: 4.3em; margin-bottom: -8px;'],
        'itemTemplate' => "<li style='display: inline-block; margin-right: 5px;'>{link}</li> &nbsp; > &nbsp; ",
        'activeItemTemplate' => "<li style='display: inline-block; margin-right: 5px; font-weight: bold;'>{link}</li>",
    ]); ?>
    <h1><?= Html::encode($title = 'Cervejas') ?></h1>
    <!-- Filtro de Categoria -->
    <div class="filtro-categoria">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
            'options' => ['class' => 'd-flex align-items-center gap-2'], 
        ]); ?>


        <?= Html::dropDownList('categoria', $id_categoria, 
            \yii\helpers\ArrayHelper::map(\backend\models\Categoria::find()->all(), 'id', 'nome'), 
            [
                'class' => 'form-select w-auto',
                'prompt' => 'Todas',
            ]
        ) ?>

        <?= Html::submitButton('<span class="button__text">Filtrar</span><span class="button__icon"><i class="fa fa-filter"></i></span>', [
            'class' => 'btn-custom-golden',
            'type' => 'submit',
            'style' => 'background-color: goldenrod; border: 1px solid #DAA520; font-weight: bold;',
        ]) ?>




        <?php ActiveForm::end(); ?>
    </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_form',
        'summary' => false,
    ]); ?>


</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
    h1{
        font-family: "Space Grotesk", sans-serif;
        display: flex;
        justify-content: center;
        padding-left: 15px;
        padding-right: 15px;
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
    .container{
        display: none;
    }
</style>





