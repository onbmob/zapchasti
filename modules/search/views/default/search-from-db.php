<?php

/* ["ID"]=>
      string(4) "3002"
      ["NormalizedDescription"]=>
      string(29) "РњР°СЃР»СЏРЅС‹Р№ РїРѕРґРґРѕРЅ"
      ["Description"]=>
      string(0) ""
      ["DataSupplierArticleNumber"]=>
      string(16) "0216-00-5088473P"
      ["ManufacturerID"]=>
      string(4) "3671"
      ["ProductID"]=>
      string(3) "592"
      ["ManufacturerDescription"]=>
      string(4) "BLIC"
      ["ProductDescription"]=>
      string(29) "РњР°СЃР»СЏРЅС‹Р№ РїРѕРґРґРѕРЅ"
      ["ProductNormalizedDescription"]=>
      string(29) "РњР°СЃР»СЏРЅС‹Р№ РєР°СЂС‚РµСЂ"
      ["AssemblyGroupDescription"]=>
      string(20) "РЎРјР°Р·С‹РІР°РЅРёРµ"
      ["UsageDescription"]=>
      string(0) ""
 */

$this->title = 'Результаты поиска';
$this->params['breadcrumbs'][] = $this->title;
//echo '<pre>'; var_dump($result); die;
?>

<div class="body-content">
    <h3><?=$title.' ('.count($result['data']).')'?></h3>
    <table class="table table-striped table-bordered">
        <thead>

        </thead>
        <tr>
            <th>Поставщик</th>
            <th>Бренд</th>
            <th>Артикул</th>
            <th>Наименование</th>
            <th>Кол-во</th>
            <th>Цена</th>
            <th>Кратность</th>
            <th>Склад</th>
            <th>Срок<br>поставки</th>
        </tr>
        <tbody>
        <!--echo 'style="font-weight: bold"';-->
        <?php foreach($result['data'] as $item) {?>
            <tr class="goods-item">
                <td><?=$item->supl_code?></td>
                <td><?=$item->_brand?></td>
                <td><?=$item->_article?></td>
                <td><?=$item->_name?></td>
                <td><?=$item->_count?></td>
                <td><?=$item->_price?></td>
                <td><?=$item->_multiplicity?></td>
                <td><?=$item->_storage?></td>
                <td><?=$item->_storage_time?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
