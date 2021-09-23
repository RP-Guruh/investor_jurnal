@extends('../admin_layout/' . $layout)

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
                    <h2 class="text-lg font-medium truncate mr-5">Dasboard Al Kahfi</h2>

                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-theme-21"></i>
                                    <div class="ml-auto">
                                        Rupiah
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $jumlah_nominal }} </div>
                                <div class="text-base text-gray-600 mt-1">Dana Investor Terkumpul</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-10"></i>

                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $jumlah_investor }} </div>
                                <div class="text-base text-gray-600 mt-1">Jumlah Investor Terdaftar</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Daftar Investor Jurnal</h2>

                </div>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        No.
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"> ID Anggota
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"> Nama
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"> Nominal Investasi
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"> Tanggal Bergabung
                                    </th>

                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"> Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($user as $no => $item)
                                <tr>
                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->firstItem() + $no }}
                                        </p>
                                    </td>


                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->id_anggota }}
                                        </p>
                                    </td>

                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->name }}
                                        </p>
                                    </td>


                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->nominal_investasi }}
                                        </p>
                                    </td>

                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->tanggal_bergabung }}
                                        </p>
                                    </td>

                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            <a href="{{url('admin/investor/'.$item->id_anggota.'/detail')}}" style="background-color: #4299e1;" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                Detail
                                            </a>
                                            <a href="{{url('admin/investor/'.$item->id_anggota.'/delete')}}" style="background-color: red;" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                Hapus
                                            </a>
                                        </p>
                                    </td>


                                </tr>
                                @empty
                                <td class="border-b dark:border-dark-5">
                                    <p class="text-gray-900 whitespace-no-wrap">Belum ada investor</p>
                                </td>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $user->links() }}
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection