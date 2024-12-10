<aside class="main-sidebar sidebar-dark-orange ">
    <!-- Brand Logo -->
    <a href="../web/index.php" class="brand-link">
        <img src="../web/img/logonobg.png"  class="brand-image img-circle elevation-3" style="opacity: 1">
        <span class="brand-text font-weight-light">Cervejaria Lupsy</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="../web/index.php" class="d-block">
                    <?= Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username ?>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Produtos', 'header' => true],
                    [
                        'label' => 'Cervejas',
                        'icon' => 'beer',
                        'items' => [
                            ['label' => 'Criar', 'icon' => 'plus', 'url' => ['/cerveja/create']],
                            ['label' => 'Lista', 'icon' => 'list', 'url' => ['/cerveja/index']],
                        ]
                    ],
                    ['label' => 'Utilizadores', 'header' => true],
                    [
                        'label' => 'Utilizadores',
                        'icon' => 'user',
                        'items' => [
                            ['label' => 'Criar', 'icon' => 'plus', 'url' => ['/utilizador/create']],
                            ['label' => 'Lista', 'icon' => 'list', 'url' => ['/utilizador/index']],
                        ]
                    ],
                    ['label' => 'Categorias', 'header' => true],
                    [
                        'label' => 'Categorias',
                        'icon' => 'box',
                        'items' => [
                            ['label' => 'Criar', 'icon' => 'plus', 'url' => ['/categoria/create']],
                            ['label' => 'Lista', 'icon' => 'list', 'url' => ['/categoria/index']],
                        ]
                    ],

                    ['label' => 'Fornecedores', 'header' => true],
                    [
                        'label' => 'Fornecedores',
                        'icon' => 'truck',
                        'items' => [
                            ['label' => 'Criar', 'icon' => 'plus', 'url' => ['/fornecedor/create']],
                            ['label' => 'Lista', 'icon' => 'list', 'url' => ['/fornecedor/index']],
                        ]
                    ],

                    ['label' => 'Carrinho', 'header' => true],
                    [
                        'label' => 'Carrinho',
                        'icon' => 'shopping-cart',
                        'items' => [
                            ['label' => 'Lista', 'icon' => 'list', 'url' => ['/fatura/index']],
                        ]
                    ],
                    ['label' => 'Notas', 'header' => true],
                    [
                        'label' => 'Notas',
                        'icon' => 'medal',
                        'items' => [
                            ['label' => 'Lista', 'icon' => 'list', 'url' => ['/nota/index']],
                        ]
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>