<?php

namespace backend\modules\api\controllers;

use backend\modules\api\models\UserInfoApi;
use common\models\User;
use common\models\Utilizador;
use Yii;
use yii\base\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class UtilizadorController extends ActiveController
{
    public $modelClass = 'common\models\Utilizador'; 

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => ['auth'], 
        ];
        return $behaviors;
    }
    // public function actions()
    // {
    //     $actions = parent::actions();
    //     // Desabilitar o delete
    //     unset($actions['delete']);
    //     return $actions;
    // }
    
    public function actionAuth() {
        $request = Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');

        $user = User::findByUsername($username);

        if ($user && $user->validatePassword($password)) {
            $utilizador = Utilizador::findOne(['id' => $user->id]);
            // Gerar um novo token de autenticação
            $user->generateAuthKey();
            $user->save();
            if ($utilizador) {
                $auth = Yii::$app->authManager;

                return [
                    'id' => $utilizador->id,
                    'nome' => $utilizador->nome,
                    'email' => $user->email,
                    'username' => $user->username,
                    'morada' => $utilizador->morada,
                    'telefone' => $utilizador->telefone,
                    'role' => $utilizador->getRole(),
                    'nif' => $utilizador->nif,
                    'token' => $user->auth_key,
                ];
            }
        }
        throw new ForbiddenHttpException('403: No authentication!');
    }

    // public function actionLogin() {
    //     $utilizador = Utilizador::findOne([
    //         'id' => $this -> user -> id
    //     ]);
    //     $user = User::findOne([
    //         'id' => $this -> user -> id
    //     ]);

    //     return
    //     [
    //         'id' => $utilizador -> id,
    //         'nome' => $utilizador -> nome,
    //         'email' => $user -> email,
    //         'username' => $user -> username,
    //         'morada' => $utilizador -> morada,
    //         'telefone' => $utilizador -> telefone,
    //         'role' => $utilizador->getRole(),
    //         'nif' => $utilizador -> nif
    //     ];
    // }
    // public function actionGetUserInfo($id) {
    //     $utilizador = Utilizador::findOne($id);
    //     $user = User::findOne($id);
    
    //     if ($utilizador && $user) {
    //         $auth = Yii::$app->authManager;
    //         $roles = $auth->getRolesByUser($user->id);
    //         $roleNames = array_keys($roles);
    
    //         return [
    //             'id' => $utilizador->id,
    //             'nome' => $utilizador->nome,
    //             'email' => $user->email,
    //             'username' => $user->username,
    //             'morada' => $utilizador->morada,
    //             'telefone' => $utilizador->telefone,
    //             'role' => $utilizador->getRole(),
    //             'nif' => $utilizador->nif
    //         ];
    //     }
    
    //     throw new NotFoundHttpException('User not found.');
    // }
}