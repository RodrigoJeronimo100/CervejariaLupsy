<?php

use common\models\Cerveja;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cerveja-index">



    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_form',
        'summary' => false,
    ]); ?>


</div>
