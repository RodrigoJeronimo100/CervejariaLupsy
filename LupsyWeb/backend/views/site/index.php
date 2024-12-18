<?php

/** @var yii\web\View $this */
/** @var int $userCount */
/** @var int $cervejasCount */
/** @var int $fornecedoresCount */

use yii\grid\GridView;

$this->title = 'BackOffice';
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<?php $this->registerCssFile("@web/css/index_back.css"); ?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3><?= $userCount ?></h3>
                    <p>Utilizadores Registados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(['utilizador/index']) ?>" class="small-box-footer">
                    + Info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $cervejasCount ?></h3>
                    <p>Cervejas Ativas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-beer"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(['cerveja/index']) ?>" class="small-box-footer">
                    +Info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="small-box bg-gray-dark">
                <div class="inner">
                    <h3><?= $fornecedoresCount ?></h3>
                    <p>fornecedores</p>
                </div>
                <div class="icon">
                    <i class="fas fa-truck"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(['fornecedor/index']) ?>" class="small-box-footer">
                    +Info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>


        <div class="body-content">

            <div class="row" style="margin-left: 7.5px!important;">
                <div class="col-lg-4">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Top 5 Cervejas Mais Consumidas <i class="fa-solid fa-trophy"></i></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; width: 50px;">#</th>
                                        <th style="text-align: center;">Nome da Cerveja</th>
                                        <th style="text-align: center;">Quantidade Bebida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($topCervejas as $index => $cerveja): ?>
                                        <tr>
                                            <td style="text-align: center; font-size: 16px; font-weight: bold;">
                                                <?php
                                                switch ($index) {
                                                    case 0:
                                                        echo '<i class="fa fa-trophy" style="color: gold; font-size: 18px;"></i>';
                                                        break;
                                                    case 1:
                                                        echo '<i class="fa fa-trophy" style="color: #939393; font-size: 18px;"></i>';
                                                        break;
                                                    case 2:
                                                        echo '<i class="fa fa-trophy" style="color: #cd7f32; font-size: 18px;"></i>';
                                                        break;
                                                    default:
                                                        echo $index + 1;
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center; font-size: 16px;">
                                                <?= $cerveja['cerveja_nome'] ?>
                                            </td>
                                            <td style="text-align: center; font-size: 16px; color: rgba(0, 0, 0, 0.6);">
                                                <?= $cerveja['total_consumed'] ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Cervejas Mais Bem Avaliadas <i class="fa-solid fa-star"></i></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome da Cerveja</th>
                                        <th>Média da Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($topRatedCervejas as $index => $cerveja): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $cerveja['cerveja_nome'] ?></td>
                                            <td><?= number_format($cerveja['average_rating'], 2) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Top 5 Cervejas mais Favoritadas <i class="fa-solid fa-heart"></i></h3>
                        </div>
                        <div class="card-body">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'summary' => false,
                                'columns' => [
                                    [
                                        'label' => 'Ranking',
                                        'value' => function ($model, $key, $index, $widget) {
                                            return $index + 1;
                                        },
                                        'headerOptions' => ['style' => 'text-align: center; font-weight: bold;'],
                                        'contentOptions' => ['style' => 'text-align: center;'],
                                    ],
                                    [
                                        'attribute' => 'cerveja.nome',
                                        'label' => 'Nome da Cerveja',
                                        'headerOptions' => ['style' => 'text-align: center; font-weight: bold;'],
                                        'contentOptions' => ['style' => 'text-align: center;'],
                                    ],
                                    [
                                        'attribute' => 'quantidade',
                                        'label' => 'Quantidade de Favoritos',
                                        'headerOptions' => ['style' => 'text-align: center; font-weight: bold;'],
                                        'contentOptions' => ['style' => 'text-align: center;'],
                                    ],
                                ],
                            ]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>