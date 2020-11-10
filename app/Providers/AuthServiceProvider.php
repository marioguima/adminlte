<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\Permission;
use App\Models\User;
use App\Policies\CampaignPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Campaign::class => CampaignPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-campaign', function (User $user, Campaign $campaign) {
        //     return $user->id === $campaign->user_id;
        // });

        $permissions = Permission::with('roles')->get();
        foreach ($permissions as $permission) {
            // dd($permission);
            Gate::define($permission->name, function (User $user) use ($permission){
                $permissionParam = Permission::findOrFail($permission->id);
                return $user->hasPermission($permissionParam);
            });
        }

        Gate::before(function(User $user, $ability) {
            if ( $user->hasAnyRoles('admin') )
                return true;
        });
    }
}
