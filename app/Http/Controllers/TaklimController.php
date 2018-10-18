<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taklim;

class TaklimController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->nama) && isset($request->tanggal)) {
            if($request->tanggal == 'today')
                return Taklim::where('nama', 'like', "%{$request->nama}%")
                                ->where('tanggal', date('Y-m-d'))
                                ->get();
            elseif($request->tanggal == 'tomorrow')
                return Taklim::where('nama', 'like', "%{$request->nama}%")
                                ->where('tanggal', date("Y-m-d", strtotime("+1 day")))
                                ->get();
            elseif($request->tanggal == 'this_month')
                return Taklim::where('nama', 'like', "%{$request->nama}%")
                                ->where('tanggal', 'like', date('Y-m')."%")
                                ->get();
        }

        elseif (isset($request->id)) {
            return Taklim::where('id', 'like', "%{$request->id}%")
                                ->first();
        }
    	return Taklim::all();
    }

    public function myTaklim(Request $request)
    {
        if (isset($request->id_user)) {

        $datataklim = Taklim::where('id_user', 'like', "%{$request->id_user}%")
                        ->get();
                    }
            return $datataklim;
    }

    public function delete(Request $request)
    {
        Taklim::where('id', '=', $request->id)->delete();

    }

    public function store(Request $request)
    {
        $expl = explode(',', $request->pamflet);
        $decode = base64_decode($expl[1]);
        $exte='png';
        if(str_contains($expl[0],'png')){
            $exte = 'png';
        }else{
            $exte = 'jpg';
        }
        $filename = date('YmdHis').'.'.$exte;
        $filepath = public_path().'/images/'.$filename;
        file_put_contents($filepath, $decode);
        $fileurl = url('/images/'.$filename);

    	Taklim::create([
            'id_user' => $request->id_user,
            'alamat' => $request->alamat,
            'cp' => $request->cp,
            'htm' => $request->htm,
            'ket' => $request->ket,
            'nama' => $request->nama,
            'pelaksana' => $request->pelaksana,
            'pemateri' => $request->pemateri,
            'peserta' => $request->peserta,
            'pukul' => $request->pukul,
            'tanggal' => $request->tanggal,
            'tema' => $request->tema,
            'tempat' => $request->tempat,
            'pamflet' => $fileurl,
        ]);
    }

    public function update(Request $request)
    {
        $taklim = Taklim::find($request->id);

        if (!isset($request->pamflet)) {
            $taklim->update([
                'id_user' => $request->id_user,
                'alamat' => $request->alamat,
                'cp' => $request->cp,
                'htm' => $request->htm,
                'ket' => $request->ket,
                'nama' => $request->nama,
                'pelaksana' => $request->pelaksana,
                'pemateri' => $request->pemateri,
                'peserta' => $request->peserta,
                'pukul' => $request->pukul,
                'tanggal' => $request->tanggal,
                'tema' => $request->tema,
                'tempat' => $request->tempat,
            ]);
        } else{
            $expl = explode(',', $request->pamflet);
            $decode = base64_decode($expl[1]);
            $exte='png';
            if(str_contains($expl[0],'png')){
                $exte = 'png';
            }else{
                $exte = 'jpg';
            }
            $filename = date('YmdHis').'.'.$exte;
            $filepath = public_path().'/images/'.$filename;
            file_put_contents($filepath, $decode);
            $fileurl = url('/images/'.$filename);

            $taklim->update([
                // 'id_user' => $request->id_user,
                'alamat' => $request->alamat,
                'cp' => $request->cp,
                'htm' => $request->htm,
                'ket' => $request->ket,
                'nama' => $request->nama,
                'pelaksana' => $request->pelaksana,
                'pemateri' => $request->pemateri,
                'peserta' => $request->peserta,
                'pukul' => $request->pukul,
                'tanggal' => $request->tanggal,
                'tema' => $request->tema,
                'tempat' => $request->tempat,
                'pamflet' => $fileurl,
            ]);
        }
    }

    public function gambar(Request $request){
        // hashahsh return $request->all();
    }
}