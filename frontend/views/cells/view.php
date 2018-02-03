<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cells */

$this->title = $model->city->name;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cells-view">
    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви точно бажаєте видалити?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'pib',
            'fullAddress',
            'phone',
            'typeExit.name',
            'typeAbon.name',
            'date_exit',
            'date_reg',
            'services.name',
            'remark:ntext',
            'user.username',
            'TextCheched'
        ],
    ]) ?>
</div>
