<?php
/**
 * Created by PhpStorm.
 * User: Amar
 * Date: 1/2/2017
 * Time: 10:20 PM
 */

namespace App\Core\Commands;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Support\Pluralizer;
use Symfony\Component\Console\Input\InputArgument;

class GenerateModuleCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:module {name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new module';
    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    protected $moduleContainer;

    protected  $app;

    protected $_modulename;

    protected $_modulenamePlural;

    protected $namespacePrefix;

    protected $namespace;

    protected $stubPath;

    protected $modulePath;

    protected $moduleStubFiles = [
        'api.stub'=>['Routes',true,'none'],/// foldername,needs pluralization,prefixed/replaced/none
        'Interface.stub'=>['Interfaces',false,'prefixed'],
        'Controller.stub'=>['Controllers',true,'prefixed'],
        'Repository.stub'=>['Repositories',false,'prefixed'],
        'Request.stub'=>['Requests',false,'prefixed'],
        'CreateRequest.stub'=>['Requests',false,'prefixed'],
        'UpdateRequest.stub'=>['Requests',false,'prefixed'],
        'DeleteRequest.stub'=>['Requests',false,'prefixed'],
        'Model.stub'=>['Entities',false,'replaced'],
        'ServiceProvider.stub'=>['',false,'none'],
        'web.stub'=>['Routes',false,'none']
    ];

    public function __construct(Filesystem $files, Application $application)
    {
        parent::__construct();
        $this->files = $files;
        $this->app = $application;
        $this->moduleContainer = 'Domain';
        $this->namespacePrefix ='\App\\'.$this->moduleContainer;
        $this->stubPath = realpath(__DIR__ . "/../Stubs/")."/";
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->makeModule();
    }

    public function handle(){
        $this->fire();
    }

    /**
     * Generate the desired migration.
     */
    protected function makeModule()
    {
        $name = ucfirst($this->argument('name'));
        $this->_modulename = Pluralizer::singular($name);
        $this->_modulenamePlural = Pluralizer::plural($name);
        $this->namespace = $this->namespacePrefix . "\\".$this->_modulenamePlural;

        if ($this->files->exists($this->modulePath = $this->getPath($this->_modulenamePlural))) {
            $this->error('Module ' . $name . '  already exists!');
            return;
        }
        $this->copyModuleStructureFromStubs();
        $this->info("Module $name successfully generated");

    }

    protected function copyModule(){
        if (!$this->files->isDirectory(dirname($this->modulePath))) {
            $this->files->makeDirectory(dirname($this->modulePath), 0777, true, true);
        }

        $this->files->copyDirectory(realpath($this->stubPath."Module"),$this->modulePath);
        $this->generateCodeFromStubs();
    }

    /**
     * Build the directory for the class if necessary.
     */
    protected function copyModuleStructureFromStubs()
    {
        $this->copyModule();
    }

    /**
     * Generate Cod from stubs
     */
    protected function generateCodeFromStubs(){
        foreach ($this->moduleStubFiles as $stubName=> $stubConfig){
            list($foldername,$plural,$action) = $stubConfig;
            $this->generateCodeFromStubFile($stubName,$foldername,$plural,$action);
        }
    }

    /**
     * @param $stubName
     * @param $foldername
     * @param $plural
     * @param $action
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function generateCodeFromStubFile($stubName,$foldername,$plural,$action){
        $stubPath = $this->stubPath.$stubName;
        $destination = $this->modulePath. "/".$foldername;
        $stub = $this->files->get($stubPath);
        //replace the placeholders in the stubs
        $name  = $plural?$this->_modulenamePlural:$this->_modulename;
        $stub = str_replace("{{routemodule}}",strtolower($this->_modulenamePlural),$stub);
        $stub = str_replace("{{module}}",$this->_modulenamePlural,$stub);
        $stub = str_replace("{module}",$this->_modulename,$stub);
        $stub = str_replace("{moduleContainer}",$this->moduleContainer,$stub);
        $filename = str_replace(".stub",".php",$stubName);
        switch ($action){
            case 'prefixed':
                $filename = $name.$filename;
                break;
            case "replaced":
                $filename = $name.".php";
                break;
        }
        $this->files->put($destination."/".$filename,$stub);
    }

    /**
     * Get the path to where we should store the migration.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        return app_path($this->moduleContainer . "/". $name);
    }

    /**
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the module'],
        ];
    }
}
