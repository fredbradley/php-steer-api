<?php

namespace FredBradley\PhpSteerApi;

use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Saloon\CachePlugin\Data\CachedResponse;
use Saloon\CachePlugin\Drivers\FlysystemDriver;

class Cache
{
    public static function fileSystem(): Filesystem
    {
        return new Filesystem(
            new LocalFilesystemAdapter(
                __DIR__ . '/../cache'
            )
        );
    }

    public static function driver(): FlysystemDriver
    {
        self::purgeExpired();
        return new FlysystemDriver(
            self::fileSystem()
        );
    }

    public static function purgeExpired(): void
    {
        $array = self::fileSystem()
            ->listContents("")
            ->filter(function ($attributes) {
                $file = self::fileSystem()->read($attributes->path());
                $cachedResponse = unserialize($file);
                if ($cachedResponse instanceof CachedResponse) {
                    return $cachedResponse->hasExpired();
                } else {
                    return false;
                }
            })
            ->toArray();

        foreach ($array as $file) {
            self::fileSystem()->delete($file->path());
        }

    }
}
