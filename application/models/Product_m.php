<?php
class Product_m extends CI_Model
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
    function getlist_gubun()
    {
        $sql = "select * from gubun order by name";
        return $this->db->query($sql)->result();
    }
    function getrow($no)
    {
        $sql="select product.*, gubun.name as gubun_name from product left join gubun on product.gubun_no = gubun.no where product.no = $no";
        return $this->db->query($sql)->row();
    }
    function deleterow($no)
    {
        $sql="delete from product where no=$no";

        return $this->db->query($sql);
    }
    function insertrow($row)
    {
        return $this->db->insert("product",$row);
    }
    function updaterow($row, $no)
    {
        $where = array("no" => $no);
        return $this->db->update("product", $row, $where);
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

    public function cal_jaego()
        {
            $sql = "drop table if exists temp;";
            $this->db->query($sql); //temp테이블이 있으면 삭제

            $sql="create table temp(
                no int not null auto_increment,
                product_no int,
                jaego int default 0,
                primary key(no) );";
            $this->db->query($sql); // temp 테이블 생성

            $sql="update product set jaego=0;";
            $this->db->query($sql); // jaego 필드값 0으로 초기화

            $sql="insert into temp (product_no, jaego) select product_no, sum(numi)-sum(numo) from jangbu
            group by product_no;";
            $this->db->query($sql); // jaego 계산

            $sql="update product inner join temp on product.no=temp.product_no set product.jaego=temp.jaego;";
            $this->db->query($sql);//jaego값 product테이블에 복사

        }
}
?>
