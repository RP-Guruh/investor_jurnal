@extends('../admin_layout/' . $layout)

@section('subhead')
    <title>Investor Profil</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Detail Profil</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Input -->
            <div class="intro-y box">

                <div id="input" class="p-5">
                    <div class="preview">

                        <form action="{{ url('process/edit/profil') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @foreach ($user as $item)
                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Nama Lengkap</label>
                                    <input readonly name="fullname" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->name }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Pekerjaan</label>
                                    <input readonly name="pekerjaan" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->pekerjaan }}">
                                </div>

                                <div class=" mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Instansi</label>
                                    <input readonly name="instansi" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->instansi }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Email Aktif</label>
                                    <input readonly name="email" id="regular-form-2" type="email"
                                        class="form-control form-control-rounded" value="{{ $item->email }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">No.Whatsapp Aktif</label>
                                    <input readonly name="wa" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->no_wa }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Nominal Investasi</label>
                                    <input readonly name="wa" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->nominal_investasi }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Status</label>
                                    <input readonly name="wa" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->status }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Foto Profil </label>
                                    <img alt="Icewall Tailwind HTML Admin Template" class="w-32 h-32"
                                src="{{ asset('/foto/profil/'.$item->id.'/'. $item->name.'/'. $item->photo) }}">
                                </div>

                                <a href="{{url('/admin') }}" class="mt-6 btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"> Kembali </a>
                            @endforeach

                        </form>

                    </div>

                </div>
            </div>

        </div>
    @endsection
