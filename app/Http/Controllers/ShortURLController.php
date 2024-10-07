<?php

namespace App\Http\Controllers;

use App\Models\ShortURL;
use Illuminate\Http\Request;
use Str;

class ShortURLController extends Controller
{
    public function index()
    {
        $data_url = ShortURL::latest()->get();
        return view('home', compact('data_url'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string'
        ]);
        
        $url = $request->url;
        if (!preg_match('/^http(s)?:\/\//', $url)) {
            $url = 'https://' . $url;
        }

        $short_url = ShortURL::create([
            'url' => $url,
            'code' => Str::random(4),
        ]);

        session()->flash('shortened', route('shortened.url', $short_url->code));
        session()->flash('ori_url', $short_url->url);
        return redirect()->back()->with('success', 'Link berhasil dibuat!');
    }
    public function shortenedUrl($code)
    {
        $find = ShortURL::where('code', $code)->first();
        if (!$find) {
            return redirect('error-page');
        }
        return redirect($find->url);
    }

}