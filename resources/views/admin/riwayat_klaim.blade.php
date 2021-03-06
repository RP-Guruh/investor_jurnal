@extends('../layout/' . $layout)

@section('subhead')
<title>Laporan Keuangan</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
            </div>
        </div>

        <!-- BEGIN: Sales Report -->
        <div class="col-span-12 lg:col-span-12 mt-8">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Riwayat Klaim Dana Investor</h2>

            </div>

            <h2 class="text-sm font-medium truncate mr-5 mt-2">Diurutkan dari data terbaru</h2>
            <div class="intro-y box p-5 mt-12 sm:mt-5">

                <div class="report-chart">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">No.</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ID Anggota</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nama Anggota</th>

                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ID Klaim</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Tanggal Klaim</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Nominal</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Keterangan</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($klaim as $no => $item)
                            <tr class="font-bold">
                                <td class="border-b dark:border-dark-5">
                                    {{ $klaim->firstItem() + $no }}
                                </td>
                                <td class="border-b dark:border-dark-5">{{ $item->id_anggota }}</td>
                                <td class="border-b dark:border-dark-5">{{ $item->nama }}</td>

                                <td class="border-b dark:border-dark-5">{{ $item->id_klaim }}</td>
                                <td class="border-b dark:border-dark-5">
                                    {{ Carbon\Carbon::parse($item->tanggal_klaim)->format('d F Y') }}
                                </td>
                                <td class="border-b dark:border-dark-5">{{ $item->nominal }}</td>
                                <td class="border-b dark:border-dark-5">{{ $item->keterangan }}</td>
                                <td class="border-b dark:border-dark-5">{{ $item->status }}</td>
                                <td class="border-b dark:border-dark-5"> <a href="{{url('/admin/klaim/'.$item->id_klaim)}}" class="btn btn-success w-30">Setujui Klaim</a></td>

                            </tr>

                            @empty
                            <td class="border-b dark:border-dark-5">Tidak ada data</td>
                            @endforelse


                        </tbody>
                    </table>

                </div>

            </div>

            {{ $klaim->links() }}
        </div>

    </div>
</div>

</div>
@endsection