<?php

use yii\db\Migration;

/**
 * Class m200420_173202_create_table_store_product
 */
class m200420_173202_create_table_store_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('store_product', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'product_image' => $this->string(),
        ]);


        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_id',
            'store_product',
            'product_id'
        );

        // add foreign key for table `store_product`
        $this->addForeignKey(
            'fk-product_id',
            'store_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('store_product');
    }

}
