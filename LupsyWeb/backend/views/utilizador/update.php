<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Utilizador $model */
/** @var common\models\User $user */


$this->title = 'A Atualizar Utilizador >> ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="utilizador-update">


    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
