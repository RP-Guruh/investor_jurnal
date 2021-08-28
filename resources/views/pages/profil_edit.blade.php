@extends('../layout/' . $layout)

@section('subhead')
    <title>Regular Form - Icewall - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Form Edit Profil</h2>
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
                                    <input name="fullname" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->name }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Pekerjaan</label>
                                    <input name="pekerjaan" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->pekerjaan }}">
                                </div>

                                <div class=" mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Instansi</label>
                                    <input name="instansi" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->instansi }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Email Aktif</label>
                                    <input name="email" id="regular-form-2" type="email"
                                        class="form-control form-control-rounded" value="{{ $item->email }}">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">No.Whatsapp Aktif</label>
                                    <input name="wa" id="regular-form-2" type="text"
                                        class="form-control form-control-rounded" value="{{ $item->no_wa }}">
                                </div>



                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Password Lama </label>
                                    <input id="regular-form-2" type="text" class="form-control form-control-rounded"
                                        name="password_old">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Password Terbaru </label>
                                    <input id="regular-form-2" type="text" class="form-control form-control-rounded"
                                        name="password">
                                </div>

                                <div class="mt-3">
                                    <label for="regular-form-2" class="font-bold form-label">Foto Profil </label>
                                    <input id="regular-form-2" type="file" class="form-control form-control-rounded"
                                        name="foto">
                                </div>

                                <input type="submit" value="Update Data"
                                    class="mt-6 btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                            @endforeach

                        </form>

                    </div>

                </div>
            </div>

        </div>
    @endsection
