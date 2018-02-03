<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = 'Додати обладнення';
$this->params['breadcrumbs'][] = ['label' => 'Обладнення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
