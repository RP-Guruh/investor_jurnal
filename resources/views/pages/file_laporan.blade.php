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
                        <h2 class="text-lg font-medium truncate mr-5">Tabel Laporan Keuangan</h2>

                    </div>
                    <div class="intro-y box p-5 mt-12 sm:mt-5">
                     
                        <div class="report-chart">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">No.</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ID Laporan</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Tanggal Upload</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Link Laporan</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Keterangan</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporan as $no => $item)
                                        <tr class="font-bold">
                                            <td class="border-b dark:border-dark-5">
                                                {{ $laporan->firstItem() + $no }}</td>
                                            <td class="border-b dark:border-dark-5">{{ $item->id_laporan }}</td>
                                            <td class="border-b dark:border-dark-5">
                                                {{ Carbon\Carbon::parse($item->tanggal_upload)->format('d F Y') }}
                                            </td>
                                            <td class="border-b dark:border-dark-5"><a href="{{$item->link}}" target="_BLANK">Link Laporan</a></td>
                                            <td class="border-b dark:border-dark-5">{{ $item->keterangan }}</td>
                                            
                                        </tr>

                                    @empty
                                        <td class="border-b dark:border-dark-5">Data Not Found</td>
                                    @endforelse


                                </tbody>
                            </table>
                           
                        </div>
                      
                    </div>
                    <br>
                    {{ $laporan->links() }}
                </div>

            </div>
        </div>

    </div>
@endsection
