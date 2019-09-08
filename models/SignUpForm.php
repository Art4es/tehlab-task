<?php


namespace app\models;


use yii\base\Model;

class SignUpForm extends Model
{
    public $username;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'min' => 6, 'max' => 25],
            ['username', 'validateUsername'],
        ];
    }


    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findByUsername($this->username);
            if ($user) {
                $this->addError($attribute, 'Current username already exist!');
            }
        }
    }

    public function signIn()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password_hash = sha1($this->password);
            return $user->save(false);
        }
        return false;
    }
}