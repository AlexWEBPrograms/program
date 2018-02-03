<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cells */

$this->title = 'Реєстрація';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cells-create">
    <?= $this->render('_form', [
        'model' => $model,
        'arrRegion'=>$arrRegion,
        'arrCity'=>$arrCity,
        'arrStreet'=>$arrStreet,
        'arrAbon'=>$arrAbon,
        'arrExit'=>$arrExit,
        'arrService'=>$arrService,
        'onOff'=>$onOff
    ]) ?>
</div>