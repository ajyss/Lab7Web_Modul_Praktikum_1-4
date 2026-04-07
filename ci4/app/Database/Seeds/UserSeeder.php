<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');
        
        // Data users dengan password yang di-hash
        $users = [
            [
                'username' => 'admin',
                'useremail' => 'admin@email.com',
                'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
                'is_active' => 1,
            ],
            [
                'username' => 'editor',
                'useremail' => 'editor@email.com',
                'userpassword' => password_hash('editor123', PASSWORD_DEFAULT),
                'is_active' => 1,
            ],
            [
                'username' => 'user',
                'useremail' => 'user@email.com',
                'userpassword' => password_hash('user123', PASSWORD_DEFAULT),
                'is_active' => 1,
            ],
        ];
        
        foreach ($users as $user) {
            $model->insert($user);
        }
        
        echo "User seeder executed successfully!\n";
        echo "Default users created:\n";
        echo "- admin@email.com (admin123)\n";
        echo "- editor@email.com (editor123)\n";
        echo "- user@email.com (user123)\n";
    }
}
