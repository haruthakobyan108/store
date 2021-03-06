<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $image
 * @property int|null $is_deleted
 *
 * @property StoreProduct[] $storeProducts
 */
class Product extends ActiveRecord
{
     const IS_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_deleted'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[StoreProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['product_id' => 'id']);
    }

    public function getActiveProducts($catalogOnly)
    {
        $query =  self::find();
        if ($catalogOnly) {
            $query->with(['storeProducts']);
        }
        return $query->where(['is_deleted' => self::IS_DELETED])->all();
    }
}
