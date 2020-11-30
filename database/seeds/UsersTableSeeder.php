<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // generate the first user
        $user = new \App\User;
        $user->email = 'john@johncarter.co.uk';
        $user->password = bcrypt('password');
        $user->active = 1;
        $user->company_name = 'JCWD';
        $user->save();
        $user->roles()->attach(1);


        // Not production show make a client, supplier and buyer
        if (App::environment(['local', 'staging'])) {

            // generate the client admin
            $user = new \App\User;
            $user->email = 'client@johncarter.co.uk';
            $user->password = bcrypt('password');
            $user->company_name = 'PartsWeb';
            $user->active = 1;
            $user->save();
            $user->roles()->attach(2);

            // generate a buyer
            $user = new \App\User;
            $user->email = 'buyer@johncarter.co.uk';
            $user->password = bcrypt('password');
            $user->company_name = 'John\'s Garage';
            $user->active = 1;
            $user->post_code = "CM21 9JX";
            $user->telephone = "07580 338557";
            $user->save();
            $user->roles()->attach(3);

            // generate a supplier
            $user = new \App\User;
            $user->email = 'sg12supplier@johncarter.co.uk';
            $user->password = bcrypt('password');
            $user->company_name = 'SG12 Supplier';
            $user->active = 1;
            $user->save();
            $user->roles()->attach(4);
            $user->setSupplierPostcodes('SG12');

            // generate a supplier
            $user = new \App\User;
            $user->email = 'cm21supplier@johncarter.co.uk';
            $user->password = bcrypt('password');
            $user->company_name = 'CM21 Supplier';
            $user->active = 1;
            $user->save();
            $user->roles()->attach(4);
            $user->setSupplierPostcodes('CM21');

            // generate a supplier
            $user = new \App\User;
            $user->email = 'cm21supplier2@johncarter.co.uk';
            $user->password = bcrypt('password');
            $user->company_name = 'CM21 Supplier 2';
            $user->active = 1;
            $user->save();
            $user->roles()->attach(4);
            $user->setSupplierPostcodes('CM21');

            // generate 
            $user = new \App\User;
            $user->email = 'tps@johncarter.co.uk';
            $user->password = bcrypt('password');
            $user->company_name = 'TPS Stortford';
            $user->active = 1;
            $user->save();
            $user->roles()->attach(4);
            $user->setSupplierPostcodes('CB1,CM17,IP26,SG8,PE27,EN11,CB10,CM18,IP27,SG9,PE28,CB11,CM19,IP28,SG10,CB21,CM20,IP29,SG11,CB22,CM21,SG12,CB23,CM22,SG13,CB24,CM23,SG14,CB25,CM24,SG19,CB3,CM6,CB4,CM7,CB5,CB6,CB7,CB8,CB9');
        }
    }
}
