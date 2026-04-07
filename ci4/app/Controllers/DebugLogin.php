<?php
// Debug script untuk login
namespace App\Controllers;

use App\Models\UserModel;

class DebugLogin extends BaseController
{
    public function index()
    {
        echo "<h1>DEBUG LOGIN SYSTEM</h1>";
        
        try {
            // Test database connection
            $db = \Config\Database::connect();
            echo "<p>Database connection: <strong>OK</strong></p>";
            
            // Test UserModel
            $model = new UserModel();
            echo "<p>UserModel created: <strong>OK</strong></p>";
            
            // Test get all users
            $users = $model->findAll();
            echo "<p>Total users in database: <strong>" . count($users) . "</strong></p>";
            
            // Test get user by email
            $email = 'aziztriramadhan29@gmail.com';
            $user = $model->getUserByEmail($email);
            
            if ($user) {
                echo "<p>User found: <strong>YES</strong></p>";
                echo "<p>Username: " . $user['username'] . "</p>";
                echo "<p>Email: " . $user['useremail'] . "</p>";
                echo "<p>Password Hash: " . substr($user['userpassword'], 0, 20) . "...</p>";
                
                // Test password verification
                $password = 'admin123';
                if (password_verify($password, $user['userpassword'])) {
                    echo "<p>Password verification: <strong style='color:green'>SUCCESS</strong></p>";
                } else {
                    echo "<p>Password verification: <strong style='color:red'>FAILED</strong></p>";
                    
                    // Generate new hash
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    echo "<p>New hash for 'admin123': " . $newHash . "</p>";
                }
            } else {
                echo "<p>User found: <strong style='color:red'>NO</strong></p>";
                
                // Try with admin@email.com
                $email2 = 'admin@email.com';
                $user2 = $model->getUserByEmail($email2);
                if ($user2) {
                    echo "<p>User admin@email.com found: <strong>YES</strong></p>";
                } else {
                    echo "<p>User admin@email.com found: <strong style='color:red'>NO</strong></p>";
                }
            }
            
        } catch (\Exception $e) {
            echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
        }
        
        echo "<br><a href='/user/login'>Back to Login</a>";
    }
}
