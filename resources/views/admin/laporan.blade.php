@extends('../admin_layout/' . $layout)

@section('subhead')
<title>File Laporan Pemasukan</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->

            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">File Laporan Keuangan</h2>

                </div>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto w-full">



                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <a style="background-color: #38a169" class="font-bold bg-blue-700 text-white btn btn-blue mb-6" href="{{ url('/admin/laporan/form') }}">Tambah
                            File Laporan</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        No.
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        ID File
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        Link
                                    </th>

                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        Tanggal Upload
                                    </th>

                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        Keterangan
                                    </th>

                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        Update
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        Hapus
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($laporan as $no => $item)
                                <tr>
                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $laporan->firstItem() + $no }}
                                        </p>
                                    </td>
                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->id_laporan }}
                                        </p>
                                    </td>
                                    <td class="border-b dark:border-dark-5">
                                        <a href="{{ $item->link }}" class="whitespace-no-wrap" style="color:blue; font-weight:bold; text-decoration:underline">
                                            Link File </a>
                                    </td>

                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ Carbon\Carbon::parse($item->tanggal_upload)->format('d-M-Y') }}
                                        </p>
                                    </td>

                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->keterangan }}
                                        </p>
                                    </td>

                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            <a href="{{url('admin/laporan/'.$item->id_laporan.'/edit')}}" style="background-color: #4299e1;" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                Edit
                                            </a>


                                        </p>
                                    </td>

                                    <td class="border-b dark:border-dark-5">
                                        <p class="text-gray-900 whitespace-no-wrap">

                                            <a href="{{url('admin/laporan/'.$item->id_laporan.'/delete')}}" style="background-color: #e53e3e;" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                Hapus
                                            </a>

                                        </p>
                                    </td>

                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                {{ $laporan->links() }}
            </div>

        </div>
    </div>

</div>
@endsection