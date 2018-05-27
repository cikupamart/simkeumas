<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kartik\nav\NavX;

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
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app', Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    // everyone can see Home page
   

    
    // we do not need to display About and Contact pages to employee+ roles
    
    
    
    

    // display Users to admin+ roles
    if (Yii::$app->user->can('admin')){

         $menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/kas/index']];

        $menuItems[] = ['label' => Yii::t('app', 'Kas'), 'url' => '#','items'=>[
             ['label' => 'Kas Kecil',  
                'url' => ['#'],
                'items' => [
                    ['label' => Yii::t('app', 'Manage'),'url' => ['kas-kecil/index']],
                    ['label' => Yii::t('app', 'Masuk'),'url' => ['kas-kecil/masuk']],
                    ['label' => Yii::t('app', 'Keluar'),'url' => ['kas-kecil/keluar']],
                ],
            ],
            ['label' => 'Kas Besar',  
                'url' => ['#'],
                'items' => [
                    ['label' => Yii::t('app', 'Manage'),'url' => ['kas/index']],
                    ['label' => Yii::t('app', 'Masuk'),'url' => ['kas/masuk']],
                    ['label' => Yii::t('app', 'Keluar'),'url' => ['kas/keluar']],
                ],
            ],
           
           
        ]];

        $menuItems[] = ['label' => Yii::t('app', 'Laporan'), 'url' => '#','items'=>[
            ['label' => Yii::t('app', 'Kas Masuk'),'url' => ['kas/laporan']],
            ['label' => Yii::t('app', 'Kas Keluar'),'url' => ['kas/laporan']],
            ['label' => Yii::t('app', 'Rekapitulasi'),'url' => ['kas/laporan']],
           
        ]];


         $menuItems[] = ['label' => Yii::t('app', 'Master'), 'url' => '#','items'=>[
            ['label' => Yii::t('app', 'Perkiraan'),'url' => ['/perkiraan/index']],
            ['label' => Yii::t('app', 'Saldo'),'url' => ['/saldo/index']],
            ['label' => Yii::t('app', 'Users'),'url' => ['/user/index']],
            // ['label' => Yii::t('app', 'Rekapitulasi'),'url' => ['kas/laporan']],
           
        ]];

    }


    
    // display Logout to logged in users
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Yii::t('app', 'Logout'). ' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }

    // display Signup and Login pages to guests of the site
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Kas Besar'), 'url' => ['/kas/index']];
        $menuItems[] = ['label' => Yii::t('app', 'Kas Kecil'), 'url' => ['/kas-kecil/index']];
        // $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    }

    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right '],
        'items' => $menuItems,
        'encodeLabels' =>false
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
