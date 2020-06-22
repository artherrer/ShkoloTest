<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Hyperlink extends Model
{
    protected $fillable = ['title', 'url', 'color', 'new_tab', 'user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public static function getOwnHyperlinks() {
        return Hyperlink::where('user_id', Auth::id())->get();
    }

    /**
     * @return mixed
     */
    public static function getPublicHyperlinks() {
        return Hyperlink::where('user_id', null)->get();
    }
}
