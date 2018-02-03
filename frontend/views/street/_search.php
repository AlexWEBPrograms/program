<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StreetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="street-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'city_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Шукати', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Обновити', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
