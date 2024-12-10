<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\SignupForm $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Criar Usuário';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="utilizador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="utilizador-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'nome')->textInput() ?>
        <?= $form->field($model, 'nif')->textInput() ?>
        <?= $form->field($model, 'telefone')->textInput() ?>
        <?= $form->field($model, 'morada')->textInput() ?>

        <?= $form->field($model, 'isFuncionario')->checkbox(['class' => 'role-checkbox is-funcionario']) ?>
        <?= $form->field($model, 'isUtilizador')->checkbox(['class' => 'role-checkbox is-utilizador']) ?>

        <div class="form-group">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
<?php
$this->registerJs(<<<JS
$('.role-checkbox').on('change', function () {
    if ($(this).hasClass('is-funcionario') && $(this).is(':checked')) {
        $('.is-utilizador').prop('checked', false);
    }
    if ($(this).hasClass('is-utilizador') && $(this).is(':checked')) {
        $('.is-funcionario').prop('checked', false);
    }
});
JS
);
?>