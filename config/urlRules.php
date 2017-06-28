<?php

return [

    '' => 'authorized/index',
    'exit' => 'authorized/exit',
    'index' => 'authorized/index',
    'index-from-excel' => 'authorized/index',
    'index-from-excel/<codes:[\s\S]+>' => 'authorized/index-from-excel',
    'alarm' => 'site/alarm',

    'parts' => 'parts/default/index',
    '/parts/<mark:[\s\w-.=,()]+>' => '/parts/default/choice-model',
    '/parts/<mark:[\s\w-.=,()]+>/<model_text_id:[\d]+>/<model_id:[\d]+>' => '/parts/default/choice-modification',
    '/parts/<mark:[\s\w-.=,()]+>/<model_text_id:[\d]+>/<model_id:[\d]+>/<modif_id:[\d]+>' => '/parts/default/choice-category',
    '/parts/<mark:[\s\w-.=,()]+>/<model_text_id:[\d]+>/<model_id:[\d]+>/<modif_id:[\d]+>/<category_id:[\d]+>' => '/parts/default/choice-sub-category',
    '/parts/<mark:[\s\w-.=,()]+>/<model_text_id:[\d]+>/<model_id:[\d]+>/<modif_id:[\d]+>/<category_id:[\d]+>/<sub_category_id:[\d]+>' => '/parts/default/search',


    '/parts2/<mark:[\s\w-.=,()]+>/<model_text_id:[\d]+>/<model_id:[\d]+>/<modif_id:[\d]+>/<category_id:[\d]+>/<sub_category_id:[\d]+>/<view_type_id:[\d]+>' => '/parts/default/search3',

    '/catbrand/<id:[\s\w-.=,()]+>' => '/category/default/brand',
    '/catyear/<id:[\s\w-.=,()]+>/<mark:[\s\w-.=,()]+>' => '/category/default/year',
    '/catmodel/<id:[\s\w-.=,()]+>/<mark:[\s\w-.=,()]+>/<year:[\s\w-.=,()]+>' => '/category/default/model',
    '/catspecif/<id:[\s\w-.=,()]+>/<mark:[\s\w-.=,()]+>/<year:[\s\w-.=,()]+>/<mod:[\d]+>' => '/category/default/specif',

    '/savefile/<id:[\s\w-.=,()]+>' => '/admin/files',

    '/stpage/<link:[\s\w-.=,()]+>' => '/pages/default/display-static-page',


//    '/acat/legkovye_avtomobili' => 'acat/default/index',
//    '/acat/legkovye_avtomobili/<mark:[\s\w\d-_]+>' => '/acat/default/models',
//    '/acat/legkovye_avtomobili/<mark:[\s\w\d-_]+>/<model:[\s\w-.=,()]+>' => '/acat/default/tree',
//    '/acat/legkovye_avtomobili/<mark:[\s\w\d-_]+>/<model:[\s\w-.=,()]+>/<group:[\s\w-.=,()]+>' => '/acat/default/items',


    '/acat/1' => 'acat/default/index',
    '/acat/1/<mark_id:[\d]+>' => '/acat/default/models',
    '/acat/1/<mark_id:[\d]+>/<model_id:[\d]+>' => '/acat/default/tree',
    '/acat/1/<mark_id:[\d]+>/<model_id:[\d]+>/<group_id:[\d]+>' => '/acat/default/items',


    '/search/<type:[\d]+>/<name:[\s\S]+>' => "/catalog/default/search2",
    '/search/<type:[\d]+>' => "/catalog/default/search2",


    'contacts|about|vaz|battery|oil|gbo|gaz|volga|daewoo|renault|uaz'=>'/pages/default/display-static-page',


    '/detailcard/<Brand:[^/]+>/<Code:[^/]+>/<Sours:[^/]+>/<Name:[^/]+>' => '/catalog/default/detail',



];
