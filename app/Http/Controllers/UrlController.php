<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UrlShort;
use Illuminate\Http\Request;
use App\Http\Requests\Shortend;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UrlController extends BaseController
{
    public function index()
    {
        // Get the short URLs with counts for the user
        $shortUrls = UrlShort::where('user_id', Auth::user()->id)
            ->get();

        return view('dashboard.url', compact('shortUrls'));
    }

    public function shortend(Shortend $request)
    {
        $uniqueShortUrl = $this->generateShortUrl();

        while (true) {
            if (DB::table('url_short')->where('short_url', $uniqueShortUrl)->exists()) {
                // The short URL is not unique, generate a new one
                $uniqueShortUrl = $this->generateShortUrl();
            } else {
                // The short URL is unique, break the loop
                break;
            }
        }

        // Create a new user
        $url = new UrlShort([
            'long_url' => $request->input('long_url'),
            'short_url' => $uniqueShortUrl,
            'user_id' => Auth::user()->id
        ]);

        $url->save();

        // Flash a success message to the session
        session()->flash('success', 'Short Url Generated Successfully');

        // Redirect to a success page or another appropriate page
        return redirect('/short'); // Redirect to the login page or another route
    }

    public function visit($short_url)
    {
        if (empty($short_url)) {
            abort(404);
        }

        $shortUrl = UrlShort::where('short_url', $short_url)->first();

        if (!$shortUrl) {
            abort(404);
        }

        $shortUrl->increment('count');

        return redirect()->to($shortUrl->long_url);
    }

    public function delete($id)
    {
        // Find the short URL belonging to the user
        $shortUrl = UrlShort::where('user_id', Auth::user()->id)
            ->find($id);

        if (!$shortUrl) {
            abort(404); // Short URL not found
        }

        // Delete the short URL
        $shortUrl->delete();

        // Redirect back with a success message or perform other actions
        return redirect('/short')->with('success', 'Short URL deleted successfully.');
    }

    private function generateShortUrl($length = 6): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $shortUrl = '';

        for ($i = 0; $i < $length; $i++) {
            $shortUrl .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $shortUrl;
    }
}
