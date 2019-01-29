<?php
/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_create_table_users
 *
 * @property CI_DB_forge         $dbforge
 * @property CI_DB_query_builder $db
 */
class Migration_create_table_api_users extends CI_Migration
{


    protected $table = 'api_users';


    public function up()
    {
        $fields = [
            'id'         => [
                'type'           => 'INT(11)',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'email'      => [
                'type'   => 'VARCHAR(255)',
                'unique' => true,
            ],
            'password'   => [
                'type' => 'VARCHAR(64)',
            ],
            'first_name' => [
                'type' => 'VARCHAR(32)',
            ],
            'last_name'  => [
                'type' => 'VARCHAR(32)',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
            ],
        ];
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->table, true);
    }


    public function down()
    {
        if ($this->db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }

}
