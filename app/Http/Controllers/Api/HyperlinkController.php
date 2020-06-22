<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Hyperlink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HyperlinkController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Hyperlink[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $hypes = [];

        $hyperlinks = Auth::check() ? Hyperlink::getOwnHyperlinks() : Hyperlink::getPublicHyperlinks();

        for ($x=0; $x<9; $x++) {
            $hypes[$x] = isset($hyperlinks[$x]) ? $hyperlinks[$x] : ['nullable' => true];
        }

        return $hypes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'color' => 'required',
        ]);

        $hyperlink = Hyperlink::create($request->all());

        if(Auth::check()) {
            $hyperlink->user_id = Auth::id();
        }

        $hyperlink->save();

    }

    /**
     * Display the specified resource.
     *
     * @param Hyperlink $hyperlink
     * @return Hyperlink
     */
    public function show(Hyperlink $hyperlink)
    {
        return $hyperlink;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Hyperlink $hyperlink
     * @return Hyperlink
     */
    public function update(Request $request, Hyperlink $hyperlink)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'color' => 'required',
        ]);

        $hyperlink->update($request->all());

        return $hyperlink;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hyperlink $hyperlink
     * @throws \Exception
     */
    public function destroy(Hyperlink $hyperlink)
    {
        $hyperlink->delete();
    }
}
