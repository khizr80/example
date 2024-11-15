<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class SetupRolesAndPermissions extends Command
{
    protected $signature = 'setup:roles-permissions';
    protected $description = 'Setup initial roles and permissions for admin and user';

    public function handle()
    {
        // Create or find roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'writer']);
        $this->info('Roles created or found: admin, user');

        // Create permissions
        $editUsersPermission = Permission::firstOrCreate(['name' => 'edit ']);
        $viewProfilePermission = Permission::firstOrCreate(['name' => 'add']);
        $this->info('Permissions created or found: edit users, view profile');

        // Assign permissions to roles
        $adminRole->givePermissionTo($editUsersPermission, $viewProfilePermission); // Admin has all permissions
        $userRole->givePermissionTo($viewProfilePermission); // User only has view profile permission
        $this->info('Permissions assigned to roles');

        // Assign roles based on the `role` column in the users table
        User::where('role', 'admin')->each(function ($user) use ($adminRole) {
            $user->assignRole($adminRole);
            $this->info('Admin role assigned to user with ID ' . $user->id);
        });

        User::where('role', 'user')->each(function ($user) use ($userRole) {
            $user->assignRole($userRole);
            $this->info('User role assigned to user with ID ' . $user->id);
        });

        $this->info('Setup completed.');
    }
}
