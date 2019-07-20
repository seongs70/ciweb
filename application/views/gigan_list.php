<script>
    function find_text()
    {

        var asd = form1.action= "/gigan/lists/text1/" +form1.text1.value+ "/text2/" + form1.text2.value + "/text3/" + form1.text3.value+ "/page" ;

        form1.submit();
    }
    function make_excel()
    {
        form1.action = '/gigan/excel/text1/' + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value + "/page";
        form1.submit();
    }
    $(function(){
        $('#text1') .datetimepicker({
            locale:'ko',
            format:'YYYY-MM-DD',
        });
        $('#text2') .datetimepicker({
            locale:'ko',
            format:'YYYY-MM-DD',
        });
        $('#text1').on("dp.change", function (e) {find_text();});
        $('#text2').on("dp.change", function (e) {find_text();});
    });
</script>
<div class="alert mycolor1" role="alert">기간별 매출입현황</div>
<br/>
<form name="form1" action="" method="post">
    <div class="row">
        <div class="col-4" align="left">
            <div class="input-group input-group-sm date table-sm" id="text1">
                <div class="input-group-prepend">
                    <span class="input-group-text">날짜</span>
                </div>
                <input type="text" name="text1" value="<?=$text1 ?? '' ;?>" class="form-control" onkeydown="if (event.keyCode == 13 ){ find_text(); }">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                    </div>
                </div>
            </div>
        </div>
        -
        <div class="col-4" align="left">
            <div class="input-group input-group-sm table-sm date" id="text2">
                <input type="text" name="text2" value="<?=$text2;?>" class="form-control" size="9" onkeydown="if (event.keyCode == 13 ){ find_text(); }">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                    </div>
                </div>

                <div class="input-group-append">

                        <span class="input-group-text">제품명</span>

                    <select name="text3" class="form-control form-control-sm" onchange="javascript:find_text();"?>
                        <option value="0">전체</option>
                        <?
                            foreach($list_product as $row)
                            {
                                if($row->no == $text3)
                                {
                                    echo("<option value='$row->no' selected>$row->name</option>");
                                } else {
                                    echo("<option value='$row->no'>$row->name</option>");
                                }
                            }
                        ?>
                    </select>
                </div>
                &nbsp;&nbsp;
                <input type="button" value="EXCEL" class="form-control btn btn-sm mycolo1" onClick="if(confirm('엑셀파일로 저장할까요')) make_excel();"
            </div>
        </div>
    </div>
</form>

<table class="table table-sm table-bordered mymargin5">
    <tr class="mycolor2">
        <td width="11%">날짜</td>
        <td width="25%">제품명</td>
        <td width="10%">단가</td>
        <td width="10%">매입수량</td>
        <td width="10%">매출수량</td>
        <td width="15%">금액</td>
        <td width="10%">비고</td>
    </tr>
    <?php
    foreach ($list as $row)
    {

        $no=$row->no;
        $numi = $row->numi ? number_format($row->numi) : "";
        $numo = $row->numo ? number_format($row->numo) : "";

    ?>
    <tr>
        <td><?=$row->writeday ?></td>
        <td align="left"><?=$row->product_name;?></a></td>
        <td align="right"><?=number_format($row->price);?></td>
        <td align="right" bgcolor="lightyellow"><?=$numi;?></td>
        <td align="right" bgcolor="lightyellow"><?=$numo;?></td>
        <td align="right"><?=number_format($row->prices);?></td>
        <td align="left"><?=$row->bigo?></td>
    </tr>
    <?
        }
    ?>
</table>
<div class="pagingbox">
    <?=$pagination?>

</div>
