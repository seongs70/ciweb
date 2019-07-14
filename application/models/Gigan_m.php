<?php
class Gigan_m extends CI_Model
{
    public function getlist($text1, $text2, $text3, $start, $limit)
    {
        if($text3 == '0') //제품이 전체인 경우
        {
            $sql = "select jangbu.*, product.name as product_name from jangbu left join product on jangbu.product_no = product.no where jangbu.writeday between '$text1' and '$text2' order by jangbu.no limit $start, $limit";
        }
        else
        {
            $sql = "select jangbu.*, product.name as product_name from jangbu left join product on jangbu.product_no = product.no where jangbu.writeday between '$text1' and '$text2' and jangbu.product_no=$text3 order by jangbu.no limit $start, $limit";
        }
        //select쿼리
        return $this->db->query($sql)->result();
    }
    function getlist_product()
    {
        $sql = "select * from product order by name";
        return $this->db->query($sql)->result();
    }

    public function rowcount($text1,$text2,$text3)
    {
        if($text3 == '0')
        {
            $sql = "select * from jangbu where writeday btween'$text1' and '$text2'";
        } else {
            $sql = "select * from jangbu where writeday between '$text1' and '$text2' and product_no = $text3";
        }
        $sql = "select * from jangbu where io=1 and jangbu.writeday = '$text1'";
        return $this->db->query($sql)->num_rows();
    }
}
?>
