<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Favorita $model */

$this->params['breadcrumbs'][] = ['label' => 'Favoritas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="favorita-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_utilizador',
            'id_cerveja',
            'data_adicao',
        ],
    ]) ?>

</div>
