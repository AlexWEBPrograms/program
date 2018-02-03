<?php

/* @var $this yii\web\View */
use yii\bootstrap\Html;
$this->title = 'WestNetwork';
?>
<div class="site-index">

        <?php if (Yii::$app->user->isGuest){?>
            <div class="container col-lg-2 col-md-2 col-xs-12">
                <?=Html::a('Подати заявку','/site/contact',['class' => 'btn btn-lg btn-success' ])?>
                <p></p>
            </div>
            <div class="container col-lg-10 col-md-10 col-sm-10 col-xs-12 col-sm-12 ">
                <?=\yii\bootstrap\Html::img('@web/img/reklama.jpg',['style' => ['width' => '100%', 'height' => '100%']]);?>
            </div>
        <?php }?>

</div>
