<?php


use Illuminate\Database\Seeder;
/*use DB;*/
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

        // + normal user

        DB::table('users')->insert([
            'name' => 'normal',
            'email' => 'normal@mail.com',
            'password' => bcrypt('normal'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

		$user = User::where('name', '=', 'admin')->first();
		$user->roles()->attach(1); // id only
    }
}
