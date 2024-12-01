<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Cerveja $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cervejas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php $this->registerCssFile("@web/css/view_cerveja.css"); ?>
<div class="cerveja-view custom-view">

    <div class="details-container">
        <div class="detail-item">
            <svg width="200px" height="200px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M222.749811 198.548612h487.622407v799.556811H222.749811z" fill="#EBA824"></path><path d="M222.749811 903.064563h487.622407v66.4651H222.749811z" fill="#EACC53"></path><path d="M312.639978 432.799283h41.134982V923.596775h-41.134982zM447.192999 432.799283h41.134983V923.596775h-41.134983zM578.570936 432.799283h41.134983V923.596775H578.570936z" fill="#EACC53"></path><path d="M828.767588 345.731413h-118.324813v38.030456H782.481913c26.10625 0 47.485151 21.378902 47.485151 47.485151v335.6417c0 26.10625-21.378902 47.485151-47.485151 47.485152h-72.039138v38.030455h118.324813c26.10625 0 47.485151-21.378902 47.485151-47.485151V393.216564c0-26.10625-21.378902-47.485151-47.485151-47.485151z" fill="#6E4921"></path><path d="M185.848274 101.532144s-58.562668 98.145387 41.981672 129.825673c26.10625 5.574037 79.94157-2.398953 111.621856-15.028733 15.028733-3.175084 52.212499-14.252601 64.912837 25.330118 10.301385 16.651554 52.212499 64.912837 85.515606 7.902432 10.301385-24.553986 18.979949-54.611452 62.513884-49.884104 26.10625 3.951216 103.366637 32.033074 158.048646 13.053125 0.211672 47.979053 0 50.801351 0 50.801351s71.96858-10.019155 49.390202-103.437194c-7.126301-24.553986-38.030455-69.640185-89.466823-68.864053-20.60277-7.126301-37.183766-22.155033-49.884103-30.904155-14.252601-9.525253-96.593123-56.234273-162.282092-7.902433-20.60277-6.773513-37.183766-19.403294-80.717702-25.330117-36.054847-3.104527-124.957211-5.291807-191.633983 74.43809z" fill="#F5ECDA"></path><path d="M246.809895 107.811755s0.070557-0.211672 0.282229-0.564459c0.211672-0.352787 0.423345-0.917247 0.846689-1.552264 0.776132-1.340591 1.905051-3.175084 3.527872-5.362365 1.622821-2.257838 3.668986-4.797905 6.279611-7.620202 0.635017-0.705574 1.340591-1.411149 2.046166-2.116723l2.18728-2.187281c1.552263-1.481706 3.175084-2.892855 4.93902-4.445118 0.846689-0.776132 1.834493-1.481706 2.75174-2.18728 0.987804-0.705574 1.905051-1.481706 2.963412-2.257838 0.987804-0.776132 2.046166-1.411149 3.104527-2.18728 1.058361-0.705574 2.18728-1.481706 3.3162-2.187281 2.257838-1.411149 4.586233-2.822297 7.1263-4.092331 2.46951-1.340591 5.080135-2.540068 7.69076-3.739544 1.340591-0.635017 2.681182-1.128919 4.092331-1.693378 1.411149-0.493902 2.75174-1.128919 4.162889-1.622821 2.892855-0.917247 5.785709-1.975608 8.749121-2.681182 1.481706-0.423345 3.03397-0.776132 4.515676-1.128919 1.552263-0.352787 3.03397-0.635017 4.586233-0.917247 3.104527-0.635017 6.209054-0.987804 9.384138-1.411148 3.175084-0.352787 6.350169-0.493902 9.454696-0.635017h8.255219l1.199477 0.070557c6.279611 0.352787 12.418108 1.199476 18.203817 2.540068 1.481706 0.352787 2.892855 0.705574 4.304003 1.058361 0.705574 0.211672 1.411149 0.352787 2.116723 0.56446 0.705574 0.211672 1.411149 0.423345 2.046166 0.705574 1.340591 0.423345 2.681182 0.917247 4.021773 1.340591 0.635017 0.211672 1.340591 0.423345 1.975608 0.705574 0.635017 0.211672 1.270034 0.564459 1.905051 0.776132 1.270034 0.564459 2.46951 1.058361 3.668986 1.622821 1.199476 0.564459 2.398953 0.987804 3.527872 1.622821 2.257838 1.270034 4.374561 2.398953 6.420726 3.598429 0.493902 0.28223 0.987804 0.564459 1.481706 0.917247 0.493902 0.352787 0.987804 0.635017 1.411149 0.987804 0.917247 0.635017 1.834493 1.270034 2.681182 1.90505 0.846689 0.635017 1.693378 1.270034 2.540068 1.834494 0.423345 0.28223 0.776132 0.564459 1.199476 0.917246 0.352787 0.352787 0.776132 0.635017 1.128919 0.987804 1.411149 1.270034 2.822297 2.398953 3.951216 3.598429 0.564459 0.564459 1.199476 1.128919 1.693379 1.622821 0.564459 0.493902 0.987804 1.128919 1.481706 1.622821 0.917247 1.058361 1.763936 1.975608 2.398952 2.822297 0.705574 0.846689 1.270034 1.552263 1.693379 2.116723 0.423345 0.564459 0.776132 1.058361 0.987804 1.340591 0.211672 0.28223 0.352787 0.493902 0.352787 0.493902l-0.987804 1.834494s-2.540068-1.199476-6.985186-3.3162c-1.128919-0.564459-2.398953-1.058361-3.739544-1.622821-1.340591-0.564459-2.892855-1.128919-4.445118-1.763935-1.552263-0.705574-3.316199-1.199476-5.150692-1.834494-0.917247-0.28223-1.834493-0.635017-2.75174-0.987804-0.493902-0.141115-0.987804-0.352787-1.411149-0.493902l-1.481706-0.423344c-2.046166-0.564459-4.092331-1.199476-6.279611-1.763936-2.18728-0.564459-4.515676-0.987804-6.844071-1.552263-4.727348-0.917247-9.736926-1.763936-14.958175-2.257838-5.22125-0.564459-10.654172-0.846689-16.087095-0.846689h-1.058361l-1.058362 0.070557-2.046165 0.070557c-1.411149 0.070557-2.75174 0.070557-4.162889 0.141115-1.411149 0.141115-2.75174 0.211672-4.162888 0.352787-1.411149 0.141115-2.75174 0.211672-4.162889 0.423345-2.75174 0.352787-5.574037 0.635017-8.325776 1.128919-1.340591 0.211672-2.75174 0.423345-4.092332 0.635017-1.340591 0.28223-2.681182 0.564459-4.092331 0.846689-2.681182 0.493902-5.362365 1.199476-7.972989 1.834493-1.340591 0.352787-2.610625 0.705574-3.880659 1.058362-1.270034 0.352787-2.540068 0.705574-3.810101 1.128919-2.540068 0.776132-4.93902 1.552263-7.337973 2.398952-1.199476 0.423345-2.398953 0.776132-3.527872 1.199477-1.128919 0.423345-2.328395 0.846689-3.457314 1.270033-1.128919 0.423345-2.257838 0.846689-3.316199 1.340592-1.058361 0.423345-2.18728 0.846689-3.175084 1.340591-2.046166 0.917247-4.092331 1.763936-5.997382 2.681182-0.917247 0.423345-1.905051 0.917247-2.822297 1.340591-0.917247 0.423345-1.763936 0.917247-2.681183 1.340591-1.763936 0.846689-3.316199 1.693378-4.868463 2.469511-3.03397 1.622821-5.644595 3.104527-7.761317 4.37456-2.116723 1.270034-3.739544 2.328395-4.797905 3.03397-0.564459 0.352787-0.987804 0.635017-1.270034 0.846689-0.28223 0.211672-0.423345 0.28223-0.423345 0.28223l-1.270033-1.763936z" fill="#FFFFFF"></path></g></svg>
        </div>
        <div class="detail-item">
            <div class="detail-nome"><?= Html::encode($model->nome) ?></div>
                <hr class="card-divider">
            <div class="card-price"><?= $model->preco ?><span>€</span></div>
                <hr class="card-divider">
            <div class="ratings" > <!--puramente visual-->
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
                <hr class="card-divider">
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['/item-fatura/create']), // URL para item-fatura/create
            'method' => 'post',
            'options' => ['class' => 'd-flex align-items-center'], // Adiciona uma classe flexível
        ]); ?>
        <!-- Preço da cerveja -->
        <?= Html::hiddenInput('preco', $model->preco) ?>
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
                <div class="card-side-by-side">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 512 512"><path d="m397.78 316h-205.13a15 15 0 0 1 -14.65-11.67l-34.54-150.48a15 15 0 0 1 14.62-18.36h274.27a15 15 0 0 1 14.65 18.36l-34.6 150.48a15 15 0 0 1 -14.62 11.67zm-193.19-30h181.25l27.67-120.48h-236.6z"></path><path d="m222 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path><path d="m368.42 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path><path d="m158.08 165.49a15 15 0 0 1 -14.23-10.26l-25.71-77.23h-47.44a15 15 0 1 1 0-30h58.3a15 15 0 0 1 14.23 10.26l29.13 87.49a15 15 0 0 1 -14.23 19.74z"></path></svg>
                Add to Cart
                </div>
            </button>




    <?php ActiveForm::end(); ?>

        </div>
        <div class="detail-item-notop">
            <div class="detail-content"><?= Html::encode($model->descricao) ?></div>
        </div>
        <div class="detail-item-notop">
            <div class="detail-content"><?= Html::encode($model->teor_alcoolico) ?>% Álcool</div>
                <hr class="card-divider">
            <button class="card-btn-nobrd" onclick="addToHistoricoBebi(<?= Yii::$app->user->id ?>, <?= $model->id ?>)">>
                <svg viewBox="0 -73.35 392.137 392.137" width="40px" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.a{fill:#ffffff;}.b{fill:#f5e2ad;}.c{fill:#211715;}</style></defs><path class="a" d="M165.649,84.483c-.935-4.452-3.93-9.067-10.8-11.1-6.384-1.892-13.406.247-18.927,4.007-2.745,1.87-7.034,4.6-10.694,7.008-6.832,4.488-15.059,4.9-23.25,6.506-4.456.874-9.1,2.488-11.811,5.871-2.791,3.484-2.361,9.215,1.985,10.79a14.277,14.277,0,0,1,2.109-.534c10.3-1.818,25.056-3.388,33.42-4.27,8.946-.944,19.344-1.56,30.678-1.91.462-.015.911-.015,1.345,0a20.209,20.209,0,0,0,5.345-7.819A15.183,15.183,0,0,0,165.649,84.483Z"></path><path class="a" d="M231.976,86.654c-.256,3.628.978,7.86,5.136,12.21a14.139,14.139,0,0,1,5.668-.943c11.053.129,21.2.534,29.934,1.286,8.169.7,22.579,1.956,32.651,3.534a13.5,13.5,0,0,1,3.3.937c3.276-4.278,2.055-9.944-2.239-13.648-4.041-3.477-9.568-4.686-14.887-5.008s-10.7.115-15.969-.611c-7.437-1.024-15.578-6.379-22.658-8.843-4.606-1.612-10.512-2.119-15.156.815A13.982,13.982,0,0,0,231.976,86.654Z"></path><path class="a" d="M180.676,223.664a55.4,55.4,0,0,0-.1-6.34c-.613-12.027-9.137-94.223-10.8-107.244-.715-6.632-4.75-9.436-11.414-9.23-11.334.35-21.732.966-30.678,1.91-8.364.882-23.12,2.452-33.42,4.27-5.095.9-9.357,4.168-8.165,10.606.845,10.517,9.3,96.205,11.062,108.217.629,4.291,1.51,8.168,3.4,11.131,1.327,2.077,4.241,5.076,10.482,5.631,8.11.72,17.6.511,30.119-.809,13.208-1.393,23.945-3.185,30.295-5.76a14.658,14.658,0,0,0,8.271-7.744A16,16,0,0,0,180.676,223.664Z"></path><path class="b" d="M169.023,220.475c-11.6,4.3-48.854,8.447-59.318,6.824L99.087,135.21c5.666-5.718,15.117-5.8,22.883-3.686s15.566,5.538,23.537,4.418a21.483,21.483,0,0,0,13.791-7.97Z"></path><path class="c" d="M183.076,223.664a98.207,98.207,0,0,0-.682-14.033c-.472-5.461-.99-10.918-1.515-16.374q-2.064-21.418-4.31-42.819c-1.225-11.79-2.451-23.58-3.8-35.357-.6-5.235-.753-11.044-5.467-14.407-3.865-2.758-8.86-2.243-13.328-2.074-5.917.225-11.831.535-17.735.988-9.816.753-19.624,1.893-29.385,3.164-2.653.346-5.3.708-7.95,1.106a54.982,54.982,0,0,0-6.779,1.2c-4.083,1.156-7.7,4.089-8.44,8.451a11.9,11.9,0,0,0-.105,3.37c-.063-.546.192,1.5.13.916-.025-.23,0-.009,0,.032.012.116.019.234.029.351q.075.876.153,1.752.231,2.59.476,5.179.732,7.8,1.5,15.594,2.049,21.051,4.2,42.092c1.219,11.943,2.432,23.888,3.8,35.815.54,4.708.928,9.583,2.266,14.138,1.177,4.008,3.233,7.626,6.865,9.847,4.089,2.5,9.069,2.6,13.72,2.762,11.049.371,22.151-.719,33.091-2.173a149.8,149.8,0,0,0,15.216-2.652c4.321-1.037,8.695-2.339,12.219-5.148,3.742-2.984,5.474-7.01,5.834-11.72a2.421,2.421,0,0,0-2.4-2.4,2.447,2.447,0,0,0-2.4,2.4,14.457,14.457,0,0,1-.71,3.589c.113-.332-.369.919-.19.521.143-.32-.2.378-.178.339a11.638,11.638,0,0,1-5.075,4.968c-3.453,1.91-7.646,2.724-11.472,3.508a213.885,213.885,0,0,1-32.582,3.853,132.239,132.239,0,0,1-14.079-.011,24.351,24.351,0,0,1-6.387-.953,9.66,9.66,0,0,1-4.019-2.513c-.227-.238-.446-.484-.65-.742.314.4-.173-.263-.247-.376a13.968,13.968,0,0,1-1.436-2.872,38.96,38.96,0,0,1-1.774-7.76c-.034-.231-.065-.462-.1-.693-.079-.548.087.681.014.1-.021-.163-.043-.325-.064-.488q-.142-1.1-.273-2.2c-1.277-10.583-2.343-21.192-3.437-31.8q-2.133-20.683-4.161-41.378c-.95-9.662-1.915-19.323-2.775-28.994-.171-1.923-.685-4.036-.174-5.893a5.443,5.443,0,0,1,2.731-3.308,16,16,0,0,1,5.419-1.529c9.391-1.562,18.871-2.591,28.336-3.6,10.686-1.138,21.4-1.8,32.14-2.156a16.22,16.22,0,0,1,5.833.515,5.968,5.968,0,0,1,3.088,2.324c1.13,1.768,1.327,3.943,1.582,6.081,1.221,10.265,2.279,20.55,3.358,30.83q2.211,21.062,4.295,42.137c.988,10.039,2.044,20.083,2.762,30.146a64.552,64.552,0,0,1,.223,8.342C178.1,226.75,182.9,226.74,183.076,223.664Z"></path><path class="c" d="M75.989,212.6a74.973,74.973,0,0,0,8.388,6.245,2.42,2.42,0,0,0,3.283-.861A2.45,2.45,0,0,0,86.8,214.7c-1.369-.865-2.7-1.8-4-2.767-.314-.232-.624-.469-.935-.7-.248-.187.384.3.14.109l-.23-.179c-.171-.134-.341-.268-.511-.4q-.956-.759-1.885-1.549a2.559,2.559,0,0,0-1.7-.7,2.4,2.4,0,0,0-1.7,4.1Z"></path><path class="c" d="M78.049,133.029a34.282,34.282,0,0,0-5.711,2.673,2.494,2.494,0,0,0-1.1,1.434,2.458,2.458,0,0,0,.242,1.85,2.424,2.424,0,0,0,1.435,1.1,2.49,2.49,0,0,0,1.849-.241,30.845,30.845,0,0,1,3.725-1.878l-.574.242q.7-.293,1.414-.554a2.582,2.582,0,0,0,1.434-1.1,2.4,2.4,0,0,0-.861-3.284,2.37,2.37,0,0,0-1.85-.241Z"></path><path class="c" d="M165.975,219.037c-6.346,2.329-13.276,3.313-19.943,4.216a207.453,207.453,0,0,1-24.059,1.943c-1.775.032-3.551.032-5.324-.034-.783-.029-1.566-.071-2.347-.135-.317-.026-.634-.055-.95-.089-.149-.016-.3-.035-.446-.051-.129-.015.472.07-.113-.018a2.477,2.477,0,0,0-2.952,1.676,2.418,2.418,0,0,0,1.676,2.952c6.7,1.014,13.681.514,20.408.017a216.341,216.341,0,0,0,24.918-3.178,66.7,66.7,0,0,0,10.408-2.671,2.464,2.464,0,0,0,1.676-2.952,2.42,2.42,0,0,0-2.952-1.676Z"></path><path class="c" d="M167.367,93.673a17.492,17.492,0,0,0-1.229-14.624c-4-7.033-12.648-9.684-20.285-8.386-9.02,1.532-15.722,8.381-23.476,12.65-7.956,4.381-17.4,3.564-25.783,6.543-4.34,1.542-8.674,4.278-10.123,8.9-1.258,4.015.127,8.851,4.1,10.732a2.466,2.466,0,0,0,3.284-.861A2.421,2.421,0,0,0,93,105.343c-2.236-1.058-2.692-3.5-1.745-5.755,1.262-3,4.838-4.582,7.742-5.474,3.89-1.2,7.991-1.638,11.989-2.337a49.827,49.827,0,0,0,11.745-3.293c3.784-1.679,7.2-4.275,10.654-6.532,3.134-2.046,6.159-4.329,9.717-5.6,6.14-2.189,13.881-1.619,18.091,3.86a14.072,14.072,0,0,1,1.606,2.973,16.334,16.334,0,0,1,.526,1.868,6.668,6.668,0,0,1,.226,1.553,16.593,16.593,0,0,1,.035,1.77q-.015.423-.051.845c-.009.1-.021.206-.03.309-.041.476.043-.23,0,.06a12.781,12.781,0,0,1-.758,2.8,2.415,2.415,0,0,0,1.677,2.952,2.459,2.459,0,0,0,2.952-1.676Z"></path><path class="c" d="M100.784,136.907c5.326-5.244,13.836-4.883,20.548-3.069,9.051,2.447,18.36,6.589,27.847,3.755A23.9,23.9,0,0,0,161,129.669a2.474,2.474,0,0,0,0-3.394,2.417,2.417,0,0,0-3.394,0,19.552,19.552,0,0,1-9.512,6.633c-4.308,1.326-8.8.915-13.124-.112-8.454-2.01-16.5-5.827-25.4-4.746a20.45,20.45,0,0,0-12.17,5.463c-2.2,2.17,1.189,5.564,3.394,3.394Z"></path><path class="c" d="M56.878,159.192c3.051-3.19,6.193-6.29,9.267-9.456s6.694-6.483,8.493-10.593a10.789,10.789,0,0,0,.585-7.975,7.74,7.74,0,0,0-5.753-5.14c-2.969-.54-5.731.773-8.13,2.406-2.562,1.744-5.059,3.591-7.585,5.388-5.065,3.6-10.164,7.166-15.194,10.82a47.149,47.149,0,0,0-6.57,5.49,35.01,35.01,0,0,0-4.963,6.91c-2.69,4.743-5.119,9.651-7.656,14.478-1.235,2.352-2.331,4.965-4.265,6.833a56.767,56.767,0,0,1-6.68,5.052c-2.373,1.687-4.778,3.334-7.278,4.826-2.65,1.582-.239,5.734,2.422,4.145a137.928,137.928,0,0,0,11.98-8.265,20.78,20.78,0,0,0,5.378-5.356c.4-.628.738-1.292,1.084-1.951l6.919-13.166c1.65-3.14,3.244-6.419,5.565-9.13,3.539-4.133,8.359-7.062,12.752-10.188l14.611-10.4c1.725-1.227,4.087-3.428,6.375-3.242,1.985.162,2.779,2.173,2.707,3.923-.1,2.44-1.7,4.636-3.232,6.418-1.344,1.565-2.775,3.056-4.206,4.541-3.314,3.437-6.72,6.784-10.02,10.234-2.135,2.232,1.254,5.631,3.394,3.394Z"></path><path class="c" d="M55.805,160.35c7.56-1.842,15.174-3.451,22.743-5.258,2.246-.536,5.969-1.209,7.207,1.165s.275,5.824-1.682,7.546c-1.61,1.416-.283,4.077,1.7,4.1,2.21.022,2.978,2.94,3.03,4.748a6.274,6.274,0,0,1-3.7,6.092c-2.081,1-1.142,4.723,1.212,4.473a3.443,3.443,0,0,1,3.684,4.035,1.361,1.361,0,0,1-.08.384,8.82,8.82,0,0,1-.247.857,5.572,5.572,0,0,0-.409.758,7.473,7.473,0,0,1-3.219,2.219,2.413,2.413,0,0,0,.638,4.714c1.669.132,2.425,2.6,2.23,4.028-.34,2.485-2.266,3.4-4.3,4.388-2.136,1.045-4.258,2.141-6.491,2.969a78.48,78.48,0,0,1-8.251,2.339,126.016,126.016,0,0,1-18.758,3.31c-6.1.58-12.469,1.033-18.214,3.341-5.7,2.29-9.992,6.556-14.42,10.668-2.269,2.106,1.132,5.495,3.394,3.394,3.953-3.67,7.842-7.795,13.017-9.711,6.376-2.36,13.29-2.522,19.973-3.27a142.62,142.62,0,0,0,20.418-4.164,48,48,0,0,0,7.908-2.872c1.293-.6,2.568-1.233,3.847-1.859a14.332,14.332,0,0,0,3.852-2.378,9.5,9.5,0,0,0,2.6-8.831,7.736,7.736,0,0,0-6.812-6.152l.638,4.714c4.111-1.681,7.245-4.458,7.5-9.132.252-4.567-3.827-9.046-8.508-8.549l1.211,4.472a10.984,10.984,0,0,0,6.048-10.814c-.375-4.4-2.887-8.923-7.8-8.971l1.7,4.1c4.569-4.02,5.3-13.615-.966-16.479-3-1.371-6.3-.963-9.414-.209q-5.276,1.278-10.577,2.451c-4,.891-8,1.791-11.981,2.762-3,.73-1.73,5.36,1.276,4.628Z"></path><path class="c" d="M66.121,173.679c6.405-2.182,13.021-3.7,19.487-5.683,2.946-.9,1.69-5.537-1.276-4.628-6.466,1.98-13.082,3.5-19.487,5.683A2.455,2.455,0,0,0,63.169,172a2.422,2.422,0,0,0,2.952,1.676Z"></path><path class="c" d="M69.3,188.259c5.86-1.769,11.83-3.21,17.643-5.132a2.454,2.454,0,0,0,1.676-2.952,2.424,2.424,0,0,0-2.952-1.676c-5.813,1.922-11.783,3.362-17.643,5.132a2.4,2.4,0,1,0,1.276,4.628Z"></path><path class="c" d="M72.616,200.586c4.818-1.554,9.7-2.909,14.518-4.451a2.4,2.4,0,0,0-1.276-4.629c-4.821,1.542-9.7,2.9-14.518,4.452a2.4,2.4,0,1,0,1.276,4.628Z"></path><path class="a" d="M223.34,218.033a54.158,54.158,0,0,1-.025-6.181c.371-11.732,7.136-92,8.515-104.72.572-6.478,4.451-9.287,10.95-9.211,11.053.129,21.2.534,29.934,1.286,8.169.7,22.579,1.956,32.651,3.534,4.983.781,9.2,3.886,8.157,10.183-.627,10.266-7.261,93.935-8.75,105.674-.531,4.194-1.317,7.989-3.107,10.912-1.255,2.049-4.038,5.027-10.111,5.685-7.89.854-17.147.828-29.368-.223-12.9-1.11-23.4-2.655-29.633-5.045a14.283,14.283,0,0,1-8.207-7.392A15.564,15.564,0,0,1,223.34,218.033Z"></path><path class="b" d="M301.027,127.723c-5.581,4.033-10.658,5.157-17.571,5.079s-13.691-1.9-20.237-4.128c-3.464-1.178-6.928-2.483-10.565-2.891a16.075,16.075,0,0,0-11.009,3.012l-7.036,86.119c11.385,3.976,48.037,6.9,58.205,5.117Z"></path><path class="c" d="M225.74,218.033a94.667,94.667,0,0,1,.385-13.444c.336-5.039.714-10.075,1.1-15.11q1.55-20.234,3.273-40.453c.976-11.607,1.962-23.214,3.04-34.812q.24-2.584.494-5.169c.21-2.107.395-4.251,1.5-5.948a5.828,5.828,0,0,1,2.977-2.2,16.9,16.9,0,0,1,5.754-.555c5.749.081,11.5.239,17.24.522,9.3.46,18.584,1.33,27.843,2.288,4.785.495,9.57,1.029,14.328,1.743,3.329.5,6.775,1.475,7.5,4.9.348,1.658-.07,3.61-.19,5.337q-.168,2.4-.348,4.8-.546,7.359-1.124,14.717-1.533,19.707-3.156,39.409c-.968,11.759-1.938,23.519-3.03,35.267-.287,3.092-.549,6.193-.945,9.274a34.472,34.472,0,0,1-1.582,7.2,13.137,13.137,0,0,1-1.292,2.651c-.084.131-.491.705-.376.556.217-.281-.236.274-.22.256-.129.143-.257.285-.391.423-2.579,2.652-6.508,3.131-10.234,3.408-10.279.761-20.635.06-30.87-.964-4.969-.5-9.934-1.1-14.841-2.034-3.68-.7-7.741-1.429-11.041-3.292a12.342,12.342,0,0,1-4.074-3.58c-.195-.285-.379-.579-.546-.881-.095-.172-.184-.346-.269-.523l-.049-.1q.188.468-.077-.217a15.372,15.372,0,0,1-.77-3.467,2.466,2.466,0,0,0-2.4-2.4,2.417,2.417,0,0,0-2.4,2.4,16.739,16.739,0,0,0,1.943,6.947,16.349,16.349,0,0,0,4.34,4.724c3.4,2.569,7.729,3.675,11.834,4.566,10.725,2.326,21.908,3.259,32.854,3.753a142.858,142.858,0,0,0,14.663-.018c4.5-.26,9.335-.493,13.17-3.138,5.959-4.11,6.951-11.678,7.669-18.365,1.074-10,1.861-20.041,2.7-30.065q1.755-20.846,3.395-41.7c.781-9.883,1.577-19.766,2.267-29.656.039-.562.085-1.123.113-1.685.006-.115.013-.23.022-.344.007-.081.015-.233-.021.13.033-.338.1-.673.13-1.011a11.7,11.7,0,0,0-.23-3.651c-.931-4.167-4.6-6.889-8.587-7.853a66.973,66.973,0,0,0-7-1.06q-3.795-.5-7.6-.907c-4.934-.542-9.876-1.01-14.82-1.449q-15.646-1.389-31.332-1.674c-4.521-.08-9.256-.308-12.971,2.718-2.874,2.341-3.739,5.821-4.11,9.343-1.01,9.589-1.783,19.208-2.609,28.814q-1.821,21.177-3.509,42.364c-.818,10.3-1.7,20.6-2.248,30.916a64.267,64.267,0,0,0-.07,8.3,2.46,2.46,0,0,0,2.4,2.4A2.419,2.419,0,0,0,225.74,218.033Z"></path><path class="c" d="M322.491,197.324a57.645,57.645,0,0,1-4.543,4.5q-1.191,1.055-2.441,2.04c-.013.01-.464.36-.179.141s-.17.129-.183.139c-.214.162-.43.323-.646.482q-.692.508-1.4,1a2.4,2.4,0,1,0,2.422,4.144,59.639,59.639,0,0,0,10.361-9.052,2.4,2.4,0,0,0-3.394-3.394Z"></path><path class="c" d="M326.013,129.444a29.435,29.435,0,0,0-4.292-1.716,2.4,2.4,0,0,0-2.711,3.525,2.579,2.579,0,0,0,1.435,1.1c.831.262,1.651.556,2.455.893l-.574-.242q.64.271,1.264.581a2.552,2.552,0,0,0,1.85.242,2.448,2.448,0,0,0,1.434-1.1,2.423,2.423,0,0,0,.242-1.849,2.387,2.387,0,0,0-1.1-1.434Z"></path><path class="c" d="M236.365,217.829c6.619,2.286,13.841,3.1,20.761,3.89a204.371,204.371,0,0,0,23.743,1.444,60.274,60.274,0,0,0,9.955-.673,2.419,2.419,0,0,0,1.676-2.952,2.454,2.454,0,0,0-2.952-1.676q-.418.071-.838.13c.558-.079-.055,0-.282.028-.689.075-1.38.131-2.071.177-1.467.1-2.937.14-4.407.158-3.674.044-7.35-.075-11.018-.274a198.718,198.718,0,0,1-23.35-2.517,64.221,64.221,0,0,1-9.941-2.363c-2.926-1.011-4.183,3.624-1.276,4.628Z"></path><path class="c" d="M237.632,95.868c-2.039-2.66-3.461-5.641-3.267-9.054a11.5,11.5,0,0,1,3.35-7.3c.159-.161.322-.319.489-.47.13-.118.7-.566.311-.281a10.875,10.875,0,0,1,3.948-1.758,17.438,17.438,0,0,1,9.291.7c6.861,2.228,12.95,6.382,19.929,8.328,7.653,2.134,15.673.475,23.423,1.765,3.612.6,7.357,1.769,10.077,4.336,2.454,2.316,3.637,5.506,2.409,8.747a2.42,2.42,0,0,0,1.677,2.952,2.452,2.452,0,0,0,2.952-1.676,11.977,11.977,0,0,0-1.383-10.7,18.872,18.872,0,0,0-9.6-7.052c-8.293-2.987-17.092-1.015-25.6-2.395-7.88-1.279-14.642-6.175-22.09-8.756-6.49-2.249-14.86-2.1-19.723,3.4a16.93,16.93,0,0,0-4.172,9.186,17.245,17.245,0,0,0,3.829,12.454,2.478,2.478,0,0,0,3.283.861,2.414,2.414,0,0,0,.861-3.283Z"></path><path class="c" d="M242.856,130.868a13.68,13.68,0,0,1,9.932-2.668c4.449.566,8.682,2.489,12.934,3.816,8.471,2.641,17.484,4.222,26.281,2.325a30.066,30.066,0,0,0,12.538-5.939,2.415,2.415,0,0,0,0-3.394,2.458,2.458,0,0,0-3.394,0c-6.224,4.987-14.7,6-22.383,5.086a69.014,69.014,0,0,1-13.116-3.137c-4.282-1.392-8.478-3.1-12.994-3.574a17.765,17.765,0,0,0-12.22,3.34,2.48,2.48,0,0,0-.861,3.284,2.416,2.416,0,0,0,3.283.861Z"></path><path class="c" d="M336.957,159.6a8.654,8.654,0,0,0,6.556-5.9,9.093,9.093,0,0,0-2.409-8.718c-2.115-2.076-5.273-2.828-8.035-3.654a41.671,41.671,0,0,0-8.855-1.666c-3.171-.235-6.293-.087-8.878,1.966a9.4,9.4,0,0,0-3.435,7.225,7.816,7.816,0,0,0,4.141,7.4,21.545,21.545,0,0,0,7.086,2.074c2.637.428,5.293.755,7.95,1.024a27.9,27.9,0,0,0,5.241.331,2.466,2.466,0,0,0,2.4-2.4,2.417,2.417,0,0,0-2.4-2.4c-2.683.249-5.625-.346-8.279-.671-1.681-.206-3.361-.443-5.026-.754a12.6,12.6,0,0,1-5.063-1.66c-1.529-1.1-1.606-3.225-.877-4.871a4.514,4.514,0,0,1,3.5-2.519,21.966,21.966,0,0,1,7.109.518,51.028,51.028,0,0,1,6.691,1.859c2.185.744,3.982,1.425,4.551,3.9a3.665,3.665,0,0,1-3.244,4.287,2.418,2.418,0,0,0-1.676,2.953A2.459,2.459,0,0,0,336.957,159.6Z"></path><path class="c" d="M336.141,160.22a4.89,4.89,0,0,1,3.635,4.078,4.832,4.832,0,0,1-1.937,4.533c-1.117.765-2.293.647-3.774.621-1.584-.027-3.166-.147-4.742-.3-3.39-.325-6.7-.8-10.06-1.446a36.29,36.29,0,0,1-3.615-.825c-.165-.05-.332-.1-.493-.159-.286-.108.105.038.131.053a4.047,4.047,0,0,1-.5-.3,6.048,6.048,0,0,1-1.52-2.021,3.75,3.75,0,0,1-.432-2.263,14.717,14.717,0,0,1,.393-1.777A6.091,6.091,0,0,1,317.284,157c2.922-.959,1.671-5.6-1.276-4.629-4.781,1.57-8.264,5.609-7.992,10.831a10.223,10.223,0,0,0,4.107,7.233,10.51,10.51,0,0,0,4.115,1.545,109.371,109.371,0,0,0,12.781,1.946c4.2.418,9.171,1.132,12.559-1.966a9.67,9.67,0,0,0-4.161-16.366c-2.966-.885-4.233,3.746-1.276,4.629Z"></path><path class="c" d="M336.411,173.694a5.563,5.563,0,0,1,1.094,6.962c-.046.079-.1.152-.154.229-.188.286.256-.3.026-.024-.132.158-.267.312-.412.46a2.779,2.779,0,0,1-.968.758,7.379,7.379,0,0,1-3.483.831,64.793,64.793,0,0,1-11.334-1.236c-2.566-.42-7.172-.663-8.274-3.572a5.246,5.246,0,0,1,.082-4,3.864,3.864,0,0,1,2.766-2.324c2.916-.97,1.666-5.608-1.276-4.628a9.131,9.131,0,0,0-4.987,3.418,9.7,9.7,0,0,0-1.717,5.865,9.15,9.15,0,0,0,2.32,6.054,12.571,12.571,0,0,0,6.358,3.206A94.049,94.049,0,0,0,331.69,187.7c3.779.144,7.443-1.1,9.7-4.239,2.866-4,1.956-9.876-1.581-13.161-2.261-2.1-5.663,1.287-3.394,3.394Z"></path><path class="c" d="M333.371,188.092c1.019.737,1,2.279.653,3.337a3.278,3.278,0,0,1-1.756,1.99c-2.928,1.621-6.586,1.429-9.789.97a38.163,38.163,0,0,1-5.29-1.123,5.492,5.492,0,0,1-3.7-2.708c-1.227-2.871,1.489-4.466,3.912-4.809a2.416,2.416,0,0,0,1.676-2.953,2.464,2.464,0,0,0-2.952-1.676c-3.606.511-6.967,2.991-7.574,6.744-.716,4.426,2.274,8.251,6.331,9.708a34.3,34.3,0,0,0,12.206,1.905c3.492-.111,7.711-1.05,10.035-3.9a8.053,8.053,0,0,0-1.328-11.627,2.417,2.417,0,0,0-3.283.861,2.452,2.452,0,0,0,.861,3.283Z"></path><path class="c" d="M347.658,166.772c-.167-.2-.333-.411-.5-.619.353.452-.163-.225-.222-.306q-.466-.641-.9-1.3a30.945,30.945,0,0,1-1.595-2.741c-.242-.469-.473-.946-.691-1.427-.042-.095-.376-.883-.152-.336-.1-.245-.2-.49-.294-.737a31.27,31.27,0,0,1-.983-3.014,2.4,2.4,0,0,0-4.629,1.276,34.1,34.1,0,0,0,6.569,12.6,2.408,2.408,0,0,0,3.394,0,2.468,2.468,0,0,0,0-3.394Z"></path><path class="c" d="M325.443,201.873c7.517,3.911,16.135,5.725,24.517,6.492a26.877,26.877,0,0,1,6.139.905,24.551,24.551,0,0,1,5.4,2.723,78.994,78.994,0,0,1,8.663,6.475,2.465,2.465,0,0,0,3.395,0,2.421,2.421,0,0,0,0-3.394c-6.163-5.19-12.994-10.786-21.348-11.337-8.246-.543-16.949-2.163-24.341-6.008-2.737-1.424-5.167,2.717-2.423,4.144Z"></path><path class="c" d="M332.931,140.727l-.228-.285c.061.077.28.372-.009-.013q-.291-.389-.575-.782-.669-.927-1.3-1.881a48.212,48.212,0,0,1-2.553-4.286,12.835,12.835,0,0,1-1.473-3.828c-.052-.293.014.076.015.112a2.062,2.062,0,0,1-.011-.386,5.713,5.713,0,0,1,.193-.937,3.146,3.146,0,0,1,1.1-1.595c1.665-1.2,3.8.266,5.188,1.222,2.031,1.4,3.976,2.934,5.954,4.405l12.4,9.223c3.667,2.727,7.645,5.391,10.363,9.138a56.52,56.52,0,0,1,4.564,8.11l5.933,11.9a20.921,20.921,0,0,0,4.1,6.136c3.423,3.252,7.758,5.443,11.914,7.583,2.742,1.412,5.173-2.729,2.423-4.145-3.778-1.945-7.827-3.878-10.943-6.832a17.587,17.587,0,0,1-3.384-5.244q-3.045-6.1-6.089-12.208a45.3,45.3,0,0,0-6.261-10.107c-3.46-3.908-8-6.839-12.161-9.935l-13.185-9.808c-3.8-2.824-8.773-6.756-13.517-3.378A8.268,8.268,0,0,0,322,129.378a12.377,12.377,0,0,0,1.5,5.265,46.332,46.332,0,0,0,6.035,9.478,2.415,2.415,0,0,0,3.394,0,2.457,2.457,0,0,0,0-3.394Z"></path><path class="c" d="M190.889,2.4c.756,8.061,1.76,16.1,2.627,24.151.179,1.663.362,3.327.518,4.992a2.466,2.466,0,0,0,2.4,2.4,2.417,2.417,0,0,0,2.4-2.4c-.77-8.226-1.781-16.433-2.673-24.647-.162-1.5-.331-3-.472-4.5a2.466,2.466,0,0,0-2.4-2.4,2.417,2.417,0,0,0-2.4,2.4Z"></path><path class="c" d="M147.066,18.3q8.724,12.084,17.677,24a2.473,2.473,0,0,0,3.283.861,2.415,2.415,0,0,0,.861-3.283q-8.93-11.934-17.677-24a2.469,2.469,0,0,0-3.283-.861,2.418,2.418,0,0,0-.861,3.284Z"></path><path class="c" d="M236.953,7.531Q230.6,21.016,224,34.38a2.462,2.462,0,0,0,.861,3.283,2.422,2.422,0,0,0,3.284-.861Q234.723,23.428,241.1,9.954a2.468,2.468,0,0,0-.861-3.284,2.419,2.419,0,0,0-3.283.861Z"></path><path class="a" d="M294.671,147.259a7.761,7.761,0,0,0-5.988,1.2,7.473,7.473,0,0,0-3.067,6.042,7.727,7.727,0,0,0,14.021,4.726,8.011,8.011,0,0,0,1.023-6.579A7.751,7.751,0,0,0,294.671,147.259Z"></path><path class="a" d="M278.707,168.123a5.6,5.6,0,0,0-4.322.87,5.39,5.39,0,0,0-2.213,4.36,5.577,5.577,0,0,0,10.119,3.411,5.784,5.784,0,0,0,.738-4.748A5.6,5.6,0,0,0,278.707,168.123Z"></path><path class="c" d="M295.309,144.944c-4.465-.831-9.234,1.046-11.14,5.362a10.6,10.6,0,0,0,1.737,11.313,10.14,10.14,0,0,0,10.625,2.725,9.958,9.958,0,0,0,6.827-9.758,10.2,10.2,0,0,0-8.049-9.642,2.4,2.4,0,0,0-1.276,4.629,8.937,8.937,0,0,1,1.006.271c.132.044.262.094.391.143-.422-.161-.086-.036,0,.011.306.169.611.323.9.517.116.076.23.156.342.239-.41-.3.117.118.158.157a7.776,7.776,0,0,1,.723.763c-.291-.349.159.248.24.382.094.154.18.312.263.472.051.1.232.538.072.126a7.57,7.57,0,0,1,.335,1.112c.034.157.07.322.09.482-.051-.407-.008.117,0,.215a8.636,8.636,0,0,1-.027,1.1c.032-.373,0,.024-.016.091-.043.2-.084.4-.136.6s-.119.391-.179.587c-.134.436.093-.107-.138.33a10.25,10.25,0,0,1-.556.942c-.23.339.364-.366-.1.133-.1.107-.2.217-.3.321s-.213.2-.315.3c-.468.47.215-.131-.1.093a10.124,10.124,0,0,1-1.007.6c-.085.046-.418.158-.013.014-.135.048-.267.1-.4.143-.344.112-.691.184-1.043.263-.1.023-.459.042-.008.008-.145.011-.29.027-.436.035a9.311,9.311,0,0,1-1.216-.012c-.123-.009-.6-.095-.141,0-.139-.028-.279-.057-.417-.092-.17-.042-.339-.092-.505-.146-.117-.039-.551-.211-.1-.018a6.778,6.778,0,0,1-.725-.371c-.146-.085-.288-.176-.427-.271-.083-.055-.165-.114-.246-.174.194.151.226.172.094.062-.176-.226-.45-.409-.648-.623-.09-.1-.175-.2-.263-.3.317.364.025.038-.046-.073-.164-.254-.327-.5-.47-.771-.063-.119-.119-.24-.18-.36-.247-.484.074.306-.066-.174-.1-.328-.207-.644-.281-.979-.029-.134-.052-.268-.078-.4.1.507.007.061,0-.079a8.243,8.243,0,0,1-.024-.956c.006-.152.017-.3.03-.454-.042.491.032-.154.055-.261.04-.186.088-.369.142-.551.023-.079.223-.669.145-.464-.117.3.177-.364.162-.333.1-.2.217-.4.339-.589.081-.127.166-.253.255-.374-.265.358.182-.187.2-.208.1-.109.211-.216.322-.318.07-.065.547-.414.22-.191.218-.148.44-.288.671-.415.059-.033.68-.325.357-.192a7.745,7.745,0,0,1,1.2-.354c.466-.108.217-.045.1-.03a6.736,6.736,0,0,1,.738-.045c.206,0,.41,0,.615.016.122.007.245.017.367.031q-.349-.047.088.027a2.4,2.4,0,0,0,1.276-4.629Z"></path><path class="c" d="M279.345,165.809a8.466,8.466,0,0,0-5.522.724,7.26,7.26,0,0,0-3.273,3.453,8.35,8.35,0,0,0,1.358,8.974,7.979,7.979,0,0,0,8.319,2.138,7.865,7.865,0,0,0,5.417-7.686,8.036,8.036,0,0,0-6.3-7.6,2.4,2.4,0,1,0-1.276,4.629,6.475,6.475,0,0,1,.726.2c.092.031.189.081.282.1-.5-.125-.321-.149-.16-.06.22.122.441.233.652.373.081.054.163.127.247.173-.488-.265-.184-.141-.021.009.034.031.532.544.521.551s-.341-.5-.1-.119c.055.087.114.171.167.259.068.111.131.225.19.34.212.415.066-.051-.015-.068.1.021.216.687.242.8a1.554,1.554,0,0,1,.064.348c.048-.549-.034-.209-.026-.022a3.632,3.632,0,0,0-.02.8c-.091-.106.094-.458.012-.112-.034.143-.06.288-.1.431s-.089.281-.129.423c-.132.466.218-.383-.032.079-.126.232-.269.451-.4.68-.167.288.394-.411.029-.04-.074.076-.141.157-.216.233s-.155.141-.227.216c-.358.368.336-.213.06-.038-.241.154-.477.294-.727.433-.186.1-.278.013.15-.058a2.466,2.466,0,0,0-.29.1c-.249.081-.5.131-.753.19-.2.047-.308-.052.172-.019a2.845,2.845,0,0,0-.315.026,6.582,6.582,0,0,1-.877-.009c-.288-.021-.323-.169.076.022a1.99,1.99,0,0,0-.3-.066c-.123-.031-.244-.067-.364-.106-.351-.115-.093-.175.085.055-.091-.118-.388-.189-.524-.268-.105-.062-.207-.127-.308-.195-.436-.3.159.185.026.023s-.324-.294-.468-.45a1.537,1.537,0,0,0-.19-.217c.216.047.284.424.071.082-.115-.185-.236-.363-.339-.556-.045-.086-.085-.174-.13-.26-.226-.431.149.469.02.034-.07-.236-.15-.465-.2-.706a1.4,1.4,0,0,0-.056-.291c.165.2.053.519.021.12a5.673,5.673,0,0,1-.017-.69,3.139,3.139,0,0,1,.021-.327q-.082.549-.017.15l.033-.161c.029-.134.063-.266.1-.4.024-.082.145-.624.071-.255-.071.353.041-.079.083-.16.076-.146.157-.288.245-.426a1.727,1.727,0,0,0,.185-.269c-.2.246-.236.3-.122.166.052-.062.107-.123.163-.182.075-.078.153-.155.232-.228s.163-.145.248-.213l-.224.179c.045-.1.388-.247.484-.3l.166-.087q.366-.173-.067.016a2.667,2.667,0,0,1,.869-.255c.457-.114-.067-.016-.107,0a1.57,1.57,0,0,1,.533-.032c.148,0,.3,0,.444.011.646.041-.344-.074.151.018a2.4,2.4,0,0,0,1.276-4.629Z"></path><path class="a" d="M151.983,188.607a6.058,6.058,0,0,1,4.687.849,5.822,5.822,0,0,1,2.481,4.665,6.025,6.025,0,0,1-10.86,3.894,6.247,6.247,0,0,1-.9-5.113A6.046,6.046,0,0,1,151.983,188.607Z"></path><path class="c" d="M152.621,190.921c.026,0,.636-.09.246-.053s.234-.006.253-.007a1.9,1.9,0,0,1,.769.02l-.254-.039c.1.014.192.032.287.052.159.033.318.071.474.116.125.037.249.09.375.123-.476-.125.032.015.159.082.151.079.3.166.442.258.17.109.473.161.026,0,.187.069.377.34.511.485.025.027.361.474.15.164s.1.17.115.191c.062.1.121.2.177.306.043.078.083.157.121.237q.114.242-.062-.168c.006,0,.238.73.245.759.023.092.129.352.094.434.008-.021-.046-.6-.017-.11.015.254.026.5.016.761,0,.04-.02.4-.027.4s.114-.614-.009,0a6.575,6.575,0,0,1-.181.692,2.27,2.27,0,0,1-.131.372c-.013,0,.265-.552.055-.14-.107.21-.214.417-.339.617a2.372,2.372,0,0,1-.217.325c.031.011.375-.437-.014,0a5.908,5.908,0,0,1-.437.444c-.036.033-.429.373-.118.113s-.094.057-.139.087c-.178.115-.368.208-.55.315-.455.267.38-.122.058-.016-.155.051-.307.11-.465.155-.134.038-.268.068-.4.1-.474.116.105,0,.118-.013a2.452,2.452,0,0,1-.863.04c-.164,0-.55.054-.681-.043l.3.04c-.083-.013-.166-.029-.249-.046q-.246-.051-.488-.12c-.134-.039-.264-.088-.4-.129-.282-.089-.026-.134.113.051-.1-.138-.51-.267-.656-.36s-.459-.175.01.035a1.487,1.487,0,0,1-.256-.22c-.084-.076-.165-.156-.244-.237-.186-.192-.338-.32-.074-.043a3.614,3.614,0,0,1-.5-.8,2.735,2.735,0,0,1-.165-.345c.177.5.045.074,0-.052-.03-.091-.281-.739-.207-.835-.045.058.027.437.013.069-.007-.191-.023-.381-.022-.573,0-.159.022-.318.023-.477q.027-.273-.026.164c.015-.095.033-.188.054-.282a2.877,2.877,0,0,1,.286-.939c-.029.04-.246.492-.032.108.082-.147.158-.295.247-.439.058-.094.123-.184.183-.277.273-.43-.3.3.033-.032.134-.132.5-.651.708-.677-.015,0-.479.33-.1.082.138-.088.271-.178.412-.26.094-.055.189-.107.286-.156s.194-.1.292-.141l-.273.117c.06-.132.81-.255.932-.284a2.421,2.421,0,0,0,1.677-2.952,2.451,2.451,0,0,0-2.953-1.676,8.4,8.4,0,0,0-1.929,15.693,8.646,8.646,0,0,0,9.426-1.353,8.741,8.741,0,0,0,2.371-8.723,8.189,8.189,0,0,0-3.506-4.638,8.683,8.683,0,0,0-6.362-.979,2.416,2.416,0,0,0-1.676,2.952A2.458,2.458,0,0,0,152.621,190.921Z"></path></g></svg>
                TCHIM-TCHIM
            </button>
        </div>

   <!-- Botao para favoritar / desfavoritar  -->
        <div class="favoritar">
            <?php if ($isFavoritada): ?>
                <?= Html::a('<i class="fa fa-heart-broken "></i>', ['favorita/create', 'id_cerveja' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data-method' => 'post', // Evita GET para alterar estado
                    'data-confirm' => 'Tem certeza de que deseja remover esta cerveja dos favoritos?',
                ]) ?>
            <?php else: ?>
                <?= Html::a('<i class="fa fa-heart"></i>', ['favorita/create', 'id_cerveja' => $model->id], [
                    'class' => 'btn btn-success',
                    'data-method' => 'post', // Evita GET para alterar estado
                ]) ?>
            <?php endif; ?>
        </div>
    </div>




</div>

<script>
function addToHistoricoBebi(utilizadorId, cervejaId) {
    $.ajax({
        url: '<?= \yii\helpers\Url::to(['historico-bebi/create']) ?>', // URL da ação no controlador
        type: 'POST',
        data: {
            utilizador_id: utilizadorId,
            cerveja_id: cervejaId,
        },
        success: function (response) {
            if (response.success) {
                alert('Item adicionado ao histórico com sucesso!');
            } else {
                alert('Erro ao adicionar ao histórico.');
            }
        },
        error: function () {
            alert('Erro na requisição.');
        }
    });
}
</script>
