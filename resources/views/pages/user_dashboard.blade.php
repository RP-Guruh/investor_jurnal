@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - Icewall - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Dashboard Laporan Keuangan | {{ $nama }},
                            Bergabung Pada {{ $tgl_gabung }}</h2>

                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="shopping-cart" class="report-box__icon text-theme-21"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                title="33% Higher than last month">
                                                Rupiah
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $jumlah_pendapatan }}</div>
                                    <div class="text-base text-gray-600 mt-1">Pendapatan Anda Saat Ini</div>
                                    <div class="text-sm text-gray-600 mt-1 font-bold">(Nominal Investasi + Pemasukan)</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="credit-card" class="report-box__icon text-theme-22"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-24 tooltip cursor-pointer"
                                                title="2% Lower than last month">
                                                Rupiah
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $nominal_investasi }}</div>
                                    <div class="text-base text-gray-600 mt-1">Nominal Investasi Anda</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="monitor" class="report-box__icon text-theme-23"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                title="12% Higher than last month">
                                                12% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $total_pemasukan }}</div>
                                    <div class="text-base text-gray-600 mt-1">Pemasukan Anda Saat Ini</div>
                                    <div class="text-sm text-gray-600 mt-1 font-bold">(Total Pemasukan - Total Klaim)</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user" class="report-box__icon text-theme-10"></i>

                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6"></div>
                                    <div class="text-base text-gray-600 mt-1">Total Dana Di Klaim</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BEGIN: Sales Report -->
                <div class="col-span-12 lg:col-span-12 mt-8">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Tabel Riwayat Pemasukan</h2>

                    </div>
                    <div class="intro-y box p-5 mt-12 sm:mt-5">
                     
                        <div class="report-chart">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">No.</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ID Pemasukan</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Tanggal</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($riwayat_pemasukan as $no => $item)
                                        <tr class="font-bold">
                                            <td class="border-b dark:border-dark-5">
                                                {{ $riwayat_pemasukan->firstItem() + $no }}</td>
                                            <td class="border-b dark:border-dark-5">{{ $item->id_pemasukan }}</td>
                                            <td class="border-b dark:border-dark-5">
                                                {{ Carbon\Carbon::parse($item->tanggal_pemasukan)->format('d - M - Y') }}
                                            </td>
                                            <td class="border-b dark:border-dark-5">
                                                {{ number_format($item->nominal, 2, ',', '.') }}</td>
                                        </tr>

                                    @empty
                                        <td class="border-b dark:border-dark-5">Data Not Found</td>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
