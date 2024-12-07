<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fatura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_utilizador')->textInput(['readonly' => true,])->label() ?>

    <?= $form->field($model, 'data_fatura')->textInput(['readonly' => true,])->label() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true,'readonly' => true,])->label() ?>

    <?= $form->field($model, 'estado')->dropDownList($model::getEstados()) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
