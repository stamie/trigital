<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $fullname
 * @property string $username
 * @property string $userpassword
 * @property int|null $is_use
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'username', 'userpassword'], 'required'],
            [['is_use'], 'integer'],
            [['fullname', 'username', 'userpassword'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'username' => 'Username',
            'userpassword' => 'Password',
            'is_use' => 'Status',
        ];
    }
}
