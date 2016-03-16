<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
//use app\assets\MaterialAsset;

AppAsset::register($this);
//MaterialAsset::register($this);
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
        'brandLabel' => 'This my E-EMR',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'แบบใหม่', 'url' => ['/s']],
        ['label' => 'backend', 'url'=>\Yii::$app->urlManagerBackend->baseUrl],
        ['label' => 'About This', 'url' => ['/site/about']],
 
        Yii::$app->user->isGuest ?
['label' => 'Sign in', 'url' => ['/user/security/login']] :
['label' => 'Account(' . Yii::$app->user->identity->username . ')', 'items'=>[
    ['label' => 'Profile', 'url' => ['/user/settings/profile']],
    ['label' => 'Account', 'url' => ['/user/settings/account']],
    ['label' => 'Logout', 'url' => ['/user/security/logout'],'linkOptions' => ['data-method' => 'post']],
]],
['label' => 'Register', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
    ];
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

<!--    <div class="container" style="margin-top: 80px;">-->
     
        <div class="container"">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Peeragad Poonsawat <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
