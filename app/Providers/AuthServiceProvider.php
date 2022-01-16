<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

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

        if (Schema::hasTable('permissions')){
            $data['permissions'] = Permission::get();
            if(isset($data['permissions'])){
                foreach (  $data['permissions'] as $permission) {
                    $ability = $permission->key;
                    Gate::define($ability, function ($auth) use ($ability){
                        return $auth->hasAbility($ability);
                    });
                }
            }
        }


    }
}
