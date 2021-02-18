<?php

namespace Prgayman\LaraFcm\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Prgayman\LaraFcm\Services\LaraFcmToken as ServicesLaraFcmToken;

class LarafcmToken extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ["platform", "model_type", "model_id", "locale", "token"];

    public static function storeTokens(ServicesLaraFcmToken $laraFcmToken):bool
    {
        try {
            $model = $laraFcmToken->getModel();
            $platform = $laraFcmToken->getPlatform();
            $locale = $laraFcmToken->getLocale();
            foreach ($laraFcmToken->getTokens() as $token) {
                $modelToken = static::findByToken($token);
                if (!$modelToken) {
                    $modelToken = new static;
                    $modelToken->token = $token;
                }
                $modelToken->model_type = $model ? get_class($model):null;
                $modelToken->model_id = optional($model)->id;
                $modelToken->platform = $platform;
                $modelToken->locale = $locale;
                $modelToken->save();
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function scopePlatform($query, string $platform)
    {
        $query->where('platform', $platform);
    }

    public function scopeLocale($query, string $locale)
    {
        $query->where('locale', $locale);
    }

    public function scopeModelType($query, string $model_type)
    {
        $query->where('model_type', $model_type);
    }

    public function scopeModelId($query, string $model_id)
    {
        $query->where('model_id', $model_id);
    }

    public static function findByToken(string $token)
    {
        return static::whereToken($token)
        ->first();
    }
}
