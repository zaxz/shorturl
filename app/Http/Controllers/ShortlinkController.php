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
        return view('home',compact('shortlinks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'link'=>'required|url'
        ]);
        $shortLink = ShortLink::create([
            'link' => $request->link,
            'code' => Str::random(6), // Misalnya, buat kode acak
        ]);

        session()->flash('success', 'Link pendek Anda: ' . route('shorten.link', $shortLink->code));
        session()->flash('shortlink', route('shorten.link', $shortLink->code));
        return redirect()->back()->with('success', 'Link berhasil dibuat!');
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