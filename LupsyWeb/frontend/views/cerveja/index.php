<?php

use common\models\Cerveja;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cerveja-index">
    <br><br><br>
    <!-- Filtro de Categoria -->
    <div class="filtro-categoria mb-3">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
            'options' => ['class' => 'd-flex align-items-center gap-2'], 
        ]); ?>

        <?= Html::label('Filtrar por categoria:', 'categoria', ['class' => 'form-label me-2']) ?>

        <?= Html::dropDownList('categoria', $id_categoria, 
            \yii\helpers\ArrayHelper::map(\backend\models\Categoria::find()->all(), 'id', 'nome'), 
            [
                'class' => 'form-select w-auto',
                'prompt' => 'Todas',
            ]
        ) ?>

        <?= Html::submitButton('<i class="fas fa-filter"></i> Filtrar', [
            'class' => 'btn btn-primary btn-sm px-4 py-2 rounded-pill',
            'style' => 'background-color: #007bff; border: none; font-weight: bold;',
        ]) ?>

        <?php ActiveForm::end(); ?>
    </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_form',
        'summary' => false,
    ]); ?>


</div>




