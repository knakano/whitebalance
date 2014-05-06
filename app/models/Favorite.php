<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 5/6/14
 * Time: 8:29 AM
 */

class Favorite extends Eloquent {

    protected $fillable = ["user_id", "favorite_id"];

    public function user() {
        return $this->belongsTo("User");
    }

} 