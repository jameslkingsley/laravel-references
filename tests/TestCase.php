<?php

namespace Kingsley\References\Test;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;
use Orchestra\Testbench\Traits as OrchestraTrait;
use Kingsley\References\ReferencesServiceProvider;

abstract class TestCase extends Orchestra
{
    use OrchestraTrait\WithLaravelMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->loadLaravelMigrations(['--database' => 'sqlite']);
        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [
            ReferencesServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('app.env', 'testing');

        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => ''
        ]);

        $config = include __DIR__.'/../config/references.php';
        $app['config']->set('references', $config);
    }

    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('test_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('Example');
            $table->timestamps();
        });

        include_once __DIR__.'/../database/migrations/create_references_table.php';
        (new \CreateReferencesTable)->up();
    }
}
