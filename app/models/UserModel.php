public function getStudents($limit, $offset)
{
    $result = $this->db->table($this->table)
                       ->order_by('id', 'ASC')
                       ->limit($limit, $offset)
                       ->get_all();

    // 🔹 Debug: ipakita yung actual SQL query
    echo "<pre>";
    echo $this->db->last_query();
    echo "</pre>";

    return $result;
}
