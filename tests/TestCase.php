<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp(){
        parent::setUp();
        \Artisan::call('migrate');
    }

    public function tearDown(){
        \Artisan::call('migrate:reset');
        DB::disconnect();
        parent::tearDown();
    }

    /**
     * Emulate logged in user
     *
     * @param string $email
     *
     * @return \App\User|null
     */
    public function beUser($email) {
        /** @var \App\User $user */
        $user = \App\User::query()->where('email', $email)->first();
        $this->be($user);

        return $user;
    }
}
