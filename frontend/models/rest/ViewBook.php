<?php

namespace frontend\models\rest;

class ViewBook extends Book
{
    public function fields()
    {
        $fields = parent::fields();
        return [
            'id' => $fields['id'],
            'name' => $fields['name'],
            'year' => $fields['year'],
            'desc' => $fields['desc'],
            'created_at' => $fields['created_at'],
            'updated_at' => $fields['updated_at'],
            'author' => function ($model) {
                $author = [];
                foreach ($model->author as $a) {
                    $author['name'] = $a->name;
                    $author['surname'] = $a->surname;
                    $author['birthday'] = $a->birthday;
                    $author['bio'] = $a->bio;
                }
                return $author;
            },
        ];
    }
}