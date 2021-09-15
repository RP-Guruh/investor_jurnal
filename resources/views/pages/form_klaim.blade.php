@extends('../layout/' . $layout)

@section('subhead')
    <title>Form dana klaim</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Form Klaim Pemasukan</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
               <form action="{{ url('/klaim/process') }}" method="post">
                    @csrf
                    <div>
                        <label for="crud-form-1" class="form-label">Nominal Klaim ( Harus >= Jumlah Pemasukan )</label>
                        <input name="nominal_klaim" id="crud-form-1" type="text" class="form-control w-full" required>
                    </div>

            
                    <div class="mt-3">
                        <label for="crud-form-3" class="form-label">Keterangan (Jika ada / Opsional)</label>
                        <div class="input-group">
                            <textarea name="keterangan" id="crud-form-3" rows="10" class="form-control"
                                aria-describedby="input-group-1"></textarea>
                        </div>
                    </div>

                    <div class="text-right mt-5">
                        <a href="{{url('admin/laporan')}}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
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
