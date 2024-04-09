<?php

namespace App\Providers;

use App\Models\Tahun;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        $this->cekTahun();
    }

    private function cekTahun(){
        $tahun = Tahun::where('tahun', date('Y'))->first();
        if (!$tahun) {
            Tahun::create(['tahun' => date('Y')]);
        }
    }
}
