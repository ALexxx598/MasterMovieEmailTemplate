<?php

namespace App\Providers;

use App\EmailDomain\Code\Service\CodeService;
use App\EmailDomain\Code\Service\CodeServiceInterface;
use Illuminate\Support\ServiceProvider;

class CodeServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->registerCodeService();
    }

    /**
     * @return void
     */
    private function registerCodeService(): void
    {
        $this->app->singleton(CodeServiceInterface::class, CodeService::class);
    }
}
