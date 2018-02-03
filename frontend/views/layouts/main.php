<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
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
            'class' => 'navbar-inverse navbar-fixed-top ',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
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
        NavBar::begin([
            'options' => [
                'class' => 'container col-md-3 col-lg-2 col-sm-4 col-xs-12 fixed navbar-default navbar-left '
            ],]);
    print Nav::widget(
        [
            'options' => [
                'class' => 'nav   navbar-left nav-pills nav-stacked '
            ],
        'items' => [
            [
                'label' => 'База даних',
                'url' => ['cells/index'],
            ],
            [
                'label' => 'Реєстрація',
                'url' => ['cells/create'],
            ],
            [
                'label' => 'Місце знаходження',
                'items' => [
                    [
                        'label' => 'Додати вулицю',
                        'url' => ['/street/create'],
                        'linkOptions' => ['target' => '_blank'],
                    ],
                    [
                        'label' => 'Вулиці',
                        'url' => ['/street/index'],
                    ],
                    '<li class="divider"></li>',
                    [
                        'label' => 'Додати місто',
                        'url' => ['/city/create'],
                        'linkOptions' => ['target' => '_blank'],
                    ],
                    [
                        'label' => 'Міста',
                        'url' => ['/city/index'],
                    ],
                    '<li class="divider"></li>',
                    [
                        'label' => 'Додати область',
                        'url' => ['/region/create'],
                        'linkOptions' => ['target' => '_blank'],
                    ],
                    [
                        'label' => 'Області',
                        'url' => ['/region/index'],
                    ],
                ],
            ],
            [
                'label' => 'Абонент',
                'items' => [
                    [
                        'label' => 'Додати обладнення',
                        'url' => ['/services/create'],
                        'linkOptions' => ['target' => '_blank'],
                    ],
                    [
                        'label' => 'Обладнення',
                        'url' => ['/services/index'],
                    ],
                    '<li class="divider"></li>',
                    [
                        'label' => 'Додати тип абонента',
                        'url' => ['/abon/create'],
                        'linkOptions' => ['target' => '_blank'],
                    ],
                    [
                        'label' => 'Тип абонентів',
                        'url' => ['/abon/index'],
                    ],
                    '<li class="divider"></li>',
                    [
                        'label' => 'Додати тип виїзда',
                        'url' => ['/departure/create'],
                        'linkOptions' => ['target' => '_blank'],
                    ],
                    [
                        'label' => 'Виїзди',
                        'url' => ['/departure/index'],
                    ],
                ],
            ],
            [
                'label' => 'Розробник',
                'url' => ['/admin/admin'],
            ],
            [
                'label' => 'WestNetwork',
                'url' => 'http://www.west.pl.ua',
                'linkOptions' => ['target' => '_blank'],
            ],
            [
                'label' => 'Реєстрація ONU',
                'items' => [
                    [
                        'label' => 'Полонне',
                        'url' =>'http://onureg.west.pl.ua/view/start.php',
                        'linkOptions' => ['target' => '_blank'],

                    ],
                    [
                        'label' => 'Баранівка',
                        'url' => 'http://brgpon.west.pl.ua/view/start.php',
                        'linkOptions' => ['target' => '_blank'],
                    ],
                    [
                        'label' => 'Чорторія',
                        'url' => 'http://onuregch.west.pl.ua/view/start.php',
                        'linkOptions' => ['target' => '_blank'],
                    ],
                ],
            ],
        ],
        ]);
        NavBar::end();}
    ?>
    <div class="container <?php if (!Yii::$app->user->isGuest){echo "col-md-9 col-lg-10 col-sm-8 col-xs-12 ";}?>">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php \yii\widgets\Pjax::begin()?>
        <?= $content ?>
        <?php \yii\widgets\Pjax::end()?>
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
