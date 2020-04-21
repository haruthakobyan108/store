<?php


namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\imagine\Image;
use app\models\Product;

class GenerateImageThumbnailController extends Controller
{
    public $sizes;
    public $products;
    public $watermarked = false;
    public $catalogOnly = true;

    public function options($actionID): array
    {
        return [
          'sizes','watermarked', 'catalogOnly'
        ];
    }

    /**
     * @return array
     */
    public function optionAliases(): array
    {
        return [
            's' => 'sizes',
            'w' => 'watermarked',
            'c' => 'catalogOnly'
        ];
    }

    /**
     * This command echoes what you have entered as the message.
     * @return string Exit code
     */
    public function actionIndex(): ?string
    {
        $sizesArray = (explode(',', $this->sizes));

        $product = new Product;

        $this->products = $product->getActiveProducts($this->catalogOnly);

        foreach ($sizesArray as $size) {
            $this->saveImages($size, $this->products);
        }

        return  'ok';

    }

    private function saveImages(string $sizeString,array $products): void
    {
        $size = explode('x', $sizeString);

        foreach ($products as $value){
            $imageName = $value->image.'_'.$sizeString.'_thumb-test-image.jpg';
            Image::thumbnail('@webroot/images/'.$value->image, $size[0], !isset($size[1])?:$size[0])->save(Yii::getAlias('@webroot/images/thumbnails/'.$imageName));
            if ($this->watermarked) {
                Image::watermark('@webroot/images/thumbnails/'.$imageName,'@webroot/images/watermark.png')->save(Yii::getAlias('@webroot/images/thumbnails/'.$imageName));
            }
        }
    }
}
