<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/countries' => [
            [['_route' => 'country_app_country_list', '_controller' => 'App\\Controller\\CountryController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'country_app_country_create', '_controller' => 'App\\Controller\\CountryController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/game' => [
            [['_route' => 'game_app_game_list', '_controller' => 'App\\Controller\\GameController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'game_app_game_create', '_controller' => 'App\\Controller\\GameController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/league' => [
            [['_route' => 'league_app_league_list', '_controller' => 'App\\Controller\\LeagueController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'league_app_league_create', '_controller' => 'App\\Controller\\LeagueController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/players' => [
            [['_route' => 'player_app_player_list', '_controller' => 'App\\Controller\\PlayerController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'player_app_player_create', '_controller' => 'App\\Controller\\PlayerController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/player-history' => [
            [['_route' => 'player_history_app_playerhistory_list', '_controller' => 'App\\Controller\\PlayerHistoryController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'player_history_app_playerhistory_create', '_controller' => 'App\\Controller\\PlayerHistoryController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/player-stats' => [
            [['_route' => 'player_stats_app_playerstats_list', '_controller' => 'App\\Controller\\PlayerStatsController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'player_stats_app_playerstats_create', '_controller' => 'App\\Controller\\PlayerStatsController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/referees' => [
            [['_route' => 'referee_app_referee_list', '_controller' => 'App\\Controller\\RefereeController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'referee_app_referee_create', '_controller' => 'App\\Controller\\RefereeController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/seasons' => [
            [['_route' => 'season_app_season_list', '_controller' => 'App\\Controller\\SeasonController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'season_app_season_create', '_controller' => 'App\\Controller\\SeasonController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/sports' => [
            [['_route' => 'sport_app_sport_list', '_controller' => 'App\\Controller\\SportController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'sport_app_sport_create', '_controller' => 'App\\Controller\\SportController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/stadiums' => [
            [['_route' => 'stadium_app_stadium_list', '_controller' => 'App\\Controller\\StadiumController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'stadium_app_stadium_create', '_controller' => 'App\\Controller\\StadiumController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/teams' => [
            [['_route' => 'team_app_team_list', '_controller' => 'App\\Controller\\TeamController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'team_app_team_create', '_controller' => 'App\\Controller\\TeamController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/users' => [
            [['_route' => 'user_app_user_list', '_controller' => 'App\\Controller\\UserController::list'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'user_app_user_create', '_controller' => 'App\\Controller\\UserController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/users/me' => [[['_route' => 'user_app_user_getme', '_controller' => 'App\\Controller\\UserController::getMe'], null, ['GET' => 0], null, false, false, null]],
        '/api/docs' => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'], null, ['GET' => 0], null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|countries/([^/]++)(?'
                        .'|(*:71)'
                    .')'
                    .'|game/(?'
                        .'|([^/]++)(?'
                            .'|(*:98)'
                        .')'
                        .'|date/([^/]++)(*:119)'
                    .')'
                    .'|league/([^/]++)(?'
                        .'|(*:146)'
                    .')'
                    .'|player(?'
                        .'|s/([^/]++)(?'
                            .'|(*:177)'
                        .')'
                        .'|\\-(?'
                            .'|history/([^/]++)(?'
                                .'|(*:210)'
                            .')'
                            .'|stats/([^/]++)(?'
                                .'|(*:236)'
                            .')'
                        .')'
                    .')'
                    .'|referees/([^/]++)(?'
                        .'|(*:267)'
                    .')'
                    .'|s(?'
                        .'|easons/([^/]++)(?'
                            .'|(*:298)'
                        .')'
                        .'|ports/([^/]++)(?'
                            .'|(*:324)'
                        .')'
                        .'|tadiums/([^/]++)(?'
                            .'|(*:352)'
                        .')'
                    .')'
                    .'|teams/([^/]++)(?'
                        .'|(*:379)'
                    .')'
                    .'|users/(?'
                        .'|([^/]++)(?'
                            .'|(*:408)'
                            .'|/change\\-password(*:433)'
                        .')'
                        .'|forgot\\-password(*:458)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        71 => [
            [['_route' => 'country_app_country_getcountry', '_controller' => 'App\\Controller\\CountryController::getCountry'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'country_app_country_update', '_controller' => 'App\\Controller\\CountryController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'country_app_country_delete', '_controller' => 'App\\Controller\\CountryController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        98 => [
            [['_route' => 'game_app_game_getgame', '_controller' => 'App\\Controller\\GameController::getGame'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'game_app_game_update', '_controller' => 'App\\Controller\\GameController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'game_app_game_delete', '_controller' => 'App\\Controller\\GameController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        119 => [[['_route' => 'game_app_game_getbydate', '_controller' => 'App\\Controller\\GameController::getByDate'], ['date'], ['GET' => 0], null, false, true, null]],
        146 => [
            [['_route' => 'league_app_league_getleague', '_controller' => 'App\\Controller\\LeagueController::getLeague'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'league_app_league_update', '_controller' => 'App\\Controller\\LeagueController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'league_app_league_delete', '_controller' => 'App\\Controller\\LeagueController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        177 => [
            [['_route' => 'player_app_player_getplayer', '_controller' => 'App\\Controller\\PlayerController::getPlayer'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'player_app_player_update', '_controller' => 'App\\Controller\\PlayerController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'player_app_player_delete', '_controller' => 'App\\Controller\\PlayerController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        210 => [
            [['_route' => 'player_history_app_playerhistory_getplayerhistory', '_controller' => 'App\\Controller\\PlayerHistoryController::getPlayerHistory'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'player_history_app_playerhistory_update', '_controller' => 'App\\Controller\\PlayerHistoryController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'player_history_app_playerhistory_delete', '_controller' => 'App\\Controller\\PlayerHistoryController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        236 => [
            [['_route' => 'player_stats_app_playerstats_getplayerstats', '_controller' => 'App\\Controller\\PlayerStatsController::getPlayerStats'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'player_stats_app_playerstats_update', '_controller' => 'App\\Controller\\PlayerStatsController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'player_stats_app_playerstats_delete', '_controller' => 'App\\Controller\\PlayerStatsController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        267 => [
            [['_route' => 'referee_app_referee_getreferee', '_controller' => 'App\\Controller\\RefereeController::getReferee'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'referee_app_referee_update', '_controller' => 'App\\Controller\\RefereeController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'referee_app_referee_delete', '_controller' => 'App\\Controller\\RefereeController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        298 => [
            [['_route' => 'season_app_season_getseason', '_controller' => 'App\\Controller\\SeasonController::getSeason'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'season_app_season_update', '_controller' => 'App\\Controller\\SeasonController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'season_app_season_delete', '_controller' => 'App\\Controller\\SeasonController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        324 => [
            [['_route' => 'sport_app_sport_getsport', '_controller' => 'App\\Controller\\SportController::getSport'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'sport_app_sport_update', '_controller' => 'App\\Controller\\SportController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'sport_app_sport_delete', '_controller' => 'App\\Controller\\SportController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        352 => [
            [['_route' => 'stadium_app_stadium_getstadium', '_controller' => 'App\\Controller\\StadiumController::getStadium'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'stadium_app_stadium_update', '_controller' => 'App\\Controller\\StadiumController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'stadium_app_stadium_delete', '_controller' => 'App\\Controller\\StadiumController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        379 => [
            [['_route' => 'team_app_team_getteam', '_controller' => 'App\\Controller\\TeamController::getTeam'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'team_app_team_update', '_controller' => 'App\\Controller\\TeamController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'team_app_team_delete', '_controller' => 'App\\Controller\\TeamController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        408 => [
            [['_route' => 'user_app_user_update', '_controller' => 'App\\Controller\\UserController::update'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'user_app_user_delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        433 => [[['_route' => 'user_app_user_changepassword', '_controller' => 'App\\Controller\\UserController::changePassword'], ['id'], ['POST' => 0], null, false, false, null]],
        458 => [
            [['_route' => 'user_app_user_forgotpassword', '_controller' => 'App\\Controller\\UserController::forgotPassword'], [], ['POST' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
