<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Street */

$this->title = 'Редагувати вулицю: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вулиці', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="street-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arrCity'=>$arrCity
    ]) ?>

</div>
