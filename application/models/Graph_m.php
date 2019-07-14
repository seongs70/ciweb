<?php
class Graph_m extends CI_Model
{
    public function getlist($text1, $text2)
    {
            $sql = " select gubun.name as gubun_name, count(jangbu.numo) as cnumo
                     from (gubun right join product on gubun.no = product.gubun_no)
                     right join jangbu on product.no=jangbu.product_no
                     where io=1 and jangbu.writeday between '$text1' and '$text2' group by gubun.name order by cnumo desc limit 14";
        return $this->db->query($sql)->result();
    }
    public function rowcount($text1, $text2)
    {
        $sql = "select gubun.name as gubun_name, count(jangbu.numo) as cnumo
                 from (gubun right join product on gubun.no = product.gubun_no)
                 right join jangbu on product.no=jangbu.product_no
                 where io=1 and jangbu.writeday between '$text1' and '$text2' group by gubun.name limit 14";
        return $this->db->query($sql)->num_rows();
    }
}
?>
