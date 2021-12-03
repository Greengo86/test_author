<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use frontend\models\rest\Book;

class Author extends \yii\mongodb\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y.m.d H:i:s'),
            ],
        ];
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    public function attributes()
    {
        return ['_id', 'id', 'name', 'surname', 'birthday', 'bio', 'created_at', 'updated_at'];
    }

    public function rules()
    {
        return [
            [['name', 'surname', 'birthday'], 'required'],
            [['id', 'bio', 'created_at', 'updated_at'], 'string'],
            [['id'], 'unique', 'on' => 'create']
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['bio', 'name', 'surname', 'birthday'];
        return $scenarios;
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['author_id' => 'id']);
    }

    public static function tableName()
    {
        return 'author';
    }

    public function attributeLabels()
    {
        return [
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'First Name',
            'surname' => 'Surname Name',
            'birthday' => 'Birthday',
            'bio' => 'Bio',
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();
        //Не забудем удалить и книги этого автора
        Book::deleteAll(['author_id' => $this->id]);
    }
}
