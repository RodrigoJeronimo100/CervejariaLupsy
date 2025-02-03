<?php

/** @var yii\web\View $this */
/** @var int $userCount */
/** @var int $cervejasCount */
/** @var int $fornecedoresCount */
/** @var int $error400Count */
/** @var int $error500Count */

use yii\grid\GridView;

$this->title = 'BackOffice';
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<?php $this->registerCssFile("@web/css/index_back.css"); ?>
<div class="site-index">

    <div class="row">
        <!-- Estatísticas existentes -->
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

        <!-- Requests-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dashboard Requests das Ultimas 24h</h3>
                    </div>
                    <div class="row">
                    <div class="card-body">
                        <div class="row">
                            <!-- Total -->
                            <div class="col-md-6">
                                <div class="info-box bg-info">
                                    <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total de Requests</span>
                                        <span class="info-box-number"><?= $total ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Requests sucesso</span>
                                        <span class="info-box-number"><?= $Requests200Count ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Erros na Web -->
                        <div class="row">
                            <!-- Erros 4xx na Web -->
                            <div class="col-md-6">
                                <div class="info-box bg-warning">
                                    <span class="info-box-icon"><i class="fas fa-desktop"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Erros 4xx (Web)</span>
                                        <span class="info-box-number"><?= $webError4xxCount ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Erros 5xx na Web -->
                            <div class="col-md-6">
                                <div class="info-box bg-danger">
                                    <span class="info-box-icon"><i class="fas fa-desktop"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Erros 5xx (Web)</span>
                                        <span class="info-box-number"><?= $webError5xxCount ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Erros na API Mobile -->
                        <div class="row">
                            <!-- Erros 4xx na Mobile -->
                            <div class="col-md-6">
                                <div class="info-box bg-warning">
                                    <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Erros 4xx (Mobile)</span>
                                        <span class="info-box-number"><?= $mobileError4xxCount ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Erros 5xx na Mobile -->
                            <div class="col-md-6">
                                <div class="info-box bg-danger">
                                    <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Erros 5xx (Mobile)</span>
                                        <span class="info-box-number"><?= $mobileError5xxCount ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="body-content">
        <div class="row" style="margin-left: 7.5px!important;">
            <!-- Aqui você pode adicionar as outras seções como o ranking de cervejas -->
        </div>
    </div>

</div>
