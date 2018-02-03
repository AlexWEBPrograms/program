<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Сатистика робіт:</p>
    <?php
    echo Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Дзвінки'],
            'plotOptions' => [
                'pie' => [
                    'cursor' => 'pointer',
                ],
            ],
            'series' => [[
                'type'=>'pie',
                'name'=>'Дзвінки',
                'data' => [
                    [
                        'name' => 'Виконано',
                        'y' => $data1,
                    ],
                    [
                        'name' => 'Не виконано',
                        'y' => $data2,
                    ],
                ],
            ],
        ],
    ]]);
    ?>

    <p>Типи виїздів:</p>
    <?php
    echo Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Дзвінки'],
            'plotOptions' => [
                'pie' => [
                    'cursor' => 'pointer',
                ],
            ],
            'series' => [[
                'type'=>'pie',
                'name'=>'Дзвінки',
                'data' => [
                    [
                        'name' => 'Виконано',
                        'y' => $data1,
                    ],
                    [
                        'name' => 'Не виконано',
                        'y' => $data2,
                    ],
                ],
            ],
            ],
        ]]);
    ?>
    <code><?= __FILE__ ?></code>
</div>
