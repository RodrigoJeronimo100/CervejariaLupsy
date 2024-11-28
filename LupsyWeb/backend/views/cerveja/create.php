<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cerveja $model */

$this->title = 'Criar Cerveja';

$this->params['breadcrumbs'][] = ['label' => 'Cervejas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cerveja-create">


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