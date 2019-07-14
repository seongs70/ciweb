<script>
    function find_text()
    {

        var asd = form1.action= "/gigan/lists/text1/" +form1.text1.value+ "/text2/" + form1.text2.value + "/page" ;

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
<div class="alert mycolor1" role="alert">BEST 제품</div>
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
            </div>
        </div>
    </div>
</form>

<table class="table table-sm table-bordered mymargin5">
    <tr class="mycolor2">
        <td width="50%">제품명</td>
        <td width="50%">총 판매수량</td>
    </tr>
    <?php
    foreach ($list as $row)
    {
    ?>
    <tr>
        <td align="left"><?=$row->product_name; ?></td>
        <td align="left"><?=number_format($row->cnumo); ?></td>
    </tr>
        <?
        }
    ?>
</table>
<div class="pagingbox">
    <?=$pagination?>

</div>
