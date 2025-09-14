<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    
    // 🔹 Kunin lahat ng students na may limit & offset (para sa pagination)
    public function getStudents($limit, $offset) {
        return $this->db->table('students')
                        ->limit($limit, $offset)
                        ->get_all();
    }

    // 🔹 Bilangin lahat ng students
    public function getStudentCount() {
        return $this->db->table('students')
                        ->count();
    }

    // 🔹 Insert
    public function insert($data) {
        return $this->db->table('students')->insert($data);
    }

    // 🔹 Find by ID
    public function find($id) {
        return $this->db->table('students')
                        ->where('id', $id)
                        ->get();
    }

    // 🔹 Update
    public function update($id, $data) {
        return $this->db->table('students')
                        ->where('id', $id)
                        ->update($data);
    }

    // 🔹 Delete
    public function delete($id) {
        return $this->db->table('students')
                        ->where('id', $id)
                        ->delete();
    }
}
