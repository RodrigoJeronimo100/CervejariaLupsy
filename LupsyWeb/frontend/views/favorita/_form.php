<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Favorita $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="favorita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_utilizador')->textInput() ?>

    <?= $form->field($model, 'id_cerveja')->textInput() ?>

    <?= $form->field($model, 'data_adicao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
