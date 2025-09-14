<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // ✅ Get records with limit + offset for pagination
    public function getStudents($limit, $offset) {
        return $this->db->table($this->table)
                        ->limit($limit, $offset)
                        ->get_all();
    }

    // ✅ Count all rows
    public function getStudentCount() {
        return $this->db->table($this->table)->count();
    }
}
