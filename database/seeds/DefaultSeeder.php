<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB as store;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        // Permissions.
        $permissions = [];
        require_once(public_path().'/install-scripts/permissions.php');

        foreach ($permissions as $item) {
            $check = \App\Permission::where('title', $item['title'])->where('id', $item['id'])->first();
            if ( ! $check ) {
            	\App\Permission::create($item);
        	}
        }

        // Roles.
        $roles = [];
        require_once(public_path().'/install-scripts/roles.php');
        foreach ($roles as $item) {
            $check = \App\Role::where('slug', $item['slug'])->where('id', $item['id'])->first();
            if ( ! $check ) {
            	\App\Role::create($item);
        	}
        }

        // Permission Roles.
        $permissions_roles = [];
        require_once(public_path().'/install-scripts/permission_role.php');

        if ( ! empty( $permissions_roles ) ) {
        	foreach ($permissions_roles as $item) {
        		store::table('permission_role')->insert( $item );
        	}
        }

        // Super admin.
        $row = [
            'slug' => $faker->md5('admin@admin.com'),
            'first_name' => 'Admin',
            'last_name' => 'A',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$g4AbYspO9kkOO5sopj/nve9TFtBMk9ZheTaKgyfnWwx00Uabb7qnK', //password
            'remember_token' => '',
            'skype_email' => $faker->unique()->word,
            'phone' => $faker->numberBetween(1000000000, 9999999999),
            
        ];

        $row['email_verified_at'] = $faker->dateTime;
        $row['status'] = 'Active';
        $user = \App\User::where('email', $row['email'])->first();
        if ( ! $user ) {
        	$user = \App\User::create($row);
        	$user->save();
    	}
    	$admin_id = $user->id;
		$user->role()->sync($contact_type);

        $user->save();

      installDefaultData( $admin_id, 'admin' );

    }
}
