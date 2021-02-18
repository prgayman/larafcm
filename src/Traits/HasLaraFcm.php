<?php
namespace Prgayman\LaraFcm\Traits;

use Prgayman\LaraFcm\Services\LaraFcmToken;

trait HasLaraFcm
{

    /**
     * Get token from database you can use filter by locale ot platform
     *
     * @param string|null $locale
     * @param string|null $platform
     *
     * @return array
     */
    public function larafcmGetTokens(?string $locale = null, ?string $platform=null):array
    {
        return LaraFcmToken::getDbTokens($this, $locale, $platform);
    }

    public function larafcmStoreTokens($tokens, ?string $locale = null, ?string $platform)
    {
        return (new LaraFcmToken)
        ->setTokens($tokens)
        ->setPlatform($platform)
        ->setLocale($locale)
        ->setModel($this)
        ->store();
    }
}
