<script>
    function find_text()
    {
        if(!form1.text1.value){
            form1.action="/findproduct/lists";
        } else {
            form1.action="/findproduct/lists/text1/" + form1.text1.value;
            form1.submit();
        }
    }
    function  SendProduct(no,name,price)
    {
        opener.form1.product_no.value = no;
        opener.form1.product_name.value = name;
        opener.form1.price.value = price;
        opener.form1.prices.value = Number(price) + Number(opener.form1.numo.value);
        self.close();
    }
</script>
<div class="alert mycolor1" role="alert">제품선택</div>
<br/>
<form name="form1" action="" method="post">
    <div class="row">
        <div class="col-6" align="left">
            <div class="input-group-addon">이름</span>
                <input type="text" name="text1" value="<?=$text1 ?? '' ;?>" class="form-control" onkeydown="if (event.keyCode == 13 ){ find_text(); }">
                <span class="input-group-btn">
                    <button class="btn mycolor1" type="button" onClick="javascript:find_text();">검색
                    </button>
                </span>
            </div>
        </div>
    </div>
    <?
        if(isset($text1))$tmp = $text1 ? "/text1/$text1" : "";
    ?>
    <div class="col-6" align="right">

    </div>
</form>

<table class="table table-sm table-bordered mymargin5">
    <tr class="mycolor2">
        <td width="10%">번호</td>
        <td width="20%">구분명</td>
        <td width="30%">제품명</td>
        <td width="20%">단가</td>
        <td width="20%">재고</td>


    </tr>
    <?php
    foreach ($list as $row)
    {

        $no=$row->no;


    ?>
    <tr>
        <td><?= $no ?></td>
        <td><?=$row->gubun_name?></td>
        <td align="left">
            <a href="javascript:SendProduct(<?=$no?>,'<?=$row->name?>',<?=$row->price?>);"><?=$row->name?></a>
        </td>
        <td align="right"><?=number_format($row->price)?></td>
        <td align="right"><?=number_format($row->jaego)?></td>
    </tr>
    <?
        }
    ?>
</table>
<div align="center">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-center mymargin5">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="PRevious">
                    <span aira-hidden="true">◁</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link mycolor1" href="#">1</a></li>
            <li class="page-item"><a class="page-link active" href="#">2</a></li>
            <li class="page-item"><a class="page-link active" href="#">3</a></li>
            <li class="page-item"><a class="page-link active" href="#">4</a></li>
            <li class="page-item"><a class="page-link active" href="#">5</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aira-hidden="true">▷</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
