@extends('dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Departemen</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Departemen</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('departemen.update',$departemen->id)}}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-wight-bold">Nama Departemen</label>
                                    <input type="text" class="form-control" 
                                    name="nama_departemen"  
                                    placeholder="Masukkan Nama Departemen">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-wight-bold">Nama Manager</label>
                                    <input type="text" class="form-control"
                                    name="nama_manager"  placeholder="Masukkan Nama Manager">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Jumlah Pegawai</label>
                                    <input type="number" class="form-control"
                                    name="jumlah_pegawai" 
                                    placeholder="Masukkan Jumlah Pegawai">                               
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md-btn-primary">SIMPAN</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection