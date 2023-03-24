<?php
namespace App\Domain\Journals;

use \Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider
 * @package App\Domain\Journals
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * @type bool
     */
    protected $defer = true;
    /**
     * Register your binding
     */
    public function register(){
        $this->app->bind('App\Domain\Journals\Interfaces\JournalInterface','App\Domain\Journals\Repositories\JournalRepository');
    }
}
