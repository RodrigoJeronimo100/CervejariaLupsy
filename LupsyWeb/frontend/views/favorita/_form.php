<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Favorita $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php $this->registerCssFile("@web/css/form_favorita.css"); ?>
<div class="favorita-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="card-title"><?= $model->cerveja->nome ?></div>
    <div class="card-subtitle"><?= $model->cerveja->descricao ?></div>

    <?= $form->field($model, 'data_adicao')->textInput(['value' => date('Y-m-d H:i:s')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
