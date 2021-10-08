@extends('../admin_layout/' . $layout)

@section('subhead')
<title>CRUD Form - Icewall - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form Edit Laporan</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{ url('/admin/laporan/update') }}" method="post">
                @csrf
                @foreach($laporan as $item)
                <div>
                    <label for="crud-form-1" class="form-label">ID Laporan</label>
                    <input name="id_laporan" readonly value="{{ $item->id_laporan }}" id="crud-form-1" type="text" class="form-control w-full" required>
                </div>

                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Link File Laporan</label>
                    <input name="link_file" value="{{ $item->link }}" id="crud-form-1" type="text" class="form-control w-full" required>
                </div>

                <div class="mt-3">
                    <label for="crud-form-3" class="form-label">Tanggal Pemasukan</label>
                    <div class="input-group">
                        <input name="tgl_laporan" value="{{ $item->tanggal_upload }}" id="crud-form-3" type="date" class="form-control" aria-describedby="input-group-1" required>

                    </div>
                </div>

                <div class="mt-3">
                    <label for="crud-form-3" class="form-label">Keterangan (Jika ada / Opsional)</label>
                    <div class="input-group">
                        <textarea name="keterangan" id="crud-form-3" rows="10" class="form-control" aria-describedby="input-group-1"> {{ $item->keterangan }} </textarea>
                    </div>
                </div>
                @endforeach


                <div class="text-right mt-5">
                    <a href="{{url('admin/laporan')}}" class="btn btn-outline-secondary w-24 mr-1">Kembali</a>
                    <button type="submit" class="btn btn-primary w-24">Update</button>
                </div>
            </form>

        </div>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection

@section('script')

@endsection