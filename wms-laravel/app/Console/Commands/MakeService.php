<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Service file in Services Folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filesystem = new Filesystem();

        $name = $this->argument('name');
        $path = $this->getPath($name);

        $directory = dirname($path);

        if (! $filesystem->isDirectory($directory)) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        if ($filesystem->exists($path)) {
            $this->error("Service already exists: {$path}");
            return;
        }

        $stub = $this->getStub();
        $className = class_basename($name);
        $namespace = $this->getNamespace($name);

        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $className],
            $stub
        );

        $filesystem->put($path, $content);

        $this->info("Service created: {$path}");

    }

    private function getPath($name)
    {
        $name = str_replace('\\', '/', $name);
        return app_path("Services/{$name}.php");
    }

    private function getNamespace($name)
    {
        $name = str_replace('/', '\\', trim($name, '/'));
        return "App\\Services\\" . str_replace('/', '\\', dirname($name));
    }

    private function getStub()
    {
        return <<<EOT
<?php

namespace {{ namespace }};

class {{ class }}
{
    public function __construct()
    {
        //
    }
}

EOT;
    }

}
