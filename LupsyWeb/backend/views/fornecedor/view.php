<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Fornecedor $model */

$this->params['breadcrumbs'][] = ['label' => 'Fornecedors', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="fornecedor-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'morada',
            'nif',
            'telefone',
        ],
    ]) ?>

</div>
