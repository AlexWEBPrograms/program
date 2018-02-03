<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cells */

$this->title = 'Редагування: ' . $model->street->name.' '.$model->number;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->street->name.' '.$model->number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="cells-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arrRegion'=>$arrRegion,
        'arrCity'=>$arrCity,
        'arrStreet'=>$arrStreet,
        'arrService'=>$arrService,
        'arrExit'=>$arrExit,
        'arrAbon'=>$arrAbon,
        'onOff'=>$onOff

    ]) ?>

</div>
