<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Migration_create_ci_sessions_table Class
 */
class Migration_create_table_ci_sessions extends CI_Migration
{
    private $table = 'ci_sessions';

    public function up()
    {
        // Drop table 'ci_sessions' if it exists
        $this->dbforge->drop_table($this->table, true);

        // Table structure for table 'groups'
        $this->dbforge->add_field([
            'id'         => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
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
                'type' => 'blob',
                'null' => false,
            ],
        ]);
        $this->dbforge->create_table($this->table);
        $this->db->query('CREATE INDEX `' . $this->table . '_timestamp` ON `ci_sessions` (`timestamp`)');
        $this->db->query('ALTER TABLE `' . $this->table . '` ADD PRIMARY KEY (`id`, `ip_address`)');
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }

}
