<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Cerveja $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php $this->registerCssFile("@web/css/tabelas.css"); ?>
<div class="cerveja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teor_alcoolico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput(['maxlength' => true]) ?>

    <!-- Campo para selecionar o fornecedor -->
    <?= $form->field($model, 'id_fornecedor')->dropDownList(
        ArrayHelper::map(\backend\models\Fornecedor::find()->all(), 'id', 'nome'), 
      //  ['prompt' => 'Selecione um Fornecedor'] 
    ) ?>

    <?= $form->field($model, 'estado')->checkbox(['label' => 'Disponibilizar para Clientes', 'value' => 1, 'uncheck' => 0, 'checked' => $model->estado ? true : false,]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
