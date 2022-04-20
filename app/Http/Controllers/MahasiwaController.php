<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mahasiwa;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Mahasiswa_Matakuliah;
use Illuminate\Support\Facades\Storage;
use PDF;




class MahasiwaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
     public function index()
    {
        //yang semulanya Mahasiswa::all menjadi mahasiswa with yang menyatakan relasi
        $mahasiswa = Mahasiwa::with('kelas')->get();
    
        // fungsi latest berfungsi untuk menampilkan berdasarkan data terakhir di input    
        $post = Mahasiwa::latest();
        // search berdasarkan nama atau nim
        if (request('search')) {
            $post->where('nama', 'like', '%' . request('search') . '%')->orWhere('nim','like','%' . request('search').'%');
        }

        //add pagination 
        return view('mahasiswa.index',[
            'mahasiswa' => $mahasiswa,
            'post' => $post -> paginate (5)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas=Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.create',['kelas'=>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data, fungsi untuk memanggil file create.blade untuk pemrosesan
     $validasi =  $request->validate([
            'nim' => 'required|digits_between:8,10|unique:mahasiswa,nim',
            'nama' => 'required|string',
            'foto'=> 'required',
            'kelas_id' => 'required',
            'jurusan' => 'required|string|max:25',
            'email' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required',
        ]);
        if ($request->file('foto')) {
            $validasi['foto'] = $request->file('foto')->store('images', 'public');
        }


        //  $mahasiswa = new Mahasiwa;
        //  $mahasiswa->nim=$request->get('nim');
        //  $mahasiswa->nama=$request->get('nama');
        //  $mahasiswa->jurusan=$request->get('jurusan');
        //  $mahasiswa->email=$request->get('email');
        //  $mahasiswa->alamat=$request->get('alamat');
        //  $mahasiswa->tanggal_lahir=$request->get('tanggal_lahir');
        //  $mahasiswa->save();
        
        //  $kelas = new Kelas;
        //  $kelas->id=$request->get('kelas_id');

        // //fungsi eloquent untuk menambah data
        //  $mahasiswa->kelas()->associate($kelas);
        //  $mahasiswa->save();

        Mahasiwa::create($validasi);

         //jika data berhasil ditambahkan, akan kembali ke halaman utama
         return redirect()->route('mahasiswa.index')
         ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  


     public function show( $id_mahasiswa)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
    
        $Mahasiswa = Mahasiwa::with('kelas')->where('id_mahasiswa',$id_mahasiswa)->first();

        return view('mahasiswa.detail', ['Mahasiswa' => $Mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id_mahasiswa)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
         $Mahasiswa=Mahasiwa::with('kelas')->where('id_mahasiswa',$id_mahasiswa)->first();
         $kelas=Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_mahasiswa)
    {
        //melakukan validasi data fungsi untuk memanggil file edit.blade untuk pemrosesan

        //memanggil data mahasiswa yang memiliki id_mahasiswa
    $dataMhs = Mahasiwa::find($id_mahasiswa); 

    $data= $request->validate([
            'nim' => 'required|digits_between:8,10',
            'nama' => 'required|string',
            'foto'=> 'required',
            'kelas_id' => 'required',
            'jurusan' => 'required|string|max:25',
            'email' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required',
        ]);
        // jika bernilai pada data mhs memiliki nilai, nantinya file yang ada di public dihapus dan tidak terjadi penumpukan file   

        if ($dataMhs->foto && file_exists(storage_path('app/public/' . $dataMhs->foto))) {
            Storage::delete('public/' . $dataMhs->foto);
        }
        $foto = $request->file('foto')->store('images', 'public');
        $data['foto'] = $foto;

        //fungsi eloquent untuk mengupdate data inputan kita
        //memanggil nama kolom dalam model mahasiswa yang sesuai dengan id mahasiswa yg di req
        Mahasiwa::where('id_mahasiswa', $id_mahasiswa)->update($data);


        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_mahasiswa)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiwa::where('id_mahasiswa',$id_mahasiswa)->delete();
        return redirect()->route('mahasiswa.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');  
    }
    public function nilai($id_mahasiswa)
    {
        $Mahasiswa = Mahasiwa::where('id_mahasiswa', $id_mahasiswa)->first();
        return view('mahasiswa.nilai', [
            'mhs' => $Mahasiswa,
        ]);

    }
    public function cetak_pdf($id_mahasiswa)
    {
        $ekspor = Mahasiwa::find($id_mahasiswa);
        $mhs = $ekspor;
        $pdf = PDF::loadview('mahasiswa.ekspor', compact('mhs'));
        return $pdf->stream();
    }


}
