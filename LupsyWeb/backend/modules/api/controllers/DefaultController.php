<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
            'class' => \yii\filters\AccessControl::class,
            'only' => ['index', 'view'], // Aplica-se às ações especificadas
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'], // Apenas usuários autenticados têm acesso
                ],
            ],
        ],
    ];
    }

    public function actionIndex()
    {
        return [
            'status' => 'success',
            'message' => 'Bem-vindo à API do backend!',
        ];
    }

    public function actionView($id)
    {
        return [
            'status' => 'success',
            'data' => [
                'id' => $id,
                'name' => 'Exemplo',
                'description' => 'Este é um exemplo de resposta JSON para um ID.',
            ],
        ];
    }
}
