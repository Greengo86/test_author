<?php
namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use frontend\models\rest\Author;

class Book extends \yii\mongodb\ActiveRecord
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

    public static function tableName()
    {
        return 'book';
    }

    public function attributes()
    {
        return ['_id', 'id', 'name', 'year', 'desc', 'author_id', 'created_at', 'updated_at'];
    }

    public function rules()
    {
        return [
            [['name', 'year', 'author_id'], 'required'],
            [['id', 'desc', 'created_at', 'updated_at'], 'string'],
            [['id'], 'unique', 'on' => 'create']
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['name', 'year', 'desc'];
        return $scenarios;
    }

    public function getAuthor()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'Name',
            'year' => 'Year',
            'desc' => 'Desc',
            'author_id' => 'Author',
        ];
    }

    /**
     * Здесь проверим, есть ли вообще в базе такой автор! В ТЗ такое не указано, но думаю, что это нужно сделать!
     * Если нет - не будет сохранять книгу
     * @param bool $insert
     * @return bool
     * @throws \Exception
     */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $authors = Author::find()->where(['id' => $this->author_id])->all();
        if (!$authors) {
            throw new \Exception('Author this book not exist!');
        }
        return true;
    }
}
