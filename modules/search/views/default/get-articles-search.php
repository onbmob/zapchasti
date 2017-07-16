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

$this->title = 'Детали по номеру';
$this->params['breadcrumbs'][] = $this->title;
//echo '<pre>'; var_dump($result); die;
?>
<style>
    .search-goods-art-brand:hover{background-color: #74b2e2!important; cursor: pointer};
</style>

<div class="body-content">
    <h3><?=$article.' ('.count($result['data']).')'?></h3>
    <table class="table table-striped table-bordered">
        <thead>

        </thead>
        <tr>
            <th>Продукт</th>
            <th>Артикул</th>
            <th>Бренд</th>
            <th></th>
        </tr>
        <tbody>
        <!--echo 'style="font-weight: bold"';-->
        <?php foreach($result['data'] as $item) {
            if(isset($item['ori'])) $style_tr = 'style="font-weight: bold"';
            else $style_tr = '';
        ?>
            <tr class="search-goods-art-brand"  <?=$style_tr?>
                data-article="<?=$item['DataSupplierArticleNumber']?>"
                data-brand="<?=$item['ManufacturerDescription']?>">
                <td><?=$item['NormalizedDescription']?></td>
                <td><?=$item['DataSupplierArticleNumber']?></td>
                <td><?=$item['ManufacturerDescription']?></td>
                <td><?=$item['AssemblyGroupDescription']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
