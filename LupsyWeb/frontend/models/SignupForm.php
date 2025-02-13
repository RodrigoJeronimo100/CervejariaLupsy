<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Utilizador;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nome;
    public $nif;
    public $telefone;
    public $morada;
    public $isFuncionario;
    public $isUtilizador;

    // Regras de validação
    public function rules()
    {
        return [
            // Validações para username, email e password (já existentes)
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            // Validações para os novos campos da tabela `utilizador`
            ['nome', 'trim'],
            ['nome', 'required', 'message' => 'O nome é obrigatório.'],
            ['nome', 'string', 'max' => 255],

            ['nif', 'required', 'message' => 'O NIF é obrigatório.'],
            ['nif', 'integer', 'message' => 'O NIF deve ser um número.'],
            ['nif', 'string', 'min' => 9, 'max' => 9, 'message' => 'O NIF deve ter exatamente 9 dígitos.'],

            ['telefone', 'required', 'message' => 'O telefone é obrigatório.'],
            ['telefone', 'string', 'min' => 9, 'max' => 15, 'message' => 'O telefone deve ter entre 9 e 15 caracteres.'],

            ['morada', 'trim'],
            ['morada', 'required', 'message' => 'A morada é obrigatória.'],
            ['morada', 'string', 'max' => 255],

            [['isFuncionario', 'isUtilizador'], 'boolean'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        // Criação do User
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_ACTIVE;

        // Prepara o Utilizador mas não salva ainda
        $utilizador = new Utilizador();
        $utilizador->nome = $this->nome;
        $utilizador->nif = $this->nif;
        $utilizador->telefone = $this->telefone;
        $utilizador->morada = $this->morada;

        // Inicia uma transação para garantir consistência
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            // Salva o User e verifica sucesso
            if (!$user->save()) {
                $transaction->rollBack();
                return null;
            }

            // Relaciona o ID do User ao Utilizador e tenta salvar
            $utilizador->id_user = $user->id;
            if (!$utilizador->save()) {
                $transaction->rollBack();
                return null;
            }

            // Atribui a role e confirma a transação
            $auth = \Yii::$app->authManager;

            if ($this->isUtilizador) {
                $utilizadorRole = $auth->getRole('utilizador');
                $auth->assign($utilizadorRole, $user->id);
            }

            if ($this->isFuncionario) {
                $funcionarioRole = $auth->getRole('funcionario');
                $auth->assign($funcionarioRole, $user->id);
            }

            $transaction->commit();
            return $user;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return null;
        }
    }


    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
