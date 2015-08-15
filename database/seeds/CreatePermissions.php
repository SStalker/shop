<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class CreatePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createAccessBackend = new Permission();
		$createAccessBackend->name         = 'access-backend';
		$createAccessBackend->display_name = 'Access Backend'; // optional
		$createAccessBackend->description  = 'Right to see the Backend'; // optional
		$createAccessBackend->save();

		$permOnArticles = new Permission();
		$permOnArticles->name         = 'access-articles';
		$permOnArticles->display_name = 'Access Articles'; // optional
		$permOnArticles->description  = 'Access to create/modify articles'; // optional
		$permOnArticles->save();

		$permOnCategories = new Permission();
		$permOnCategories->name         = 'access-categories';
		$permOnCategories->display_name = 'Access Categories'; // optional
		$permOnCategories->description  = 'Access to create/modify categories'; // optional
		$permOnCategories->save();

		$permOnPermissions = new Permission();
		$permOnPermissions->name         = 'access-permissions';
		$permOnPermissions->display_name = 'Access Permissions'; // optional
		$permOnPermissions->description  = 'Access to create/modify permissions and to change them on users'; // optional
		$permOnPermissions->save();

		$permOnRoles = new Permission();
		$permOnRoles->name         = 'access-roles';
		$permOnRoles->display_name = 'Access Roles'; // optional
		$permOnRoles->description  = 'Access to create/modify roles and to change them on users'; // optional
		$permOnRoles->save();

		$admin = Role::find(1);
		$admin->attachPermission($createAccessBackend);
    }
}
