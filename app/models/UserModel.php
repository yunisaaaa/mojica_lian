<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // 🔹 Get students with pagination (LavaLust style)
    public function getStudents($limit, $offset)
    {
        return $this->db->table($this->table)
                        ->order_by('id', 'ASC')     // para mauna si ID=1
                        ->limit($limit, $offset)    // LavaLust format
                        ->get_all();
    }

    // 🔹 Count all students
    public function getStudentCount()
    {
        return $this->db->table($this->table)->count();
    }
}
