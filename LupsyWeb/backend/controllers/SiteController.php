<?php

namespace backend\controllers;

use backend\models\Fornecedor;
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
use yii\web\NotFoundHttpException as WebNotFoundHttpException;

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
        $fornecedoresCount = Fornecedor::find()->count(); //Conta o nº de fornecedores

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

        //$logFilePath = Yii::getAlias('@backend') . '/access.log';
        $logFilePath = '/var/log/nginx/access.log';

        if (!file_exists($logFilePath)) {
            throw new WebNotFoundHttpException("Arquivo de log não encontrado.");
        }

        // Contar os erros 400 e 500
        $logData = $this->parseLogFile($logFilePath);

        return $this->render('index', [
            'userCount' => $userCount,
            'cervejasCount' => $cervejasCount,
            'fornecedoresCount' => $fornecedoresCount,
            'topCervejas' => $topCervejas,
            'topRatedCervejas' => $topRatedCervejas,
            'dataProvider' => $dataProvider,
            'webError4xxCount' => $logData['webError4xxCount'],
            'webError5xxCount' => $logData['webError5xxCount'],
            'mobileError4xxCount' => $logData['mobileError4xxCount'],
            'mobileError5xxCount' => $logData['mobileError5xxCount'],
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
            if (!Yii::$app->user->can('admin') && !Yii::$app->user->can('funcionario')) {
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
    private function parseLogFile($logFilePath)
    {
        $logData = [
            'webError4xxCount' => 0,
            'webError5xxCount' => 0,
            'mobileError4xxCount' => 0,
            'mobileError5xxCount' => 0,
        ];
    
        // Lista de User-Agents de bots
        $botUserAgents = [
            'bot','Palo Alto Networks', 'crawler', 'spider', 'scanner', 'googlebot', 'yandex', 'bingbot', 'curl', 'zgrab', 'censys','PRI','CensysInspect'
        ];
    
        // Abrir o arquivo de log
        $logFile = fopen($logFilePath, "r");
        if ($logFile) {
            while (($line = fgets($logFile)) !== false) {
                // Verifica se a linha contém erro 4xx ou 5xx
                if (preg_match('/\s4[0-9]{2}\s/', $line) || preg_match('/\s5[0-9]{2}\s/', $line)) {
                    // Verifica se a linha contém algum User-Agent de bot
                    $isBot = false;
                    foreach ($botUserAgents as $bot) {
                        if (stripos($line, $bot) !== false) {
                            $isBot = true;
                            break;
                        }
                    }
    
                    // Se for de bot, ignora a linha
                    if ($isBot) {
                        continue;
                    }
    
                    // Separar por web e mobile (com base na rota '/api/')
                    if (strpos($line, '/api/') !== false) {
                        // Contagem de erros 4xx e 5xx para mobile
                        if (preg_match('/\s4[0-9]{2}\s/', $line)) {
                            $logData['mobileError4xxCount']++;
                        } elseif (preg_match('/\s5[0-9]{2}\s/', $line)) {
                            $logData['mobileError5xxCount']++;
                        }
                    } else {
                        // Contagem de erros 4xx e 5xx para web
                        if (preg_match('/\s4[0-9]{2}\s/', $line)) {
                            $logData['webError4xxCount']++;
                        } elseif (preg_match('/\s5[0-9]{2}\s/', $line)) {
                            $logData['webError5xxCount']++;
                        }
                    }
                }
            }
            fclose($logFile);
        }
    
        return $logData;
    }
    
}
