<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeAbon */

$this->title = 'Тип абонента';
$this->params['breadcrumbs'][] = ['label' => 'Тип абонента', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-abon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
