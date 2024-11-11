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
            'inputUrl' => 'required|string',
            'customUrl' => 'nullable|regex:/^\S*$/u'
        ]);
        $url = $request->inputUrl;
        $customUrl = $request->customUrl;
        $codeResult = $customUrl ? $customUrl : Str::random(4);

        if (ShortURL::where('code', $customUrl)->exists()) {
            return back()->withErrors(['customUrl' => 'Custom URL telah digunakan. Silakan pilih yang lain.'])->withInput();
        }
        if (!preg_match('/^http(s)?:\/\//', $url)) {
            $url = 'https://' . $url;
        }

        $short_url = ShortURL::create([
            'url' => $url,
            'code' => $codeResult,
        ]);

        session()->flash('shortened', route('shortened.url', $short_url->code));
        session()->flash('ori_url', $short_url->url);

        return redirect()->back()->with('success', 'Short URL berhasil dibuat!');
    }
    public function shortenedUrl($code)
    {
        $find = ShortURL::where('code', $code)->first();
        if (!$find) {
            return redirect('error');
        }
        return redirect($find->url);
    }

}