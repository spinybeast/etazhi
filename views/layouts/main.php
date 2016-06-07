<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use rmrevin\yii\fontawesome\FA;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Этажи недвижимость  | <?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet'
          type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
    var _tmr = window._tmr || (window._tmr = []);
    _tmr.push({id: "2784490", type: "pageView", start: (new Date()).getTime()});
    (function (d, w, id) {
        if (d.getElementById(id)) return;
        var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
        ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
        var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
        if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
    })(document, window, "topmailru-code");
</script><noscript><div style="position:absolute;left:-10000px;">
        <img src="//top-fwz1.mail.ru/counter?id=2784490;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
    </div></noscript>
<!-- //Rating@Mail.ru counter -->
<div class="wrap">
    <header class="header">
        <div class="container header_top">
            <a href="/" class="col-xs-6 col-md-3 vertical-center text-center">
                <div><?= Html::img('/img/logo.png', array('class'=>'img-responsive')); ?></div>
            </a>

            <div class="header_info col-xs-6 col-md-3 vertical-center text-center">
                <span>Риэлторская компания</span>
            </div>
            <div class="header_phone col-xs-6 col-md-3 vertical-center text-center">
                <?php foreach (Yii::$app->params['sitePhones'] as $phone) {?>
                    <p><?= $phone ?></p>
                <?php } ?>
            </div>
            <div class="header_email col-xs-6 col-md-3 vertical-center text-center">
                <p>Адрес: <?= Yii::$app->params['siteAddress'] ?></p>
                <p>Email:</p>

                <div>
                    <a href="mailto:<?= Yii::$app->params['siteEmail'] ?>"><?= Yii::$app->params['siteEmail'] ?></a>
                </div>
                <div class="social">
                    <a href="http://vk.com/etagi_nedvigimost_taganrog" target="_blank"><?= FA::icon('vk') ?></a>
                    <a href="http://ok.ru/profile/584427097139" target="_blank"><?= FA::icon('odnoklassniki') ?></a>
                    <a href="skype:etagi-t?add"><?= FA::icon('skype') ?></a>
                </div>
            </div>
        </div>
        <?php
        NavBar::begin([
            'brandLabel' => false,
            'options' => [
                'class' => 'header_bottom',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => ''],
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Эксклюзивные предложения', 'url' => ['/exclusives']],
                ['label' => 'Новостройки', 'url' => 'http://www.novostroyki-taganroga.ru', 'linkOptions' => ['target' => '_blank']],
                ['label' => 'Ипотека', 'url' => ['/mortgage']],
                ['label' => 'Карьера', 'url' => ['/career']],
                ['label' => 'Услуги', 'url' => ['/services']],
                ['label' => 'Отзывы', 'url' => ['/reviews']],
                ['label' => 'Контакты', 'url' => ['/contact']],
            ],
        ]);
        NavBar::end();
        ?>
    </header>
    <main class="content">
        <?php if(isset($this->params['breadcrumbs'])) {
            echo \yii\widgets\Breadcrumbs::widget([
                'options' => ['class' => 'breadcrumb container'],
                'homeLink' => [
                    'label' => 'Главная',
                    'url' => Yii::$app->homeUrl
                ],
                'links' => $this->params['breadcrumbs']
            ]);
        } ?>
        <?= $content ?>
    </main>
</div>

<footer class="footer">
    <div class="container" style="position: relative">
        <div class="copyright">
            Этажи недвижимость, Агентство недвижимости<br>Все права защищены, <?= date('Y') ?>.
        </div>
        <!-- Rating@Mail.ru logo -->
        <a href="http://top.mail.ru/jump?from=2784490" style="position: absolute; top: 0; right: 10px;">
            <img src="//top-fwz1.mail.ru/counter?id=2784490;t=608;l=1"
                 style="border:0;" height="40" width="88" alt="Рейтинг@Mail.ru" /></a>
        <!-- //Rating@Mail.ru logo -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
