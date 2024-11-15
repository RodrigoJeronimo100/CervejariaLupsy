<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Cerveja $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cerveja-form">

    <?php $form = ActiveForm::begin(); ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
