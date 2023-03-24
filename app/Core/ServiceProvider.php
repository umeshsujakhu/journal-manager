<?php
namespace App\Core;
use App\Constants\Variables;
use Illuminate\Support\Facades\File;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Get providers from modules
     */
    protected function registerModulesProviders(){

        $modulePath = Variables::MODULE_PATH;
        if(!$modulePath){
            return;
        }
        $modules = array_map('basename',File::directories(app_path($modulePath)));

        foreach($modules as $module){
            //register serviceProvider class in the folder if it exists
            if(File::exists(app_path($modulePath.'/'.$module.'/ServiceProvider.php')) && class_exists('\App\\'.$modulePath.'\\'.$module.'\ServiceProvider')){
                $this->app->register('\App\\'.$modulePath.'\\'.$module.'\ServiceProvider');
            }
        }
    }

    public function register(){
        $this->registerModulesProviders();
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(){

    }
}
