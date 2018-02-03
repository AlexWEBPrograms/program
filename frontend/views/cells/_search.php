<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CellsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cells-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pib') ?>

    <?= $form->field($model, 'region_id') ?>

    <?= $form->field($model, 'city_id') ?>

    <?= $form->field($model, 'street_id') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'type_exit_id') ?>

    <?php // echo $form->field($model, 'type_abon_id') ?>

    <?php // echo $form->field($model, 'date_exit') ?>

    <?php // echo $form->field($model, 'date_reg') ?>

    <?php // echo $form->field($model, 'services_id') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'checked') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
