<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $UserArray = array(array(1, 'yatri Rathod','yatrirathod20@gmail.com','User','$2y$10$5Bwt29ra6iIuS0U9mNo4lOlb030XpSajCKLxlC6UpgiIJVTU8JoU2'),
    		array(2, 'admin','admin@gmail.com','Admin','$2y$10$svpvOQJZkjec6gUepbzXAe.ZlSwXtKeaKGZu1lKCscbKKwLTNGjR.'));
        $UserNameArray = array();
		foreach ($UserArray as $key => $value) {
            $createArray = array();
            if(!in_array($value[1], $UserNameArray)){
            	array_push($UserNameArray, $value[1]);
	            $createArray['name']  = $value[1];
	            $createArray['email']  = $value[2];
	            $createArray['email_verified_at']  = '';
	            $createArray['user_type']  = $value[3];
	            $createArray['password']  = $value[4];
	            $createArray['remember_token']  = '';
	            
	            User::create($createArray);
            }
        }
    }
}
