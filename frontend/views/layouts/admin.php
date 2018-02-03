<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use \yii\widgets\Pjax;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'WestNetwork',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top ',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'WestNetwork', 'url' => ['http://www.west.pl.ua/']],

    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Війти', 'url' => ['/site/login']];

    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Вийти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <?php
    if(!Yii::$app->user->isGuest) {
        // print '<div class="">';
        NavBar::begin([
            'options' => [
                'class' => 'container col-md-3 col-lg-2 col-sm-4 col-xs-12 fixed  navbar-inverse navbar-left '
            ],]);
        print Nav::widget(
            [
                'options' => [
                    'class' => 'nav   navbar-left nav-pills nav-stacked '
                ],
                'items' => [
                    [
                        'label' => 'Додати користувача',
                        'url' => ['admin/signup'],
                    ],
                    [
                        'label' => 'Заявки',
                        'url' => ['/cells/index'],
                    ],

                    [
                        'label' => 'Розробник',
                        'url' => ['/admin'],
                    ],
                ],

            ]);
        NavBar::end();
        //print '</div>';
    }
    ?>
    <div class="container <?php if (!Yii::$app->user->isGuest){echo "col-md-9 col-lg-10 col-sm-8 col-xs-12 ";}?>">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php Pjax::begin()?>
        <?= $content ?>
        <?php Pjax::end()?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Alex WebStudio <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
