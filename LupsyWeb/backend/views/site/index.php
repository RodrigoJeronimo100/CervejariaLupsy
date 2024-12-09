<?php

/** @var yii\web\View $this */
/** @var int $userCount */
/** @var int $cervejasCount */

$this->title = 'BackOffice';
?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3><?= $userCount ?></h3>
                    <p>Usuários Registados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(['utilizador/index']) ?>" class="small-box-footer">
                    + Info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
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

        <div class="body-content">

            <div class="row">
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                </div>
            </div>

        </div>
    </div>