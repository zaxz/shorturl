<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use Illuminate\Http\Request;
use Str;

class ShortlinkController extends Controller
{
    public function index()
    {
        $shortlinks = Shortlink::latest()->get();
        return view('shortenlink',compact('shortlinks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'link'=>'required|url'
        ]);
        $input['link']=$request->link;
        $input['code']=Str::random(6);
        Shortlink::create($input);


        return redirect('generate-shorten-link')->withSuccess('berhasil');
    }
    public function shortenlink($code)
    {
        $find = Shortlink::where('code',$code)->first();
        if (!$find) {
            return redirect('error-page'); // Redirect ke halaman error jika tidak ditemukan
        }
        return redirect($find->link);

    }
    
}