<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/** @var $node */
$this->registerJs('initKartikMenu()'); //вызов ф-ции

$page_model = new \app\models\StaticPages();
$pages = $page_model->getAllPages();

/*usort($pages, function ($a, $b) {
    return (strnatcasecmp(str_replace(' ','',$a->title), str_replace(' ','',$b->title)));
});*/

$pages = ArrayHelper::map($pages, 'id', 'title');
$mas[0] = '-'; $pages = $mas + $pages;
if(!isset($node->parent)) $node->parent = 0;
?>

<?= $form->field($node, 'parent')->textInput(['readonly' => true]);?>
<input type="hidden" id="categorysearchmodel-parent" name="parent" value="<?=$node->parent?>"/>

<?= $form->field($node, 'page_id')->dropDownList($pages) ?>

