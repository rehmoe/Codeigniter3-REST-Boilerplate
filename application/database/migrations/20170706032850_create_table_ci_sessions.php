<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Migration_create_ci_sessions_table Class
 */
class Migration_create_table_ci_sessions extends CI_Migration
{
    /**
     * Entry point for the migration
     */
    public function up()
    {
        // Fields array
        $fields = [
            'id'         => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null'       => false,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null'       => false,
            ],
            'timestamp'  => [
                'type'       => 'INT',
                'constraint' => '10',
                'unsigned'   => true,
                'default'    => 0,
                'null'       => false,
            ],
            'data'       => [
                'type' => 'BLOB',
                'null' => false,
            ],
        ];
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('`' . config_item('sess_save_path') . '_timestamp` (`timestamp`)', false);

        // Create the table
        $this->dbforge->create_table(config_item('sess_save_path'));
    }

    /**
     * Migration rollback
     */
    public function down()
    {

        $this->dbforge->drop_table(config_item('sess_save_path'));

    }
}
