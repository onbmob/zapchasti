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

$this->title = 'Детали авто';
$this->params['breadcrumbs'][] = $this->title;
//echo '<pre>'; var_dump($result); die;
?>
<div class="body-content">
    <h3><?=$brand.' / '.$model.' ('.count($result['data']).')'?></h3>
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
        <?php foreach($result['data'] as $item) {?>
            <tr>
                <td><?=$item['NormalizedDescription']?></td>
                <td><?=$item['DataSupplierArticleNumber']?></td>
                <td><?=$item['ManufacturerDescription']?></td>
                <td><?=$item['AssemblyGroupDescription']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
