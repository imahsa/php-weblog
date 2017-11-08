<?php
namespace App\Models;

use Zardak\Model;
use Damev\Damev;

class User extends Model
{	
	private static $table = 'user';

	public static function createUser($user_name, $pass, $name, $bday, $avatar)
	{
		if((self::userNotExist($user_name))){
			Model::QueryOn(self::$table)
				->insert(
						array(
							'user_name' 	=> $user_name,
							'password' 		=> $pass,
							'name' 			=> $name,
							'birthday'		=> $bday,
							'avatar'		=>$avatar,
						)
					);
			return true;
		}
		else 
			//peygham user exist
			return false;
	}

	public static function userNotExist($user_name){
		$user = self::getByUserName($user_name);
		if($user == NULL)
			return true;
		else 
			return false;
	}

	public static function getByUserName($user_name){
		return Model::QueryOn(self::$table)
				-> where('user_name', $user_name)
				->first()
				->get();
	}

	public static function getNameById($id){
		$user = Model::QueryOn(self::$table)
				->where('id', $id)
				->first()
				->get();
		return $user ->getName();
	}


	public static function checkUser($user_name, $password)
	{
		return Model::QueryOn(self::$table)
			->where('user_name', $user_name)
			->where('password', $password)
			->first()
			->get();
	}

	public static function updateCookie($user_id, $cookie) {
		Model::QueryOn(self::$table)
			->where('id', $user_id)
			->update(array(
				'cookie' => $cookie,
			));
	}

	public static function isValidCookie($cookie) {
		if (!self::getUserByCookie($cookie))
			return true;
		return false;
	}

	public static function getUserByCookie($cookie) {
		return Model::QueryOn(self::$table)
			->where('cookie', $cookie)
			->first()
			->get();
	}
}