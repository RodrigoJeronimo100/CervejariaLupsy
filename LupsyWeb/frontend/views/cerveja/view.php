<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Cerveja $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cervejas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cerveja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <p>
    <?php
        // Verificar se a cerveja está nos favoritos do usuário logado
        $isFavorito = \common\models\Favorita::find()
            ->where(['id_user' => Yii::$app->user->id, 'id_cerveja' => $model->id])
            ->exists();
        
        // Configurar o texto e a cor do botão com base no estado do favorito
        $botaoTexto = $isFavorito ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos';
        $botaoClasse = $isFavorito ? 'btn btn-warning' : 'btn btn-success';

        // Botão para adicionar ou remover dos favoritos
        echo Html::a($botaoTexto, ['add-favorito', 'id' => $model->id], [
            'class' => $botaoClasse,
            'data-method' => 'post',
        ]);
        ?>
        </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'descricao',
            'teor_alcoolico',
            'preco',
            'id_fornecedor',
            'id_categoria',
        ],
    ]) ?>

</div>
