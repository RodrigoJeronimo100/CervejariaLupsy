<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cerveja $model */

$this->title = 'A Atualizar Cerveja >> ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cervejas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cerveja-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
