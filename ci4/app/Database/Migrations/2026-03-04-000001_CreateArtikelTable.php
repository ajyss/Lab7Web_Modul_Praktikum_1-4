<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArtikelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'judul'         => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'isi'           => [
                'type' => 'LONGTEXT',
            ],
            'slug'          => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'status'        => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'draft',
            ],
            'gambar'        => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at'    => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'    => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('artikel');
    }

    public function down()
    {
        $this->forge->dropTable('artikel');
    }
}
