<?php

namespace Longman\TelegramBot;

use Illuminate\Support\ServiceProvider;
use Longman\TelegramBot\Telegram;

class TelegramServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config-bot.php' => config_path('config-bot.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Telegram::class, function ($app) {
            $telegram = new Telegram(
                config('config-bot.api_key'),
                config('config-bot.bot_username')
            );
           $telegram->setUploadPath(config('config-bot.upload_path'));
           $telegram->setDownloadPath(config('config-bot.download_path'));
           return $telegram;
        });
    }
}
