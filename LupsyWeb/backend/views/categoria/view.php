<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Categoria $model */

$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="categoria-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
        ],
    ]) ?>

</div>
