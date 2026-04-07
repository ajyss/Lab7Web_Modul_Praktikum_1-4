<?php
namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $title = 'Daftar User';
        $model = new UserModel();
        $users = $model->findAll();
        return view('user/index', compact('users', 'title'));
    }
    
    public function login()
    {
        helper(['form']);
        
        // Cek jika user sudah login
        if (session()->get('logged_in')) {
            return redirect('admin/artikel');
        }
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        if (!$email) {
            return view('user/login');
        }
        
        $session = session();
        
        try {
            $model = new UserModel();
            $login = $model->getUserByEmail($email);
            
            if ($login) {
                $pass = $login['userpassword'];
                if (password_verify($password, $pass)) {
                    // Update last login
                    $model->updateLastLogin($login['id']);
                    
                    $login_data = [
                        'user_id' => $login['id'],
                        'user_name' => $login['username'],
                        'user_email' => $login['useremail'],
                        'logged_in' => TRUE,
                        'login_time' => time(),
                    ];
                    
                    $session->set($login_data);
                    
                    // Log activity (improvisasi)
                    $this->logActivity('User logged in: ' . $login['username']);
                    
                    return redirect('admin/artikel');
                } else {
                    $session->setFlashdata("flash_msg", "Password salah.");
                    return redirect()->to('/user/login');
                }
            } else {
                $session->setFlashdata("flash_msg", "Email tidak terdaftar.");
                return redirect()->to('/user/login');
            }
        } catch (\Exception $e) {
            $session->setFlashdata("flash_msg", "Database belum siap. Silakan setup database terlebih dahulu. Error: " . $e->getMessage());
            return redirect()->to('/user/login');
        }
    }
    
    public function logout()
    {
        $session = session();
        $userName = $session->get('user_name');
        
        // Log activity (improvisasi)
        $this->logActivity('User logged out: ' . $userName);
        
        $session->destroy();
        return redirect()->to('/user/login');
    }
    
    // Improvisasi: Activity logging
    private function logActivity($activity)
    {
        $logFile = WRITEPATH . 'logs/user_activity.log';
        $timestamp = date('Y-m-d H:i:s');
        $ip = $this->request->getIPAddress();
        $logMessage = "[{$timestamp}] [{$ip}] {$activity}\n";
        
        file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    }
    
    // Improvisasi: Dashboard user
    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }
        
        $title = 'User Dashboard';
        $model = new UserModel();
        $totalUsers = $model->countAll();
        $recentUsers = $model->orderBy('created_at', 'DESC')->limit(5)->findAll();
        
        return view('user/dashboard', compact('title', 'totalUsers', 'recentUsers'));
    }
}
