<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/login' => [
            [['_route' => 'LoginUser', '_controller' => 'App\\Controller\\AuthController', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\User', '_api_operation_name' => 'LoginUser'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'api_login', '_controller' => 'App\\Controller\\AuthController'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/admin/login' => [[['_route' => 'api_admin_login', '_controller' => 'App\\Controller\\AuthControllerAdmin'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/me' => [[['_route' => 'api_user_me', '_controller' => 'App\\Controller\\UserController::getUserData'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api(?'
                    .'|/(?'
                        .'|\\.well\\-known/genid/([^/]++)(*:46)'
                        .'|errors/(\\d+)(*:65)'
                        .'|validation_errors/([^/]++)(*:98)'
                    .')'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:134)'
                    .'|/(?'
                        .'|d(?'
                            .'|ocs(?:\\.([^/]++))?(*:168)'
                            .'|ateGames/([^/]++)(*:193)'
                        .')'
                        .'|co(?'
                            .'|ntexts/([^.]+)(?:\\.(jsonld))?(*:236)'
                            .'|untries(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:280)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:306)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:344)'
                                .')'
                            .')'
                        .')'
                        .'|validation_errors/([^/]++)(?'
                            .'|(*:384)'
                        .')'
                        .'|games(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:427)'
                            .'|(?:\\.([^/]++))?(*:450)'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:487)'
                            .')'
                            .'|(?:\\.([^/]++))?(*:511)'
                        .')'
                        .'|leagues(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:556)'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:582)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:620)'
                            .')'
                        .')'
                        .'|match_has_referees(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:677)'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:703)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:741)'
                            .')'
                        .')'
                        .'|player(?'
                            .'|s(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:790)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:816)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:854)'
                                .')'
                            .')'
                            .'|_(?'
                                .'|histories(?'
                                    .'|/([^/\\.]++)(?:\\.([^/]++))?(*:906)'
                                    .'|(?:\\.([^/]++))?(?'
                                        .'|(*:932)'
                                    .')'
                                    .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:970)'
                                    .')'
                                .')'
                                .'|stats(?'
                                    .'|/([^/\\.]++)(?:\\.([^/]++))?(*:1014)'
                                    .'|(?:\\.([^/]++))?(?'
                                        .'|(*:1041)'
                                    .')'
                                    .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:1080)'
                                    .')'
                                .')'
                            .')'
                        .')'
                        .'|referees(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:1130)'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:1157)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:1196)'
                            .')'
                        .')'
                        .'|s(?'
                            .'|easons(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:1246)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1273)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1312)'
                                .')'
                            .')'
                            .'|ports(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:1357)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1384)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1423)'
                                .')'
                            .')'
                            .'|tadia(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:1468)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1495)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1534)'
                                .')'
                            .')'
                        .')'
                        .'|teams(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:1580)'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:1607)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:1646)'
                            .')'
                        .')'
                        .'|user(?'
                            .'|s(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:1694)'
                                .'|(?:\\.([^/]++))?(*:1718)'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1756)'
                                .')'
                                .'|(?:\\.([^/]++))?(*:1781)'
                            .')'
                            .'|_has_favorite_teams(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:1839)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1866)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1905)'
                                .')'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:1947)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        46 => [[['_route' => 'api_genid', '_controller' => 'api_platform.action.not_exposed', '_api_respond' => 'true'], ['id'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        65 => [[['_route' => 'api_errors', '_controller' => 'api_platform.action.error_page'], ['status'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        98 => [[['_route' => 'api_validation_errors', '_controller' => 'api_platform.action.not_exposed'], ['id'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        134 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        168 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        193 => [[['_route' => '_api_/dateGames/{date}_get_collection', '_controller' => 'App\\Controller\\GameDateController', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Game', '_api_operation_name' => '_api_/dateGames/{date}_get_collection'], ['date'], ['GET' => 0], null, false, true, null]],
        236 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        280 => [[['_route' => '_api_/countries/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Country', '_api_operation_name' => '_api_/countries/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        306 => [
            [['_route' => '_api_/countries{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Country', '_api_operation_name' => '_api_/countries{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/countries{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Country', '_api_operation_name' => '_api_/countries{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        344 => [
            [['_route' => '_api_/countries/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Country', '_api_operation_name' => '_api_/countries/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/countries/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Country', '_api_operation_name' => '_api_/countries/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        384 => [
            [['_route' => '_api_validation_errors_problem', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_problem'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_hydra', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_hydra'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_jsonapi', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_jsonapi'], ['id'], ['GET' => 0], null, false, true, null],
        ],
        427 => [[['_route' => '_api_/games/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Game', '_api_operation_name' => '_api_/games/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        450 => [[['_route' => '_api_/games{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Game', '_api_operation_name' => '_api_/games{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null]],
        487 => [
            [['_route' => '_api_/games/{id}{._format}_put', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Game', '_api_operation_name' => '_api_/games/{id}{._format}_put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => '_api_/games/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Game', '_api_operation_name' => '_api_/games/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        511 => [[['_route' => '_api_/games{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Game', '_api_operation_name' => '_api_/games{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null]],
        556 => [[['_route' => '_api_/leagues/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\League', '_api_operation_name' => '_api_/leagues/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        582 => [
            [['_route' => '_api_/leagues{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\League', '_api_operation_name' => '_api_/leagues{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/leagues{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\League', '_api_operation_name' => '_api_/leagues{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        620 => [
            [['_route' => '_api_/leagues/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\League', '_api_operation_name' => '_api_/leagues/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/leagues/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\League', '_api_operation_name' => '_api_/leagues/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        677 => [[['_route' => '_api_/match_has_referees/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\MatchHasReferees', '_api_operation_name' => '_api_/match_has_referees/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        703 => [
            [['_route' => '_api_/match_has_referees{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\MatchHasReferees', '_api_operation_name' => '_api_/match_has_referees{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/match_has_referees{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\MatchHasReferees', '_api_operation_name' => '_api_/match_has_referees{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        741 => [
            [['_route' => '_api_/match_has_referees/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\MatchHasReferees', '_api_operation_name' => '_api_/match_has_referees/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/match_has_referees/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\MatchHasReferees', '_api_operation_name' => '_api_/match_has_referees/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        790 => [[['_route' => '_api_/players/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Player', '_api_operation_name' => '_api_/players/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        816 => [
            [['_route' => '_api_/players{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Player', '_api_operation_name' => '_api_/players{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/players{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Player', '_api_operation_name' => '_api_/players{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        854 => [
            [['_route' => '_api_/players/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Player', '_api_operation_name' => '_api_/players/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/players/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Player', '_api_operation_name' => '_api_/players/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        906 => [[['_route' => '_api_/player_histories/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerHistory', '_api_operation_name' => '_api_/player_histories/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        932 => [
            [['_route' => '_api_/player_histories{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerHistory', '_api_operation_name' => '_api_/player_histories{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/player_histories{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerHistory', '_api_operation_name' => '_api_/player_histories{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        970 => [
            [['_route' => '_api_/player_histories/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerHistory', '_api_operation_name' => '_api_/player_histories/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/player_histories/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerHistory', '_api_operation_name' => '_api_/player_histories/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1014 => [[['_route' => '_api_/player_stats/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerStats', '_api_operation_name' => '_api_/player_stats/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1041 => [
            [['_route' => '_api_/player_stats{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerStats', '_api_operation_name' => '_api_/player_stats{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/player_stats{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerStats', '_api_operation_name' => '_api_/player_stats{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1080 => [
            [['_route' => '_api_/player_stats/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerStats', '_api_operation_name' => '_api_/player_stats/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/player_stats/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\PlayerStats', '_api_operation_name' => '_api_/player_stats/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1130 => [[['_route' => '_api_/referees/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Referee', '_api_operation_name' => '_api_/referees/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1157 => [
            [['_route' => '_api_/referees{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Referee', '_api_operation_name' => '_api_/referees{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/referees{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Referee', '_api_operation_name' => '_api_/referees{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1196 => [
            [['_route' => '_api_/referees/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Referee', '_api_operation_name' => '_api_/referees/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/referees/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Referee', '_api_operation_name' => '_api_/referees/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1246 => [[['_route' => '_api_/seasons/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Season', '_api_operation_name' => '_api_/seasons/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1273 => [
            [['_route' => '_api_/seasons{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Season', '_api_operation_name' => '_api_/seasons{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/seasons{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Season', '_api_operation_name' => '_api_/seasons{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1312 => [
            [['_route' => '_api_/seasons/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Season', '_api_operation_name' => '_api_/seasons/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/seasons/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Season', '_api_operation_name' => '_api_/seasons/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1357 => [[['_route' => '_api_/sports/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Sport', '_api_operation_name' => '_api_/sports/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1384 => [
            [['_route' => '_api_/sports{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Sport', '_api_operation_name' => '_api_/sports{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/sports{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Sport', '_api_operation_name' => '_api_/sports{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1423 => [
            [['_route' => '_api_/sports/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Sport', '_api_operation_name' => '_api_/sports/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/sports/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Sport', '_api_operation_name' => '_api_/sports/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1468 => [[['_route' => '_api_/stadia/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Stadium', '_api_operation_name' => '_api_/stadia/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1495 => [
            [['_route' => '_api_/stadia{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Stadium', '_api_operation_name' => '_api_/stadia{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/stadia{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Stadium', '_api_operation_name' => '_api_/stadia{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1534 => [
            [['_route' => '_api_/stadia/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Stadium', '_api_operation_name' => '_api_/stadia/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/stadia/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Stadium', '_api_operation_name' => '_api_/stadia/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1580 => [[['_route' => '_api_/teams/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Team', '_api_operation_name' => '_api_/teams/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1607 => [
            [['_route' => '_api_/teams{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Team', '_api_operation_name' => '_api_/teams{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/teams{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Team', '_api_operation_name' => '_api_/teams{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1646 => [
            [['_route' => '_api_/teams/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Team', '_api_operation_name' => '_api_/teams/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/teams/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Team', '_api_operation_name' => '_api_/teams/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1694 => [[['_route' => '_api_/users/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\User', '_api_operation_name' => '_api_/users/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1718 => [[['_route' => '_api_/users{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\User', '_api_operation_name' => '_api_/users{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null]],
        1756 => [
            [['_route' => '_api_/users/{id}{._format}_put', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\User', '_api_operation_name' => '_api_/users/{id}{._format}_put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => '_api_/users/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\User', '_api_operation_name' => '_api_/users/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1781 => [[['_route' => '_api_/users{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\User', '_api_operation_name' => '_api_/users{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null]],
        1839 => [[['_route' => '_api_/user_has_favorite_teams/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\UserHasFavoriteTeam', '_api_operation_name' => '_api_/user_has_favorite_teams/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        1866 => [
            [['_route' => '_api_/user_has_favorite_teams{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\UserHasFavoriteTeam', '_api_operation_name' => '_api_/user_has_favorite_teams{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/user_has_favorite_teams{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\UserHasFavoriteTeam', '_api_operation_name' => '_api_/user_has_favorite_teams{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1905 => [
            [['_route' => '_api_/user_has_favorite_teams/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\UserHasFavoriteTeam', '_api_operation_name' => '_api_/user_has_favorite_teams/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/user_has_favorite_teams/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\UserHasFavoriteTeam', '_api_operation_name' => '_api_/user_has_favorite_teams/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        1947 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
