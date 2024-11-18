<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="brand-small">Cervejaria</span><br><span class="brand-large">LUPSY</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top navbar-nav custom-nav',
        ],
    ]);

    $menuItems = [
        ['label' => 'Contatos', 'url' => ['/site/contact']],
        ['label' => 'Sobre', 'url' => ['/site/about']],

    ];
    if (!Yii::$app->user->isGuest) {
        $userId = Yii::$app->user->id;
        array_push($menuItems, ['label' => 'Cerveja', 'url' => ['/cerveja/index']]);
        array_push($menuItems, ['label' => '<i class="fas fa-user-circle"></i>', 'url' => ['/utilizador/view', 'id' => $userId], 'encode' => false]);

    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);

    echo Html::beginTag('div', ['class' => 'navbar-nav d-flex']);

    if (Yii::$app->user->isGuest) {
        echo Html::a(
            'Login <i class="fas fa-right-to-bracket"></i>', ['/site/login'], ['class' => 'nav-link btn btn-link btn-success success', 'encode' => false]);
    }



    echo Html::endTag('div');


    NavBar::end();
    ?>

    <div class="collapse" id="navbarContentRight">
        <div class="bg-dark p-3">
            <!-- Add any widget or additional content here -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <?= Html::a('Profile', ['/user/profile'], ['class' => 'nav-link text-white']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('Settings', ['/user/settings'], ['class' => 'nav-link text-white']) ?>
                </li>
                <!-- Add more items as needed -->
            </ul>
        </div>
    </div>
</header>
<?php
// Verifique se a página atual é a página de login ou signup
$isLoginPage = Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'login';
$isSignupPage = Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'signup';
?>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php if (!$isLoginPage  && !$isSignupPage): ?>
    <footer style="background-color: #1E1E1E; color: #e7e7e7; text-align: center; padding: 20px; margin-top: 30px;">
        <p>&copy; 2024 Cervejaria Lupsy. Todos os direitos reservados.</p>
        <nav>
            <?= Html::a('Sobre', ['/site/about'], ['style' => 'color: #e7e7e7; margin-right: 15px;']) ?>
            <?= Html::a('Contacto', ['/site/contact'], ['style' => 'color: #e7e7e7; margin-right: 15px;']) ?>

        </nav>
    </footer>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Suranna&display=swap');
    body{
        background-color: rgba(219, 213, 190, 0.22);
        cursor: url('data:image/x-icon;base64,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'), auto;
    }

    .bg-dark{
        background-color: #1B1B1B !important;
        padding-left: 20px;
        padding-right: 20px;
    }

    .container{
        max-width: 1920px;
        --bs-gutter-x: 0rem !important;
    }
    main > .container, main > .container-fluid{
        padding: 0;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }
    .navbar-brand {
        padding: 0;
        line-height: 1;
    }

    .brand-small {
        font-family: "Inknut Antiqua", sans-serif;
        font-weight: 500;
        font-size: 20px;
    }

    .brand-large {
        font-family: "Inknut Antiqua", sans-serif;
        font-weight: 500;
        font-size: 30px;
    }

    .navbar-nav .nav-link {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 16px;
    }

    .custom-nav .nav-item {
        margin-right: 20px;
    }

    .navbar-nav .nav-item:last-child {
        margin-right: 0;
    }

    .navbar-nav .fa-user-circle {
        display: inline-block;
        font-size: 1.5em;

    }
    .success{
        margin-left: 20px;
    }
    .nav-link.btn-success:focus,
    .nav-link.btn-success:active {
        color: inherit;
        outline: none;
    }

</style>