<?php

use yii\db\Migration;

/**
 * Class m200420_172625_create_table_product
 */
class m200420_172625_create_table_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'is_deleted' => $this->boolean()->defaultValue(false),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
    }

}
