<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = 'Редагувати область: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Області', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
