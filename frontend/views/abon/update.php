<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeAbon */

$this->title = 'Редагувати абонента: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Тип абонента', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="type-abon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
