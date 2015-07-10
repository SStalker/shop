<?php


use Illuminate\Database\Seeder;
/*use DB;*/
use App\Role;
use App\Permission;
use App\User;
use Carbon\Carbon;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $admin = new Role();
		$admin->name         = 'admin';
		$admin->display_name = 'User Administrator'; // optional
		$admin->description  = 'User is allowed to manage and edit other users'; // optional
		$admin->save();

		$user = User::where('name', '=', 'admin')->first();

		// or eloquent's original technique
		$user->roles()->attach($admin->id); // id only

		$createAccessBackend = new Permission();
		$createAccessBackend->name         = 'access-backend';
		$createAccessBackend->display_name = 'Access Backend'; // optional
		// Allow a user to...
		$createAccessBackend->description  = 'Right to see the Backend'; // optional
		$createAccessBackend->save();

		$admin->attachPermission($createAccessBackend);
    }
}
