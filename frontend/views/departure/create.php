<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeExit */

$this->title = 'Додати тип виїзду';
$this->params['breadcrumbs'][] = ['label' => 'Тип виїзду', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-exit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
