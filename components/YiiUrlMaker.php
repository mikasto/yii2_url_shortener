<?php

namespace app\components;

use app\components\interfaces\UrlMakerInterface;
use app\models\Url;
use Yii;

/**
 * Yii url manager based implementation of Absolute URL generation
 */
final class YiiUrlMaker implements UrlMakerInterface
{
    private Url $model;

    /**
     * @param Url $model
     */
    public function __construct(Url $model)
    {
        $this->model = $model;
    }

    /**
     * Absolute Url creating
     * @return string
     */
    public function getAbsoluteUrl()
    {
        return Yii::$app->urlManager->createAbsoluteUrl(['url/redirect', 'short' => $this->model->short]);
    }
}
