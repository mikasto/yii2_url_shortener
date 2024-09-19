<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $url */
/** @var string $short */

$this->title = 'Your url';
\yii\web\YiiAsset::register($this);
?>

<div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Your short URL was created</h1>
        <p class="col-lg-10 fs-4">Please copy it from the text area.</p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
            <div class="form-floating mb-3">
                <small class="text-body-secondary"><?= Html::a($short, $short, ['target' => '_blank']) ?></small>
            </div>
            <div class="form-floating mb-3">
                <?= Html::textInput('short', $short, ['class' => 'form-control']) ?>
            </div>
            <hr class="my-4">
            <div class="form-floating mb-3">
                <small class="text-body-secondary">
                    Redirect to: <br><b><?= $url ?></b></small>
            </div>
        </form>
    </div>
</div>
