<?php
use yii\bootstrap\Html;
?>

<style>
        .search-main {width: 100%; margin-bottom: 10px;}
        .search-main .btn-primary { float: right; width: 19%}
        .search-main #search_article_main { width: 40%}
        .search-main #search_phrase_main { width: 40%}
    </style>

<div class="search-main">
    <input type="text" id="search_article_main" value="" class="form-control"
           style="display:inline-flex;" placeholder="Введите артикул"/>
    <input type="text" id="search_phrase_main" value="" class="form-control"
           style="display:inline-flex;" placeholder="Введите фразу для поиска"/>
          <?=Html::submitButton('Поиск', [ 'id' => 'start_main_search', 'class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>





