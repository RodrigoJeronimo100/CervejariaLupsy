<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Utilizador $model */


$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->title = 'Criar Utilizador';
?>
<div class="utilizador-create">

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