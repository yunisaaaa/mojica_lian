<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // 🔹 Get students with pagination (fixed)
    public function getStudents($limit, $offset)
    {
        return $this->db->table($this->table)
                        ->order_by('id', 'ASC')     // siguraduhin na nakaayos
                        ->limit($limit, $offset)    // limit = ilan, offset = start
                        ->get_all();
    }

    // 🔹 Count all students
    public function getStudentCount()
    {
        return $this->db->table($this->table)->count();
    }
}
