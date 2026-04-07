<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika user belum login
        if (! session()->get('logged_in')) {
            // Maka redirect ke halaman login
            session()->setFlashdata('flash_msg', 'Please login to access this page.');
            return redirect()->to('/user/login');
        }
        
        // Improvisasi: Check user session timeout
        $loginTime = session()->get('login_time');
        if ($loginTime && (time() - $loginTime) > 3600) { // 1 hour timeout
            session()->destroy();
            session()->setFlashdata('flash_msg', 'Session expired. Please login again.');
            return redirect()->to('/user/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
