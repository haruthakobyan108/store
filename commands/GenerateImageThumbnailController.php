<?php


namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\imagine\Image;
use app\models\Product;

class GenerateImageThumbnailController extends Controller
{


    /**
     * This command echoes what you have entered as the message.
     * @param string $sizes
     * @param bool $watermarked
     * @param bool $catalogOnly
     * @return void Exit code
     */
    public function actionIndex(string $sizes,  $watermarked = false,  $catalogOnly = true)
    {
        $sizes = explode(',', $sizes);

        if ($watermarked){
            $this->saveImages();
        }

        $this->saveImages();

    }

    private function saveImages($with, $height)
    {

        $x = new Product;
        foreach ($x->getActiveProducts() as $value){
            $imageName = $value->image.'_thumb-test-image.jpg';
            Image::thumbnail('@webroot/images/'.$value->image, $with, $height)->save(Yii::getAlias('@webroot/images/thumbnails/'.$imageName));
            Image::watermark('@webroot/images/thumbnails/'.$imageName,'@webroot/images/watermark.png')->save(Yii::getAlias('@webroot/images/thumbnails/'.$imageName));
        }
    }
}
