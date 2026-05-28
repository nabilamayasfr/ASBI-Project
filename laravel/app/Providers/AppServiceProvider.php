<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Timezone untuk format tampilan tanggal
        Carbon::setLocale('id');
        
 
        date_default_timezone_set('Asia/Jakarta');
    }
}