<?php

namespace App\Http\Controllers;

use App\Hyperlink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HyperlinkController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }

        return view('hyperlinks.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function create()
    {
        $hyperlinks = 0;

        if (Auth::check()) {
            $hyperlinks = count(Hyperlink::getOwnHyperlinks());
        }
        else {
            $hyperlinks = count(Hyperlink::getPublicHyperlinks());
        }

        if($hyperlinks < 9)
            return view('hyperlinks.create');

        return abort(403, 'Unauthorized action.');
    }

    /**
     * @param Hyperlink $hyperlink
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit(Hyperlink $hyperlink)
    {
        if($hyperlink->user_id == null || $hyperlink->user_id == Auth::id()) {

            return view('hyperlinks.edit', compact('hyperlink'));

        }

        return abort(403, 'Unauthorized action.');
    }
}
