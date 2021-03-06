<?php

namespace App\Main;

use Illuminate\Support\Facades\Auth;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {

        if (Auth::check()) {
            if (Auth::user()->status == "investor") {
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
                        'route_name' => 'laporan_keuangan',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Laporan Keuangan'
                    ],
                    
                    'klaim_dana' => [
                        'icon' => 'hard-drive',
                        'route_name' => 'form_klaim',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Klaim dana'
                    ],


                    'devider',

                    'profile' => [
                        'icon' => 'trello',
                        'title' => 'Lihat Profil',
                        'route_name' => 'profil_user',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],

                    'Logout' => [
                        'icon' => 'trello',
                        'title' => 'Logout',
                        'route_name' => 'logout',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],

                ];
            } elseif (Auth::user()->status == "admin") {
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Dashboard',
                        'route_name' => 'admin_dashboard',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],

                    'riwayat-pemasukan-anggota' => [
                        'icon' => 'hard-drive',
                        'route_name' => 'pemasukan',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Pemasukan Anggota'
                    ],

                    'riwayat-laporan-keuangan' => [
                        'icon' => 'hard-drive',
                        'route_name' => 'laporan',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Laporan Keuangan'
                    ],

                    'klaim-dana' => [
                        'icon' => 'hard-drive',
                        'route_name' => 'klaim_dana',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Klaim Dana'
                    ],
                    
                    'test' => [
                        'icon' => 'hard-drive',
                        'route_name' => 'point',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Point'
                    ],

                    'devider',

                    'anggota' => [
                        'icon' => 'trello',
                        'title' => 'Tambah Investor',
                        'route_name' => 'tambah_investor',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],

                    'Logout' => [
                        'icon' => 'trello',
                        'title' => 'Logout',
                        'route_name' => 'logout',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],

                ];
            }
        }
    }
}
