<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateExternalApiFileCommand extends Command
{
    /**
     * @const string dir Infrastructure path
     */
    const EXTERNALAPI_PATH = 'packages/Infrastructure/ExternalApi/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:externalApi {externalApi : name of externalApi name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create externalApi files';
    private $externalApi;
    private $externalApiDirectory;
    private $externalApiInterfaceFileName;
    private $externalApiFileName;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->externalApi          = $this->argument('externalApi');
        $this->externalApiDirectory = self::EXTERNALAPI_PATH.$this->externalApi.'/';

        if (is_null($this->externalApi)) {
            $this->error('Name invalid');
        }

        if (!$this->isExistDirectory($this->externalApiDirectory)) {
            $this->createDirectory($this->externalApiDirectory);
        }

        $this->externalApiInterfaceFileName = $this->externalApiDirectory.$this->externalApi.'ExternalApiInterface.php';
        $this->externalApiFileName = $this->externalApiDirectory.$this->externalApi.'ExternalApi.php';

        if ($this->isExistFiles()) {
            $this->error('already exist');
            return;
        }

        $this->createExternalApiInterface();
        $this->createExternalApiFile();

        $this->info('create successfully');
        $this->line('');
        $this->comment('Add the following route to app/Providers/ExternalApiServiceProvider.php:');
        $this->line('');
        $this->info("    \$this->app->bind(
            \\packages\\Infrastructure\\ExternalApi\\$this->externalApi\\$this->externalApi". "ExternalApiInterface::class,
            \\packages\\Infrastructure\\ExternalApi\\$this->externalApi\\$this->externalApi". "ExternalApi::class
        );");
        $this->line('');
    }

    /**
     * externalApiyのfileを作成する
     * @return void
     */
    private function createExternalApiFile(): void
    {
        $content = "<?php\n\nnamespace packages\\Infrastructure\\ExternalApi\\$this->externalApi;\n\nclass $this->externalApi" . "ExternalApi implements $this->externalApi" . "ExternalApiInterface\n{\n}\n";
        file_put_contents($this->externalApiFileName, $content);
    }

    /**
     * @return void
     */
    private function createExternalApiInterface(): void
    {
        $content = "<?php\n\nnamespace packages\\Infrastructure\\ExternalApi\\$this->externalApi;\n\ninterface $this->externalApi" . "ExternalApiInterface\n{\n\n}\n";
        file_put_contents($this->externalApiInterfaceFileName, $content);
    }

    /**
     * 同名fileの確認
     * @return bool
     */
    private function isExistFiles(): bool
    {
        return file_exists($this->externalApiInterfaceFileName)
            || file_exists($this->externalApiFileName);
    }

    /**
     * directoryの存在確認
     * @return bool
     */
    private function isExistDirectory($directory): bool
    {
        return file_exists($directory);
    }

    /**
     * 指定名でdirectoryの作成
     * @return void
     */
    private function createDirectory($directory): void
    {
        mkdir($directory, 0755, true);
    }
}