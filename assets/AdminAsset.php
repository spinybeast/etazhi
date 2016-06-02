<?php
/**
 * Created by PhpStorm.
 * User: spiny
 * Date: 26.11.15
 * Time: 16:17
 */

namespace app\assets;


class AdminAsset extends AppAsset
{
    public $css = [
    ];
    public $js = [
        'js/admin.js',
        'https://dadata.ru/static/js/lib/jquery.suggestions-15.12.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
        'wbraganca\dynamicform\DynamicFormAsset',
    ];
}