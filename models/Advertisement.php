<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Advertisement
 *
 * @property int    $id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $phone
 * @property string $title
 * @property string $description
 *
 * @package app\models
 */
class Advertisement extends ActiveRecord
{
    public static function tableName()
    {
        return 'advertisements';
    }

    public function rules()
    {
        return [
            [
                ['firstName', 'lastName', 'email', 'phone', 'title', 'description'],
                'safe',
            ],
            [
                ['firstName', 'email', 'title', 'description'],
                'required',
            ],
            ['email', 'email'],
        ];
    }
}
