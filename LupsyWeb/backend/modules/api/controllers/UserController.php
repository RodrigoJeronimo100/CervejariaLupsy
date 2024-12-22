<?php

namespace backend\modules\api\controllers;

use common\models\User;
use Yii;
use yii\rest\ActiveController;
use yii\web\UnauthorizedHttpException;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actionLogin()
    {
        $params = Yii::$app->request->bodyParams;
        $user = User::findByUsername($params['username']);

        if ($user && $user->validatePassword($params['password'])) {
            return ['token' => $user->generateAuthToken()];
        } else {
            throw new UnauthorizedHttpException('Usuário ou senha inválidos.');
        }
    }
}