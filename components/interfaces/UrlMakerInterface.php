<?php

namespace app\components\interfaces;

use app\models\Url;

/**
 * Interface to create Absolute Url by any engine
 */
interface UrlMakerInterface
{
    public function __construct(Url $model);

    public function getAbsoluteUrl();
}
