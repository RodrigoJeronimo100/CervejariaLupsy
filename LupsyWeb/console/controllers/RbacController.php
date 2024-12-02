<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();


        $utilizador = $auth->createRole('utilizador');
        $auth->add($utilizador);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $admin = $auth->createRole('funcionario');
        $auth->add($admin);

        $auth->assign($utilizador, 3);
        $auth->assign($utilizador, 2);
        $auth->assign($admin, 1);
    }
}
