<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Utilizador $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="utilizador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nif')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>


    <div class="actions">
        <?= Html::submitButton('Atualizar Dados', ['class' => 'btn-shineE']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>