<?php

namespace App\Main;

class TopMenu
{
    /**
     * List of top menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'route_name' => 'user_dashboard',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],


            'file-manager' => [
                'icon' => 'hard-drive',
                'route_name' => 'file-manager',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'File Laporan Keuangan'
            ],

            'devider',

            'profile' => [
                'icon' => 'trello',
                'title' => 'Lihat Profil',
                'route_name' => 'profile-overview-1',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],

        ];
    }
}
