<?php
class Findproduct_m extends CI_Model
{
    public function getlist($text1, $start, $limit)
    {
        if(!$text1){
            $sql="select product.*, gubun.name as gubun_name from product left join gubun on product.gubun_no = gubun.no order by product.name limit $start,$limit";
        } else {
            $sql="select product.*, gubun.name as gubun_name from product left join gubun on product.gubun_no = gubun.no where product.name like '%$text1%' order by product.name limit $start, $limit";
        }
        //select쿼리
        return $this->db->query($sql)->result();
    }
    function getrow($no)
    {
        $sql="select product.*, gubun.name as gubun_name from product left join gubun on product.gubun_no = gubun.no where product.no = $no";
        return $this->db->query($sql)->row();
    }

    public function rowcount($text1)
    {
        if(!$text1){
            $sql = "select * from product order by name";
        } else {
            $sql = "select * from product where name like '%$text1%' order by name";
        }
        return $this->db->query($sql)->num_rows();
    }
}
?>
