<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite243041d0325c4b9112476caedcbc446
{
    public static $files = array (
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
        '2c102faa651ef8ea5874edb585946bce' => __DIR__ . '/..' . '/swiftmailer/swiftmailer/lib/swift_required.php',
        '7e702cccdb9dd904f2ccf22e5f37abae' => __DIR__ . '/..' . '/facebook/php-sdk-v4/src/Facebook/polyfills.php',
    );

    public static $prefixLengthsPsr4 = array (
        'y' => 
        array (
            'yii\\swiftmailer\\' => 16,
            'yii\\jui\\' => 8,
            'yii\\gii\\' => 8,
            'yii\\faker\\' => 10,
            'yii\\debug\\' => 10,
            'yii\\composer\\' => 13,
            'yii\\codeception\\' => 16,
            'yii\\bootstrap\\' => 14,
            'yii\\' => 4,
        ),
        'v' => 
        array (
            'vova07\\imperavi\\' => 16,
        ),
        'm' => 
        array (
            'moonland\\phpexcel\\' => 18,
        ),
        'k' => 
        array (
            'kartik\\tree\\' => 12,
            'kartik\\social\\' => 14,
            'kartik\\form\\' => 12,
            'kartik\\datetime\\' => 16,
            'kartik\\base\\' => 12,
        ),
        'c' => 
        array (
            'creocoder\\nestedsets\\' => 21,
            'cebe\\markdown\\' => 14,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'yii\\swiftmailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-swiftmailer',
        ),
        'yii\\jui\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-jui',
        ),
        'yii\\gii\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-gii',
        ),
        'yii\\faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-faker',
        ),
        'yii\\debug\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-debug',
        ),
        'yii\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-composer',
        ),
        'yii\\codeception\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-codeception',
        ),
        'yii\\bootstrap\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-bootstrap',
        ),
        'yii\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2',
        ),
        'vova07\\imperavi\\' => 
        array (
            0 => __DIR__ . '/..' . '/vova07/yii2-imperavi-widget/src',
        ),
        'moonland\\phpexcel\\' => 
        array (
            0 => __DIR__ . '/..' . '/moonlandsoft/yii2-phpexcel',
        ),
        'kartik\\tree\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-tree-manager',
        ),
        'kartik\\social\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-social',
        ),
        'kartik\\form\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-widget-activeform',
        ),
        'kartik\\datetime\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-widget-datetimepicker',
        ),
        'kartik\\base\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-krajee-base',
        ),
        'creocoder\\nestedsets\\' => 
        array (
            0 => __DIR__ . '/..' . '/creocoder/yii2-nested-sets/src',
        ),
        'cebe\\markdown\\' => 
        array (
            0 => __DIR__ . '/..' . '/cebe/markdown',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/php-sdk-v4/src/Facebook',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
        'H' => 
        array (
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
        'D' => 
        array (
            'Diff' => 
            array (
                0 => __DIR__ . '/..' . '/phpspec/php-diff/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite243041d0325c4b9112476caedcbc446::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite243041d0325c4b9112476caedcbc446::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite243041d0325c4b9112476caedcbc446::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
