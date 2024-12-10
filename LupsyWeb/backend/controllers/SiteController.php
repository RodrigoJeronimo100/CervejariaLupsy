<?php

namespace backend\controllers;

use common\models\Favorita;
use common\models\Cerveja;
use common\models\HistoricoBebi;
use common\models\LoginForm;
use common\models\Nota;
use common\models\User;
use common\models\Utilizador;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ForbiddenHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'roles' => ['?'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin', 'funcionario'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userCount = Utilizador::find()->count(); //Conta o nº de utilizadores
        $cervejasCount = Cerveja::find()->where(['estado' => '1'])->count(); //Conta o nº de cervejas

        $topCervejas = HistoricoBebi::find()
            ->select(['cerveja_nome' => 'cerveja.nome', 'total_consumed' => 'COUNT(*)'])
            ->joinWith('cerveja')
            ->groupBy('id_cerveja')
            ->orderBy(['total_consumed' => SORT_DESC])
            ->limit(5)
            ->asArray()
            ->all();


        $topRatedCervejas = Nota::find()
            ->select(['id_cerveja', 'AVG(nota) as average_rating'])
            ->groupBy('id_cerveja')
            ->orderBy(['average_rating' => SORT_DESC])
            ->limit(5)
            ->asArray()
            ->all();

        foreach ($topRatedCervejas as &$item) {
            $cerveja = Cerveja::findOne($item['id_cerveja']);
            $item['cerveja_nome'] = $cerveja ? $cerveja->nome : 'Desconhecido';
        }

        $query = Favorita::find()
            ->select(['favorita.id_cerveja', 'COUNT(favorita.id_cerveja) AS quantidade', 'cerveja.nome'])
            ->joinWith('cerveja')
            ->groupBy('favorita.id_cerveja')
            ->orderBy(['quantidade' => SORT_DESC])
            ->limit(5);

        // Criação do DataProvider com a consulta
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);


        return $this->render('index', [
            'userCount' => $userCount,
            'cervejasCount' => $cervejasCount,
            'topCervejas' => $topCervejas,
            'topRatedCervejas' => $topRatedCervejas,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (!Yii::$app->user->can('admin')) {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
                return $this->redirect(['site/login']);
            }
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
