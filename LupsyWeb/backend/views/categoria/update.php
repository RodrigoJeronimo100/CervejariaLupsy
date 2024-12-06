<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Categoria $model */

$this->title = 'A Atualizar Categoria >> ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categoria-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
