<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var \common\models\HistoricoBebi $model */


$this->params['breadcrumbs'][] = ['label' => 'Historico Bebis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="historico-bebi-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_utilizador',
            'id_cerveja',
            'data',
        ],
    ]) ?>

</div>
