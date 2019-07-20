<?php
class Ajax_m extends CI_Model
{
    public function getlist($text1, $start, $limit)
    {
        if(!$text1){
            $sql="select * from gubun order by name limit $start,$limit";
        } else {
            $sql="select * from gubun where name like '%$text1%' order by name limit $start, $limit";
        }
        //select쿼리
        return $this->db->query($sql)->result();
    }
    function getrow($no)
    {
        $sql="select * from gubun where no=$no";
        return $this->db->query($sql)->row();
    }
    function deleterow($no)
    {
        $sql="delete from gubun where no=$no";

        return $this->db->query($sql);
    }
    function insertrow($row)
    {
        return $this->db->insert("gubun",$row);
    }
    function updaterow($row, $no)
    {
        $where = array("no" => $no);
        return $this->db->update("gubun", $row, $where);
    }

    public function rowcount($text1)
    {
        if(!$text1){
            $sql = "select * from gubun order by name";
        } else {
            $sql = "select * from gubun where name like '%$text1%' order by name";
        }
        return $this->db->query($sql)->num_rows();
    }
}
?>
