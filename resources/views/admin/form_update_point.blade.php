@extends('../admin_layout/' . $layout)

@section('subhead')
<title>Form Update Point</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form Update Point</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            @forelse($point as $item)


            <h2 class="text-lg font-bold mb-6">Point Saat Ini : {{ $item->point }}</h2>

            <form action="{{ url('/admin/point/process') }}" method="post">
                @csrf
                <div>
                    <label for="crud-form-1" class="form-label">ID Anggota</label>
                    <input value="{{ $item->no_anggota }}" name="id" id="crud-form-1" type="text" class="form-control w-full" readonly>
                </div>

                @empty

                <h2 class="text-lg font-bold mb-6">Point Saat Ini : 0</h2>

                <form action="{{ url('/admin/point/process') }}" method="post">
                    @csrf
                    <div class="mb-6">
                        <label for="crud-form-1" class="form-label">ID Anggota</label>
                        <input value="{{ $id }}" name="id" id="crud-form-1" type="text" class="form-control w-full" readonly>
                    </div>

                    @endforelse


                    <div>
                        <label for="crud-form-1" class="form-label">Point update | Point akan dijumlahkan otomatis</label>
                        <input name="point" id="crud-form-1" type="text" class="form-control w-full" required>
                    </div>



                    <div class="text-right mt-5">
                        <a href="{{url('admin/')}}" class="btn btn-outline-secondary w-36 mr-1">Kembali ke menu utama</a>
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