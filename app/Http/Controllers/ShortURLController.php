<?php

namespace App\Http\Controllers;

use App\Models\ShortURL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ShortURLController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $userID = Auth::user()->id;
            $data_url = ShortURL::where('user_id', $userID)->latest()->get();
        } else {
            $data_url = ShortURL::latest()->get();
        }

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
        $userID = Auth::check() ? Auth::user()->id : null;

        if (ShortURL::where('code', $customUrl)->exists()) {
            return back()->withErrors(['customUrl' => 'Custom URL telah digunakan. Silakan pilih yang lain.'])->withInput();
        }
        if (!preg_match('/^http(s)?:\/\//', $url)) {
            $url = 'https://' . $url;
        }

        $short_url = new ShortURL();
        $short_url->url = $url;
        $short_url->code = $codeResult;
        $short_url->user_id = $userID;

        $short_url->save();

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

    public function edit($id)
    {

    }

    public function delete($id)
    {
        $find = ShortURL::findOrFail($id);
        $find->delete();
        return redirect()->back();
    }

}