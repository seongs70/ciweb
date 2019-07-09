<?php
class Jangbui_m extends CI_Model
{
    public function getlist($text1, $start, $limit)
    {
       $sql = "select jangbu.*, product.name as product_name from jangbu left join product on jangbu.product_no = product.no where jangbu.io = 0 and jangbu.writeday = '$text1' order by jangbu.no limit $start, $limit";
        //select쿼리
        return $this->db->query($sql)->result();
    }
    function getlist_product()
    {
        $sql = "select * from product order by name";
        return $this->db->query($sql)->result();
    }
    function getrow($no)
    {
        $sql="select jangbu.*, product.name as product_name from jangbu left join product on jangbu.product_no = product.no where jangbu.no = $no";
        return $this->db->query($sql)->row();
    }
    function deleterow($no)
    {
        $sql="delete from jangbu where no=$no";

        return $this->db->query($sql);
    }
    function insertrow($row)
    {
        return $this->db->insert("jangbu",$row);
    }
    function updaterow($row, $no)
    {
        $where = array("no" => $no);
        return $this->db->update("jangbu", $row, $where);
    }

    public function rowcount($text1)
    {
        $sql = "select * from jangbu where io=0 and jangbu.writeday = '$text1'";
        return $this->db->query($sql)->num_rows();
    }
}
?>
