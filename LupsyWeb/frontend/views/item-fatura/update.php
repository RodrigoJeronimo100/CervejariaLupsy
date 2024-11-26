<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ItemFatura $model */

$this->title = 'Update Item Fatura: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Item Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-fatura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
