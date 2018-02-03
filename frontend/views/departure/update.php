<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeExit */

$this->title = 'Редагувати: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Тип виїзду', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="type-exit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
