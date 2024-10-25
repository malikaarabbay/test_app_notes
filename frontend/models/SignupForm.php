<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $birthday;
    public $photo;
    public $sex;
    public $vk_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'on' => 'default'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'on' => 'default'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            [['vk_id'], 'safe'],
            [['firstname', 'lastname'], 'string'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User $user user model
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
        return $user;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
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

    public function scenarios()
    {
        return [
            'social' => ['username', 'firstname', 'lastname', 'email', 'sex', 'photo', 'birthday', 'vk_id', 'password'],
            'default' => ['username', 'email', 'password'],
        ];
    }

    public function signupSocial()
    {
        if ($this->validate()) {
            $user = new User();
            $user->scenario = 'social';
            $user->username = $this->firstname;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->email = $this->email;
            $user->birthday = $this->birthday;
            $user->sex = $this->sex;
            $user->vk_id = $this->vk_id;
            $user->setPassword(Yii::$app->security->generateRandomString(8));
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->save();
            return $user;
        }
        return null;
    }
}
