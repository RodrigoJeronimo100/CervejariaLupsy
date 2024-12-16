<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Cerveja $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php $this->registerCssFile("@web/css/form_cerveja.css"); ?>
<div class="cerveja-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="card">
        <a href="<?=\yii\helpers\Url::to(['/cerveja/view', 'id' => $model->id]) ?>" class="card-link">

            <div class="card-img"><div class="img"><?= Html::img('@web/img/beer.png', ['style' => 'width: 108px; height:108px; margin-left: -5px;']) ?></div></div>
            <div class="card-content">
                <div class="card-title"><?= $model->nome ?></div>
                <div class="card-subtitle"><?= $model->descricao ?></div>
            </div>
            </a>
            <hr class="card-divider">
            <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center w-100">
       

        <?php $form = ActiveForm::begin([
            'action' => Url::to(['/item-fatura/create']), // URL para item-fatura/create
            'method' => 'post',
            'options' => ['class' => 'd-flex align-items-center'], // Adiciona uma classe flexível
        ]); ?>
        <!-- Preço da cerveja -->
        <?= Html::hiddenInput('preco', $model->preco) ?>
        <div class="card-price"><?= $model->preco ?><span>€</span></div>
        <!-- Input oculto para o ID da cerveja -->
        <?= Html::hiddenInput('id_cerveja', $model->id) ?>

        <!-- Seletor de quantidade -->
        <div class="quantity-container d-flex align-items-center">
            <?= Html::input('number', 'quantidade', 1, [
                'class' => 'form-control quantity-input',
                'min' => 1,
                'style' => 'width: 60px;',
            ]) ?>
        </div>
                <button class="card-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="m397.78 316h-205.13a15 15 0 0 1 -14.65-11.67l-34.54-150.48a15 15 0 0 1 14.62-18.36h274.27a15 15 0 0 1 14.65 18.36l-34.6 150.48a15 15 0 0 1 -14.62 11.67zm-193.19-30h181.25l27.67-120.48h-236.6z"></path><path d="m222 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path><path d="m368.42 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path><path d="m158.08 165.49a15 15 0 0 1 -14.23-10.26l-25.71-77.23h-47.44a15 15 0 1 1 0-30h58.3a15 15 0 0 1 14.23 10.26l29.13 87.49a15 15 0 0 1 -14.23 19.74z"></path></svg>
                </button>
            </div>
        </div>



    <?php ActiveForm::end(); ?>

</div>
