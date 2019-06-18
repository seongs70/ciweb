<?php
class Member_m extends CI_Model
{
    public function getlist($text1)
    {
        if(!$text1){
            $sql="select * from member order by name";
        } else {
            $sql="select * from member where name like '%$text1%' order by name";
        }
        //select쿼리
        return $this->db->query($sql)->result();
    }
    function getrow($no)
    {
        $sql="select * from member where no=$no";
        return $this->db->query($sql)->row();
    }
    function deleterow($no)
    {
        $sql="delete from member where no=$no";

        return $this->db->query($sql);
    }
    function insertrow($row)
    {
        return $this->db->insert("member",$row);
    }
    function updaterow($row, $no)
    {
        $where = array("no" => $no);
        return $this->db->update("member", $row, $where);
    }
}
?>
