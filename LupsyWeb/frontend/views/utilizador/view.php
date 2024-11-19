<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Utilizador $model */


$this->title = Html::encode($model->nome);
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php $this->registerCssFile("@web/css/view_user.css"); ?>
<div class="utilizador-view custom-view">
    <div class="image-container">
    <?= Html::img('@web/img/logonobg.png', ['alt' => 'Foto de Perfil', 'class' => 'toprowimg']); ?>
    </div>


    <h1 class="view-title"><?= Html::encode($this->title) ?></h1>


    <div class="details-container">
        <div class="detail-item">
            <div class="detail-title">Nome</div>
            <div class="detail-content"><?= Html::encode($model->nome) ?></div>
        </div>
        <div class="detail-item">
            <div class="detail-title">NIF</div>
            <div class="detail-content"><?= Html::encode($model->nif) ?></div>
        </div>
        <div class="detail-item">
            <div class="detail-title">Telefone</div>
            <div class="detail-content"><?= Html::encode($model->telefone) ?></div>
        </div>
        <div class="detail-item">
            <div class="detail-title">Morada</div>
            <div class="detail-content"><?= Html::encode($model->morada) ?></div>
        </div>
    </div>

    <div class="actions">
        <?= Html::a('Atualizar Dados', ['update', 'id' => $model->id], ['class' => 'btn-shineE']) ?>
        <?= Html::beginForm(['/site/logout'], 'post', ['class' => ''])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn-shineL']


            )
            . Html::endForm();
        ?>
        <?= Html::a('Excluir Conta', ['delete', 'id' => $model->id], [
            'class' => 'btn-shineD',
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir esta conta?',
                'method' => 'post',
            ],
        ]);

        ?>
    </div>

</div>
