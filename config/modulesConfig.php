<?php
return [

    'search' => [
        'class' => 'app\modules\search\module',
    ],

    'admin' => [
        'class' => 'app\modules\admin\module',
        'layoutPath' => '../modules/admin/views/layouts',
        'layout' => 'admin'
    ],

    'treemanager' => [
        'class' => 'kartik\tree\Module',
    ],


    /*
    'pages' => [
        'class' => 'app\modules\pages\module',
    ],
        'catalog' => [
            'class' => 'app\modules\catalog\module',
        ],
        'parts' => [
            'class' => 'app\modules\parts\module',
        ],
        'category' => [
            'class' => 'app\modules\category\module',
        ],
        'order' => [
            'class' => 'app\modules\order\module',
        ],
        'loger' => [
            'class' => 'app\modules\loger\module',
        ],


        'social' => [
            // the module class
            'class' => 'kartik\social\Module',

            // the global settings for the Disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
            ],

            // the global settings for the Facebook plugins widget
            'facebook' => [
                'appId' => 'FACEBOOK_APP_ID',
                'secret' => 'FACEBOOK_APP_SECRET',
    //            'language' => 'ru-RU',
            ],

            // the global settings for the Google+ Plugins widget
            'google' => [
                'clientId' => 'GOOGLE_API_CLIENT_ID',
                'pageId' => 'GOOGLE_PLUS_PAGE_ID',
                'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
            ],

            // the global settings for the Google Analytics plugin widget
            'googleAnalytics' => [
                'id' => 'TRACKING_ID',
                'domain' => 'TRACKING_DOMAIN',
            ],

            // the global settings for the Twitter plugin widget
            'twitter' => [
                'screenName' => 'TWITTER_SCREEN_NAME'
            ],

            // the global settings for the GitHub plugin widget
            'github' => [
                'settings' => ['user' => 'GITHUB_USER', 'repo' => 'GITHUB_REPO']
            ],

            'vk' => [
                'apiId' => '0000000',
            ],
        ],
    */
];
?>
