@extends('../admin_layout/' . $layout)

@section('subhead')
<title>Riwayat Pemasukan</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->

            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Data Anggota</h2>

                </div>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto w-full">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        No.
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        ID Anggota
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        Nama
                                    </th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        Actions
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($user as $no => $item)
                                <tr>
                                    <td class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->firstItem() + $no }}
                                        </p>
                                    </td>
                                    <td class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->id_anggota }}
                                        </p>
                                    </td>
                                    <td class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->name }}
                                        </p>
                                    </td>
                                    <td class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            <a class="font-bold text-blue-800 btn btn-blue" href="{{ url('/admin/pemasukan/' . $item->id_anggota) }}">Riwayat
                                                Pemasukan</a>
                                        </p>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                {{ $user->links() }}
            </div>

        </div>
    </div>

</div>
@endsection