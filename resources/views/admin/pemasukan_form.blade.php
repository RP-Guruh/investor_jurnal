@extends('../admin_layout/' . $layout)

@section('subhead')
    <title>CRUD Form - Icewall - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Form Layout</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form action="{{ url('/admin/pemasukan/process') }}" method="post">
                    @csrf
                    <div>
                        <label for="crud-form-1" class="form-label">ID Anggota</label>
                        <input name="id_anggota" id="crud-form-1" type="text" class="form-control w-full"
                            placeholder="{{ $id }}" readonly value="{{ $id }}">
                    </div>

                    <div class="mt-3">
                        <label for="crud-form-3" class="form-label">Nominal Pemassukan</label>
                        <div class="input-group">
                            <input name="nominal" id="crud-form-3" type="number" class="form-control"
                                placeholder="Nominal" aria-describedby="input-group-1">
                            <div id="input-group-1" class="input-group-text">Rupiah</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="crud-form-3" class="form-label">Tanggal Pemasukan</label>
                        <div class="input-group">
                            <input name="tgl_pemasukan" id="crud-form-3" type="date" class="form-control"
                                aria-describedby="input-group-1">

                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="crud-form-3" class="form-label">Keterangan (Jika ada / Opsional)</label>
                        <div class="input-group">
                            <textarea name="keterangan" id="crud-form-3" rows="10" class="form-control"
                                aria-describedby="input-group-1"></textarea>
                        </div>
                    </div>

                    <div class="text-right mt-5">
                        <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-primary w-24">Save</button>
                    </div>
                </form>

            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@section('script')

@endsection
