@extends('mahasiswa.layout')
@section('content')
<div class="container mt-3">
        <h3 class="text-center mb-5">JURUSAN TEKNOLOGI INFORMASI - POLITEKNIK NEGERI MALANG</h3>
        <h2 class="text-center mb-4">KARTU HASIL STUDI (KHS)</h2>

        <br><br><br>

        <b>Nama &nbsp:</b> {{ $mhs->nama}}<br>
        <b>NIM &nbsp &nbsp : </b>{{ $mhs->nim}}<br>
        <b>Kelas &nbsp : </b> {{ $mhs->kelas->nama_kelas}}<br>

        <br>
        <table class="table table-bordered">
            <tr>
            <th>Matakuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
            </tr>
             @foreach ($mhs -> matakuliah as $item)
             <tr>
            <th scope="row">{{ $item -> nama_matkul }}</th>
            <td>{{ $item -> sks }}</td>
            <td>{{ $item -> semester }}</td>
            <td>{{ $item -> pivot -> nilai }}</td>
            </tr>
        @endforeach

            </table>
    </div>
@endsection 