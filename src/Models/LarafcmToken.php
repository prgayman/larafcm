<?php

namespace Prgayman\LaraFcm\Models;

use Illuminate\Database\Eloquent\Model;

class LarafcmToken extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ["platform", "entity_type", "entity_id", "locale", "token"];
}
