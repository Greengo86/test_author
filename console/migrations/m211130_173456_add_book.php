<?php

class m211130_173456_add_book extends \yii\mongodb\Migration
{
    const TABLE = 'book';

    public function up()
    {
        $this->createCollection(self::TABLE);
    }

    public function down()
    {
        $this->dropCollection(self::TABLE);
    }
}
