<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fatura-view">

    <p>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_utilizador',
            'data_fatura',
            'total',
            'estado',
        ],
    ]) ?>

</div>
