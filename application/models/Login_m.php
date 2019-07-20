<?php
class Login_m extends CI_Model
{
    function getrow($uid, $pwd)
    {
        $sql = "select * from member where uid = '$uid' and pwd ='$pwd'";
    
        return $this->db->query($sql)->row();
    }
}
?>
