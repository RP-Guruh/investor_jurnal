@extends('../layout/' . $layout)

@section('subhead')
    <title>Profile - Icewall - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Profile Layout</h2>
    </div>
    <!-- BEGIN: Profile Info -->
    @foreach ($user as $item)
        <div class="intro-y box px-5 pt-5 mt-5">
            <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        @if ($item->photo)
                            <img alt="Icewall Tailwind HTML Admin Template" class="rounded-full"
                                src="{{ asset('storage/photo_profil/' . $item->photo) }}">
                        @else
                            <img alt="Icewall Tailwind HTML Admin Template" class="rounded-full"
                                src="{{ asset('dist/images/' . $fakers[0]['photos'][0]) }}">

                            <div
                                class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-theme-17 rounded-full p-2">
                                <i class="w-4 h-4 text-white" data-feather="camera"></i>
                            </div>
                        @endif



                    </div>
                    <div class="ml-5">
                        <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $item->name }}
                        </div>
                        <div class="text-gray-600">{{ $item->pekerjaan }}</div>
                        <div class="text-gray-600">{{ $item->instansi }}</div>
                        <a href="{{ url('/profil/edit/' . $item->id_anggota) }}"
                            class="mt-6 btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Edit Profil</a>
                    </div>


                </div>
                <div
                    class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">Bio Details</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">

                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="twitter" class="w-4 h-4 mr-2"></i> ID Anggota :
                            {{ $item->id_anggota }}
                        </div>

                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="twitter" class="w-4 h-4 mr-2"></i> Email :
                            {{ $item->email }}
                        </div>


                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="twitter" class="w-4 h-4 mr-2"></i> Whatsapp :
                            {{ $item->no_wa }}
                        </div>

                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="twitter" class="w-4 h-4 mr-2"></i> Nominal :
                            {{ $item->nominal_investasi }}
                        </div>

                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="twitter" class="w-4 h-4 mr-2"></i> Status : {{ $item->status }}
                        </div>

                        @if ($item->active == 0)
                            <h4 class="mt-8 font-bold">Harap lengkapi profil anda</h4>
                        @else
                    </div>
                </div>
            </div>
            <div class="intro-y tab-content mt-5">
                <div id="dashboard" class="tab-pane active" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="grid grid-cols-12 gap-6">
                        <!-- BEGIN: Top Categories -->
                        <div class="intro-y box col-span-12 lg:col-span-6">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Kartu Anggota Investor (Tampak
                                    Depan)</h2>

                            </div>
                            <div class="p-5">
                                <div class="flex flex-col sm:flex-row">


                                </div>

                                <img class="relative object-cover w-full h-full rounded-xl"
                                    src="{{ asset('dist/images/card_depan.png') }}">

                            </div>
                        </div>
                        <!-- END: Top Categories -->
                        <!-- BEGIN: Work In Progress -->
                        <div class="intro-y box col-span-12 lg:col-span-6">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Kartu Anggota Investor (Tampak
                                    Belakang)</h2>

                            </div>
                            <div class="p-5">
                                <div class="flex flex-col sm:flex-row">


                                </div>

                                <img class="relative object-cover w-full h-full rounded-xl"
                                    src="{{ asset('dist/images/card_depan.png') }}">

                            </div>
                        </div>
                        <!-- END: Work In Progress -->

                    </div>
                </div>
            </div>

    @endif
    </div>
    @endforeach

    <!-- END: Profile Info -->

@endsection
