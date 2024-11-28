<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Categoria $model */


$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->title = 'Criar Categoria';
?>
<div class="categoria-create">


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
