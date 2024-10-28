<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Favorita $model */

$this->title = 'Create Favorita';
$this->params['breadcrumbs'][] = ['label' => 'Favoritas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorita-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
