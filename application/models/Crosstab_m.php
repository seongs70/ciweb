<?php
class Crosstab_m extends CI_Model
{
    public function getlist($text1, $start, $limit)
    {
            // select product.name as product_name,
            // sum(jangbu.numo) as s1 //매출수량합계 -> s1
            // from jangbu left join product on jangbu.product_no = product.no where year(jangbu.writeday) = $text1 //해당년도
            // group by jangbu.product_no //제품별
            // order by product.name limit $start, $limit;

            //만약 1월의 매출수량 합계를 구하길 원한다면 sum(jangbu.numo) as s1 대신 if()함수를 사용해 1월인 경우만 합을 구하도록작성
            //sum(if(month(jangbu.writeday)=1, jangbu.numo, 0)) as s1

            $sql = " select product.name as product_name,
                        sum(if(month(jangbu.writeday)=1, jangbu.numo, 0)) as s1,
                        sum(if(month(jangbu.writeday)=2, jangbu.numo, 0)) as s2,
                        sum(if(month(jangbu.writeday)=3, jangbu.numo, 0)) as s3,
                        sum(if(month(jangbu.writeday)=4, jangbu.numo, 0)) as s4,
                        sum(if(month(jangbu.writeday)=5, jangbu.numo, 0)) as s5,
                        sum(if(month(jangbu.writeday)=6, jangbu.numo, 0)) as s6,
                        sum(if(month(jangbu.writeday)=7, jangbu.numo, 0)) as s7,
                        sum(if(month(jangbu.writeday)=8, jangbu.numo, 0)) as s8,
                        sum(if(month(jangbu.writeday)=9, jangbu.numo, 0)) as s9,
                        sum(if(month(jangbu.writeday)=10, jangbu.numo, 0)) as s10,
                        sum(if(month(jangbu.writeday)=11, jangbu.numo, 0)) as s11,
                        sum(if(month(jangbu.writeday)=12, jangbu.numo, 0)) as s12
                        from jangbu left join product on jangbu.product_no = product.no
                        where year(jangbu.writeday) = $text1
                        group by jangbu.product_no order by product.name limit $start, $limit";
                        return $this->db->query($sql)->result();
    }
    public function rowcount($text1)
    {
        $sql = "select product_no from jangbu
                where year(writeday)=$text1 group by product_no";
        return $this->db->query($sql)->num_rows();
    }
}
?>
