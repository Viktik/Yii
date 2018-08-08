<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 06.08.2018
 * Time: 15:54
 */

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($filename)
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $filename . '.jpg'/* . $this->imageFile->extension*/);
            return true;
        } else {
            return false;
        }
    }
}