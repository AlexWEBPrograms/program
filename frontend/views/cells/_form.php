<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Cells */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cells-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6 col-lg-6">
    <?= $form->field($model, 'pib')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'region_id')->dropDownList($arrRegion,['prompt'=>'Вибиріть.......',
            'onchange'=>'
            $.post("/cells/list?id='.'"+$(this).val(),function (data){
            $("select#cells-city_id").html(data);
            $("select#cells-city_id").prop( "disabled", false );
            });',
    'onclick'=>'
        if($(this).val()!=" ")
        $.post("/cells/list?id='.'"+$(this).val(),function (data){
            $("select#cells-city_id").html(data);});'

    ]) ?>
    <?= $form->field($model, 'city_id')->dropDownList($arrCity,[
        'prompt'=>'Вибиріть.......',
        $onOff=>$onOff,
    'onchange'=>'
            $.post("/cells/lists?id='.'"+$(this).val(),function (data){
            $("select#cells-street_id").html(data);
            $("select#cells-street_id").prop( "disabled", false );
            });',
        'onclick'=>'
        if($(this).val()!=" ")
        $.post("/cells/lists?id='.'"+$(this).val(),function (data){
            $("select#cells-street_id").html(data);});',
    ]) ?>
    <?=$form->field($model, 'street_id')->dropDownList($arrStreet,['prompt'=>'Вибиріть.......',$onOff=>$onOff,
        'onchange'=>'
            $.post("/cells/liste?id='.'"+$(this).val(),function (data){
            $("select#cells-type_exit_id").html(data);});
            $("select#cells-type_exit_id").prop( "disabled", false );',
    'onclick'=>'
        if($(this).val()!=" ")
         $.post("/cells/liste?id='.'"+$(this).val(),function (data){
            $("select#cells-type_exit_id").html(data);});',
    ])?>
    <?= $form->field($model, 'number')->textInput(['maxlength' => true])?>
    </div>
    <div class="col-md-6 col-lg-6">
    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(),['mask' => '+380 (999) 99 99 999'])?>

    <?= $form->field($model, 'type_exit_id')->dropDownList($arrExit,['prompt'=>'Вибиріть.......',
        'onchange'=>'
            $.post("/cells/lista?id='.'"+$(this).val(),function (data){
            $("select#cells-type_abon_id").html(data);});
            $("select#cells-type_abon_id").prop( "disabled", false );',
    'onclick'=>'
        if($(this).val()!=" ")
         $.post("/cells/lista?id='.'"+$(this).val(),function (data){
            $("select#cells-type_abon_id").html(data);});',
        $onOff=>$onOff
    ]) ?>
    <?= $form->field($model, 'type_abon_id')->dropDownList($arrAbon,[
        'onchange'=>'
            $.post("/cells/listse?id='.'"+$(this).val(),function (data){
            $("select#cells-services_id").html(data);});
            $("select#cells-services_id").prop( "disabled", false );',
    'onclick'=>'if($(this).val()!=" ")$.post("/cells/listse?id='.'"+$(this).val(),function (data){
            $("select#cells-services_id").html(data);});',
        $onOff=>$onOff
    ]) ?>
    <?= $form->field($model, 'date_exit')->widget(\dosamigos\formhelpers\DatePicker::classname(), ['language' => 'ru_RU',
    'clientOptions' => [
        'format' => 'd/m/y',
    ]]); ?>
    <?= $form->field($model, 'services_id')->dropDownList($arrService,['prompt'=>'Вибиріть.......',$onOff=>$onOff]) ?>
    </div>
    <div class="col-md-12">
    <?= $form->field($model, 'remark')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Зареєструвати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php $model->isNewRecord? $a=0:print (Html::submitButton('Виконано',
            [
                'data' => ['confirm' => 'Точно виконано?'],
                'name' => 'checkedCells',
                // добавить value
                'class' => 'btn btn-danger'
            ]));?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

