<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::loginView(function (Request $request) {
            //return Inertia::render('Auth/LoginPage');
            return inertia("Auth/LoginNet")->toResponse($request);
        });
        Fortify::registerView(function () {
            return Inertia::render('Auth/RegisterPage');
        });
        // Fortify::authenticateUsing(function (Request $request) {
        //     $user = User::where('email', $request->email)->first();
        //     Log::info('validation pass '.$user);
        //                     Jetstream::inertia()->whenRendering(
        //             '/admin/dashboard',
        //             function (Request $request, array $data) {
        //                 return array_merge($data, [
        //                     'token' => 'bacd'
        //                 ]);
        //             }
        //         );
        //     // if ($user && Hash::check($request->password, $user->password)) {
        //     //     Log::info('Has oke ');
        //     //     // $token = $user->createToken('snipperToken')->plainTextToken;
        //     //     // Jetstream::inertia()->whenRendering(
        //     //     //     '/admin/dashboard',
        //     //     //     function (Request $request, array $data) {
        //     //     //         return array_merge($data, [
        //     //     //             'token' => 'bacd'
        //     //     //         ]);
        //     //     //     }
        //     //     // );
        //     // }
        // });
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', __('Administrator'), [
            'create',
            'read',
            'update',
            'delete',
        ])->description(__('Administrator users can perform any action.'));

        Jetstream::role('editor', __('Editor'), [
            'read',
            'create',
            'update',
        ])->description(__('Editor users have the ability to read, create, and update.'));
    }
}
