<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Extensions\DatabaseSessionHandler;
use Session; //세션 사용을 위해 파사드 추가.
use DB; //DB 파사드 추가.

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Session::extend('custom_session', function ($app) {
			$table   = config('session.table');
			$minutes = config('session.lifetime');

			return new DatabaseSessionHandler($this->getDatabaseConnection(), $table, $minutes, $app);
		});
    }
	
	protected function getDatabaseConnection()
	{
		$connection = config('session.connection');

		return DB::connection($connection);
	}
}
