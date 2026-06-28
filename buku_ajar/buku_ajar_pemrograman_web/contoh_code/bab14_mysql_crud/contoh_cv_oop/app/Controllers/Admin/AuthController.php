<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\AuthModel;
use App\Support\Request;
use App\Support\Url;

class AuthController extends Controller
{
    private AuthModel $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function loginForm(): void
    {
        if ($this->authModel->isLoggedIn()) {
            $this->redirect(Url::admin('index.php'));
        }

        $error = '';
        if (Request::isPost()) {
            $username = Request::postString('username');
            $password = Request::postString('password');

            if ($username === '' || $password === '') {
                $error = 'Username dan password wajib diisi.';
            } elseif ($this->authModel->attemptLogin($username, $password)) {
                $this->redirect(Url::admin('index.php'));
            } else {
                $error = 'Username atau password salah.';
            }
        }

        $this->render('admin/login', [
            'error' => $error,
            'username' => Request::postString('username'),
        ]);
    }

    public function logout(): void
    {
        $this->authModel->logout();
        $this->redirect(Url::admin('login.php'));
    }
}
