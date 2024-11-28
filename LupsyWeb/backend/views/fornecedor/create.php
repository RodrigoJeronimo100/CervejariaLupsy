<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fornecedor $model */


$this->params['breadcrumbs'][] = ['label' => 'Fornecedors', 'url' => ['index']];
$this->title = 'Criar Fornecedor';
?>
<div class="fornecedor-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<style>
    .m-0
    {
        font-weight: bolder;
    }
</style>