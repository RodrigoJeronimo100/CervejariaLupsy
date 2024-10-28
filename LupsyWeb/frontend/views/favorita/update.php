<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Favorita $model */

$this->title = 'Update Favorita: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Favoritas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="favorita-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
