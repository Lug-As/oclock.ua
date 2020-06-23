<?php


namespace app\controllers;


use app\controllers\app\AppController;
use app\models\User;

class UserController extends AppController
{
	public function signupAction()
	{
		if (!empty($_POST)) {
			$user = new User();
			$data = $_POST;
			$user->load($data);
			if (!$user->validate($data) or !$user->checkUnique()) {
				$_SESSION['errors'] = $user->errors;
				$_SESSION['form_data'] = $user->attributes;
			} else {
				$user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
				$hash = generate_hash();
				$user->attributes['hash'] = $hash;
				$id = $user->save('user');
				if ($id) {
					User::cookie($id, $hash);
					$_SESSION['user'] = $user->attributes;
					redirect(PATH);
				} else {
					$_SESSION['errors'][] = "Произошла ошибка. Повторите попытку позже.";
				}
			}
			redirect();
		}
		$this->setMeta("Регистрация");
	}

	public function loginAction()
	{
		if (!empty($_POST)) {
			$user = new User();
			$data = $_POST;
			if ($user->login($data)) {
				redirect(PATH);
			} else {
				$_SESSION['errors'][] = $user->errors;
				$_SESSION['form_data'] = $data;
				redirect();
			}
		}
		$this->setMeta("Вход в аккаунт");
	}

	public function logoutAction()
	{
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		User::uncookie();
		redirect();
	}

}