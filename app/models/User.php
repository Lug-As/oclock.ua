<?php


namespace app\models;


use app\models\app\AppModel;
use oclock\App;
use RedBeanPHP\R;

class User extends AppModel
{
	public $attributes = [
		'name' => '',
		'login' => '',
		'password' => '',
		'email' => '',
		'address' => ''
	];
	public $rules = [
		'required' => [
			['login'],
			['password'],
			['name'],
			['email'],
			['address']
		],
		'email' => [
			['email']
		],
		'lengthBetween' => [
			['password', 6, 50]
		],
		'lengthMax' => [
			['login', 100],
			['name', 100],
			['email', 100],
			['address', 150]
		]
	];

	public static function authentication()
	{
		App::$app->setProperty('user_id', 0);
		if (!key_exists('user_id', $_COOKIE) or !key_exists('user_hash', $_COOKIE)) {
			return false;
		}
		$id = $_COOKIE['user_id'];
		$hash = $_COOKIE['user_hash'];
		if (checkUserHash($id, $hash)) {
			User::cookie($id, $hash);
			App::$app->setProperty('user_id', $id);
			if (!key_exists('user', $_SESSION)) {
				$user = R::load('user', $id);
				$_SESSION['user'] = $user;
			}
			return true;
		} else {
			if (key_exists('user', $_SESSION)) {
				unset($_SESSION['user']);
			}
			User::uncookie();
			header("Refresh: 0");
			die;
		}
	}

	public static function cookie($id, $hash, $time = 3600 * 24 * 30)
	{
		setcookie('user_id', $id, time() + $time, "/");
		setcookie('user_hash', $hash, time() + $time, "/", null, false, true);
	}

	public static function uncookie()
	{
		self::cookie(false, false, -3600);
	}

	public function checkUnique()
	{
		$users = R::find('user', "`login` = ? OR `email` = ?", [
			$this->attributes['login'],
			$this->attributes['email'],
		]);
		if ($users) {
			foreach ($users as $user) {
				if ($this->attributes['login'] == $user->login) {
					$this->errors['unique'][] = "Такой логин уже занят";
				}
				if ($this->attributes['email'] == $user->email) {
					$this->errors['unique'][] = "Такой email уже занят";
				}
			}
			return false;
		}
		return true;
	}

	public function login($data, $isAdmin = false)
	{
		if (!isset($data['login']) or trim($data['login']) === "") {
			$this->errors[] = "Введите логин";
			return false;
		}
		if (!isset($data['password']) or trim($data['password']) === "") {
			$this->errors[] = "Введите пароль";
			return false;
		}
		$login = trim($data['login']);
		$password = $data['password'];
		if ($isAdmin) {
			$user = R::findOne('user', "`login` = ? AND `role` = 'admin'", [$login]);
		} else {
			$user = R::findOne('user', "`login` = ?", [$login]);
		}
		if (!$user) {
			$this->errors['login'][] = "Такого логина не существует";
			return false;
		}
		if (!password_verify($password, $user->password)) {
			$this->errors['password'][] = "Неверный пароль";
			return false;
		}
		$hash = generate_hash();
		$user->hash = $hash; // Обновляем
		$id = R::store($user); // и сохраняем хэш
		if ($id) {
			User::cookie($id, $hash);
			unset($user->password);
			$_SESSION['user'] = $user;
		}
		return true;
	}
}