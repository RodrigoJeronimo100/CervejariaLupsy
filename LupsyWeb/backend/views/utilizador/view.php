<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Utilizador $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadors', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="utilizador-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'nif',
            'telefone',
            'morada',
            'id_user',
        ],
    ]) ?>

</div>