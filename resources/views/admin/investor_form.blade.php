@extends('../admin_layout/' . $layout)

@section('subhead')
<title>Form Investor</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Tambah Investor Baru</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{ url('/admin/investor/process') }}" method="post">
                @csrf
                <div>
                    <label for="crud-form-1" class="form-label">Nama Investor</label>
                    <input name="nama" id="crud-form-1" type="text" class="form-control w-full" required>
                </div>


                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Nominal Investasi (Rupiah)</label>
                    <input name="nominal" id="crud-form-1" type="text" class="form-control w-full" required>
                </div>


                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Tanggal Bergabung</label>
                    <input name="tanggal_gabung" id="crud-form-1" type="date" class="form-control w-full" required>
                </div>

                <div class="mt-3">
                    <label for="crud-form-3" class="form-label">Email Investor Sementara </label>
                    <label for="crud-form-3" class="form-label">Hanya digunakan saat pertama kali investor login </label>

                    <div class="input-group">
                        <input name="email" id="crud-form-3" type="email" class="form-control" aria-describedby="input-group-1" required>

                    </div>
                </div>

                <div class="mt-3">
                    <label for="crud-form-3" class="form-label">Password Investor Sementara </label>
                    <label for="crud-form-3" class="form-label">Hanya digunakan saat pertama kali investor login </label>

                    <div class="input-group">
                        <input name="password" id="crud-form-3" type="text" class="form-control" aria-describedby="input-group-1" required minlength="8">
                    </div>
                </div>

                <div class="text-right mt-5">
                    <a href="{{url('admin/laporan')}}" class="btn btn-outline-secondary w-24 mr-1">Kembali</a>
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