<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/** @var $node */
$this->registerJs('initKartikMenu()'); //вызов ф-ции

$page_model = new \app\models\StaticPages();
$pages = $page_model->getAllPages();

usort($pages, function ($a, $b) {
    return (strnatcasecmp(str_replace(' ','',$a->Title), str_replace(' ','',$b->Title)));
});

$pages = ArrayHelper::map($pages, 'id', 'Title');
$mas[0] = '-'; $pages = $mas + $pages;
?>

<?= $form->field($node, 'page_id')->dropDownList($pages) ?>

