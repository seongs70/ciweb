<?php
class Best_m extends CI_Model
{
    public function getlist($text1, $text2, $start, $limit)
    {
            $sql = "select product.name as product_name, count(jangbu.numo) as cnumo from jangbu
                    left join product on jangbu.product_no=product.no where io=1 and jangbu.writeday between '$text1' and '$text2' group by
                    product.name order by cnumo desc limit $start, $limit";
        return $this->db->query($sql)->result();
    }
    public function rowcount($text1, $text2)
    {
        $sql = "select product.name as product_name, count(jangbu.numo) as cnumo from jangbu left join product on
                jangbu.product_no = product.no where io=1 and jangbu.writeday between '$text1' and '$text2' group by
                product.name order by cnumo desc";
        return $this->db->query($sql)->num_rows();
    }
}
?>
