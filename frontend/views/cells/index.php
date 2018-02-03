<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CellsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cells-index col-md-12 col-lg-12 col-sm-8 col-xs-8">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Зареєструвати', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' =>
        [
            'fullAddress',
            'phone',
            [
                'attribute'=>'type_exit_id',
                'value'=>'typeExit.name'
            ],
            [
            'attribute'=> 'type_abon_id',
            'value'=>'typeAbon.name'
            ],
            [
            'attribute'=> 'services_id',
            'value'=>'services.name'
            ],
            'remark:ntext',
            [
                'attribute' => 'checked',
                'label' => '<abbr title="Виконано">±</abbr>',
                'encodeLabel' => false,
                'format' => 'raw',
                'headerOptions' => ['style'=>'text-align:center'],
                'value' => function ($model, $key, $index, $column)
                {
                    $value = $model->{$column->attribute};
                    switch ($value)
                    {
                        case 0:
                        {
                            $class = 'warning';
                            $body = 'Не виконано';
                            break;
                        }
                        case 1:
                        {
                            $class = 'success';
                            $body = 'Виконано';
                            break;
                        }
                    };
                    $html = Html::tag('span', Html::encode($body), ['class' => 'label label-' . $class]);
                    return $value === null ? $column->grid->emptyCell : $html;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Дії',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}',
                //'checked' => function ($url, $model, $key) {
                  //  return $model->status === 'editable' ? Html::a('checked', $url) : '';


            ],
        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
