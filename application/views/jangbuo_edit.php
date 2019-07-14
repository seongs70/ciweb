<script>
    $(function(){
        $('#writeday') .datetimepicker({
            locale:'ko',
            format:'YYYY-MM-DD',
            defaultDate:moment ()
        });

        $('#writeday').on('dp.change', function(e){
            find_text();
        });
    });

    function select_product()
    {
        var str;
        str = form1.sel_product_no.value; // 제품번호 ^^단가
        if(str == "")                         // 선택하세요 인 경우
        {
            form1.product_no.value = "";
            form1.price.value="";
            form1.prices.value="";
        } else {
            str = str.split("^^");            // 두 값 분리
            form1.product_no.value = str[0];  // 제품번호
            form1.price.value = str[1];       // 단가
            form1.prices.value = Number(form1.price.value) * Number(form1.numo.value);  // 금액
        }
    }

    function cal_prices()
    {
        form1.prices.value = Number(form1.price.value) * Number(form1.numo.value);
        form1.bigo.focus();
    }
    function find_product()
    {
        window.open("/findproduct","","resizable=yes,width=500,height=600");
    }
</script>
<?
print_r($row);

?>

<div class="alert mycolor1" role="alert">매출장</div>
<form name="form1" action="" method="post" enctype="multipart/form-data" class="form-inline">
<table class="table table-sm table-bordered mymargin5">
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">번호</td>
        <td width="80%" align="left"><div class="form-inline"><?=$row->no;?></div></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>날짜</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <div class="input-group input-group-sm date table-sm" id="writeday">
                <input type="text" name="writeday" value="<?=$row->writeday ?>" class="form-control form-control-sm">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                    </div>
                </div>
            </div>
            <? if(form_error("writeday") == true ) echo form_error("writeday");?>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>제품명</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="hidden" name="product_no" value="<?=$row->product_no; ?>">
                <input type="text" name="product_name" value="" class="form-control form-control-sm" disabled />
                <input type="button" value="제품찾기" onClick="find_product();" class="form-control btn btn-sm mycolor1">
                <select name="sel_product_no" class="form-control form-control-sm" onchange="select_product();">
                    <option value="">선택하세요</option>
                    <?php $product_no = set_value("product_no");
                    foreach ($list as $row1)
                    {

                        if($row1->no == $product_no){
                            echo("<option value='$row1->no^^$row1->price' selected>$row1->name($row1->price)</option>");
                        } else {
                            echo ("<option value='$row1->no^^$row1->price'>$row1->name($row1->price)</option>");

                        }
                    }
                    ?>
                </select>
                <!-- <input type="text" name="product_no" value="<?=set_value("product_no")?>" class="form-control form-control-sm"> -->
            </div>
            <? if(form_error("product_no") == true ) echo form_error("product_no");?>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">단가</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="text" name="price" value="<?=$row->price ?>" class="form-control form-control-sm" onChange="cal_prices()"/>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">수량</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="text" name="numo" value="<?=$row->numo?>" class="form-control form-control-sm" onChange="cal_prices();"/>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">금액</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="text" name="prices" value="<?=$row->prices?>" class="form-control form-control-sm" onChange="cal_prices();"/>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">비고</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="text" name="bigo" value="<?=$row->bigo?>" class="form-control form-control-sm" />
            </div>
        </td>
    </tr>

</table>

<div class="center">
    <input type="submit" value="저장" class="btn btn-sm mycolor1" />&nbsp;
    <input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back();" />&nbsp;
</div>
</form>


</div>
</body>
</html>
