<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Url $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php
$form = ActiveForm::begin(['options' => ['class' => 'p-4 p-md-5 border rounded-3 bg-body-tertiary']]); ?>

    <div class="form-floating mb-3">
        <?= $form->field($model, 'url')
            ->textInput(['maxlength' => true, 'placeholder' => 'https://google.com/'])
            ->label(false)
        ?>
    </div>
    <hr class="my-4">
    <div class="form-floating mb-3">
        <?= Html::submitButton('Go', ['class' => 'form-control btn btn-success']) ?>
    </div>

<?php
ActiveForm::end();
