<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ItemFatura $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-fatura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_fatura')->textInput() ?>

    <?= $form->field($model, 'id_cerveja')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'preco_unitario')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
