<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Class ImageUpload
 * @package app\models
 *
 * @property string $folder
 */
class ImageUpload extends Model
{

    /**
     * @var UploadedFile $image
     */
    public $image;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    /**
     * @param UploadedFile $file
     * @param string $currentImage
     * @return string
     * @throws \yii\base\Exception
     */
    public function uploadFile(UploadedFile $file, $currentImage = '')
    {
        $this->image = $file;

       if($this->validate())
       {
           if(trim($currentImage) != '' && $currentImage != null) {
               $this->deleteCurrentImage($currentImage);
           }
           return $this->saveImage();
       }

       return false;
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    private function getFolder()
    {
        $fullPath = Yii::getAlias('@app') . '/web/img/uploads/';
        self::checkFolder($fullPath);
        return $fullPath;
    }

    /**
     * @param $filepath
     * @throws \yii\base\Exception
     */
    private static function checkFolder($filepath)
    {
        if(!file_exists($filepath)) {
            FileHelper::createDirectory($filepath, 0777, true);
        }
    }

    /**
     * @return string
     */
    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    /**
     * @param $currentImage
     * @throws \yii\base\Exception
     */
    public function deleteCurrentImage($currentImage)
    {
        $fullFilePath = $this->getFolder() . $currentImage;

        if($this->fileExists($fullFilePath) && !empty($currentImage))
        {
            unlink($fullFilePath);
        }
    }

    /**
     * @param $fullFilePath
     * @return bool
     */
    public function fileExists($fullFilePath)
    {
        if(!empty($fullFilePath) && $fullFilePath != null)
        {
            return file_exists($fullFilePath);
        }

        return false;
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function saveImage()
    {
        $filename = $this->generateFilename();
        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}