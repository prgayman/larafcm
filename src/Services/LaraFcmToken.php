<?php

namespace Prgayman\LaraFcm\Services;

use Prgayman\LaraFcm\Exceptions\TokenException;
use Prgayman\LaraFcm\Models\LarafcmToken as ModelsLarafcmToken;

class LaraFcmToken
{

    /**
     * Firebase token
     * @var array
     */
    private array $tokens;

    /**
     * Platform tokne
     * @var string
     */
    private ?string $platform = null;

    /**
     * Model have tokne
     * @var
     */
    private $model = null;

    /**
     * Token localization
     */
    private ?string $locale = null;

    /**
     * Set tokens
     * @param array|string $tokens
     *
     * @return self
     */
    public function setTokens($tokens) : self
    {
        $this->tokens = is_array($tokens) ? $tokens : [$tokens];
        return $this;
    }

    /**
     * Set platform
     * @param string $platform
     *
     * @return self
     */
    public function setPlatform(string $platform) : self
    {
        $this->platform = $platform;
        return $this;
    }

    /**
     * Set model
     * @param  $model
     *
     * @return self
     */
    public function setModel($model) : self
    {
        if (!is_object($model)) {
            throw TokenException::modelInValid();
        }

        $this->model = $model;
        return $this;
    }

    /**
     * Set locale
     * @param string $locale
     *
     * @return self
     */
    public function setLocale(string $locale) : self
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * get locale
     *
     * @return string|null
     */
    public function getLocale():?string
    {
        return $this->locale;
    }

    /**
     * get object of model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * get platform
     *
     * @return string|null
     */
    public function getPlatform():?string
    {
        return $this->platform;
    }

    /**
     * get tokens
     *
     * @return array
     */
    public function getTokens():array
    {
        return $this->tokens;
    }

    /**
     * Store fcm tokens to database
     */
    public function store()
    {
        return ModelsLarafcmToken::storeTokens($this);
    }
    
    /**
     * Get token from database you can use filter by model or locale ot platform
     *
     * @param Illuminate\Database\Eloquent\Model|null $model
     * @param string|null $locale
     * @param string|null $platform
     *
     * @return array
     */
    public static function getDbTokens($model = null, ?string $locale = null, ?string $platform=null):array
    {
        if ($model && ! is_object($model)) {
            throw TokenException::modelInValid();
        }

        return ModelsLarafcmToken::where(function ($query) use ($model, $locale, $platform) {
            if ($locale) {
                $query->locale($locale);
            }
            if ($platform) {
                $query->platform($platform);
            }
            if ($model) {
                $query->modelType(get_class($model));
                $query->modelId($model->id);
            }
        })
        ->pluck('token')
        ->toArray();
    }
}
