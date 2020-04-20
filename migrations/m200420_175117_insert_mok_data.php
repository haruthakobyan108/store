<?php

use yii\db\Migration;

/**
 * Class m200420_175117_insert_mok_data
 */
class m200420_175117_insert_mok_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('product', [ 'image' ,'is_deleted'],
            [
                ['1.png', 0],
                ['2.png', 0],
                ['3.png', 0],
                ['4.png', 0],
                ['5.png', 0],
                ['6.png', 0],
                ['7.png', 1],
                ['8.png', 1]
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('delete from product where 1=1');
//        $this->truncateTable('store_product');
    }

}
