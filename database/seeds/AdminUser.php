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
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'lastname' => 'Nicko',
            'firstname' => 'Nicki',
            'telephone' => '0123/45678',
            'birthday' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // + normal user

        DB::table('users')->insert([
            'username' => 'normal',
            'email' => 'normal@mail.com',
            'password' => bcrypt('normal'),
            'lastname' => 'Nicko',
            'firstname' => 'Nicki',
            'telephone' => '0123/45678',
            'birthday' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

		$user = User::where('username', '=', 'admin')->first();
		$user->roles()->attach(1); // id only
    }
}
