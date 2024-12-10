<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="utilizador-update">


    <div class="utilizador-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nome')->textInput() ?>
        <?= $form->field($model, 'nif')->textInput() ?>
        <?= $form->field($model, 'telefone')->textInput() ?>
        <?= $form->field($model, 'morada')->textInput() ?>


        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>

