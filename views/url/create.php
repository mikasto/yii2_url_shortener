<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Url $model */

$this->title = 'Create Short Url';
?>

<div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Enter a URL to make it short</h1>
        <p class="col-lg-10 fs-4">You will receive a short URL after submit.</p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
