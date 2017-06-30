<?php

use app\modules\admin\models\CategorySearchModel;
use kartik\tree\TreeView;
/**
 * @var $model = new app\modules\loger\models\auchlog;
 * @var $dataProviderModel yii\data\ActiveDataProvider;
 */

$this->title = 'Меню на главной';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('initKartikMenu()'); //вызов ф-ции

?>
<div class="popular-category-index">
    <?php


    echo TreeView::widget([
        'query' => CategorySearchModel::find()->addOrderBy('root, lft'),
        // query fetching only active tree nodes ordered
//        'query' => CategoryModel:: find()->andWhere(['active'=>true])->addOrderBy('root, lft'),

        'headingOptions' => ['label' => 'Меню'], // Титл, если не задать - не показывается
        'rootOptions' => ['label'=>'<span class="text-primary">Меню на главной</span>'], // название корневого элемента - если нет - "Корень"
//        'fontAwesome' => false,
        'isAdmin' => true,  // показать настройки администратора и сохранить, обновить
//        'displayValue' => 1, // ID, элемента выводимого при инициализации
        'nodeView' =>  '@app/modules/admin/views/category-search/view3', // Можно подменить форму полностью
        'nodeAddlViews' => [
            '2' => '@app/modules/admin/views/category-search/view2',
        ],

//        'iconEditSettings' => [  // Панель редактирования иконок
//            'show' => 'list',
//            'listData' => [
//                'folder' => 'Папка',
//                'file' => 'Элемент',
//                'mobile' => 'Phone',
//                'bell' => 'Bell',
//            ]
//        ],
        'iconEditSettings'=> [
            'show' => 'none',
        ],
        'showIDAttribute' => false, // показывать ИД элемента
        'showCheckbox' => false, // показывать чекбокс возле элемента
        'multiple' => false, // множественный выбор элементов
        'showInactive' => true, // показывать неактивные элементы
        'treeOptions' =>['style' => 'height:700px'],
//        'headerOptions' =>['style' => 'width:400px'],
//        'detailOptions' =>['style' => 'width:510px']
        'softDelete' => false, // defaults to true
        'cacheSettings' => ['enableCache' => true], // defaults to true
        'nodeFormOptions' => ['enctype' => 'multipart/form-data']

    ]);

/*    echo TreeViewInput::widget([
        // single query fetch to render the tree
        // use the Product model you have in the previous step
        'query' => CategoryModel::find()->addOrderBy('root, lft'),
        'headingOptions'=>['label'=>'Категории'],
        'name' => 'kv-product', // input name
//        'value' => '1,2,3',     // values selected (comma separated for multiple select)
        'asDropdown' => false,   // will render the tree input widget as a dropdown.
        'multiple' => true,     // set to false if you do not need multiple selection
        'fontAwesome' => false,  // render font awesome icons
        'rootOptions' => [
            'label'=>'<i class="fa fa-tree"></i>',  // custom root label
            'class'=>'text-success'
        ],
    ]);*/
    ?>

</div>