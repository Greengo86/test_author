<?php
namespace frontend\models\rest;


class AuthorStatistic extends Author
{

    public function fields()
    {
        $fields = parent::fields();
        $result = [
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'books_count' => function ($model) {
                return count($model->books);
            },
        ];
        return $result;
    }
}