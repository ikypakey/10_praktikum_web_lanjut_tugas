@extends('mahasiswa.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('mahasiswa.update', $Mahasiswa->id_mahasiswa) }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Nim">NIM</label>
                        <input type="text" name="nim" class="form-control" id="Nim" value="{{ $Mahasiswa->nim }}"
                            aria-describedby="Nim">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="Nama" value="{{ $Mahasiswa->nama }}"
                            aria-describedby="Nama">
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Foto</label>
                        <input type="file" name="foto" class="form-control" id="Jurusan" ariadescribedby="Jurusan"
                            value="{{ $Mahasiswa -> foto }}">
                        <img width="150px" src="{{asset('storage/'.$Mahasiswa -> foto)}}"
                            alt="{{ $Mahasiswa -> foto }}">
                    </div>
                     <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <select class="form-control" name="kelas_id">
                        @foreach($kelas as $kls)
                           <option value="{{$kls->id}}" {{$Mahasiswa->kelas_id ==$kls->id ? 'selected' : '' }}>{{$kls->nama_kelas}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="Jurusan" name="jurusan" class="form-control" id="Jurusan"
                            value="{{ $Mahasiswa->jurusan }}" aria-describedby="Jurusan">
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Email</label>
                        <input type="varchar" name="email" class="form-control" value="{{ $Mahasiswa->email }}"  id="Email">
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Alamat</label>
                        <input type="varchar" name="alamat" value="{{ $Mahasiswa->alamat }}"  class="form-control" id="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $Mahasiswa->tanggal_lahir }}"  id="TanggalLahir">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection