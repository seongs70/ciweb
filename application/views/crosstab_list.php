<script>
    function find_text()
    {

        form1.action= "/crosstab/lists/text1/" +form1.text1.value + "/page" ;
        form1.submit();
    }
    $(function(){
        $('#text1') .datetimepicker({
            locale:'ko',
            format:'YYYY',

            defaultDate : moment()
        });
        $('#text1').on("dp.change", function (e) {find_text();});

    });
</script>
<div class="alert mycolor1" role="alert">월별 제품별 매출현황</div>
<br/>
<form name="form1" action="" method="post">
    <div class="row">
        <div class="col-4" align="left">
            <div class="input-group input-group-sm date table-sm" id="text1">
                <div class="input-group-prepend">
                    <span class="input-group-text">년도</span>
                </div>
                <input type="text" name="text1" value="<?=$text1 ?? '' ;?>" class="form-control" onkeydown="if (event.keyCode == 13 ){ find_text(); }">
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
        <td width="40%">제품명</td>
        <td width="5%">1월</td>
        <td width="5%">2월</td>
        <td width="5%">3월</td>
        <td width="5%">4월</td>
        <td width="5%">5월</td>
        <td width="5%">6월</td>
        <td width="5%">7월</td>
        <td width="5%">8월</td>
        <td width="5%">9월</td>
        <td width="5%">10월</td>
        <td width="5%">11월</td>
        <td width="5%">12월</td>
    </tr>
    <?php
    foreach ($list as $row)
    {
    ?>
    <tr>
        <td align="left" bgcolor="lightyellow"><?=$row->product_name; ?></td>
        <td align="left"><?=$row->s1==0 ? "" : number_format($row->s1); ?></td>
        <td align="left"><?=$row->s2==0 ? "" : number_format($row->s2); ?></td>
        <td align="left"><?=$row->s3==0 ? "" : number_format($row->s3); ?></td>
        <td align="left"><?=$row->s4==0 ? "" : number_format($row->s4); ?></td>
        <td align="left"><?=$row->s5==0 ? "" : number_format($row->s5); ?></td>
        <td align="left"><?=$row->s6==0 ? "" : number_format($row->s6); ?></td>
        <td align="left"><?=$row->s7==0 ? "" : number_format($row->s7); ?></td>
        <td align="left"><?=$row->s8==0 ? "" : number_format($row->s8); ?></td>
        <td align="left"><?=$row->s9==0 ? "" : number_format($row->s9); ?></td>
        <td align="left"><?=$row->s10==0 ? "" : number_format($row->s10); ?></td>
        <td align="left"><?=$row->s11==0 ? "" : number_format($row->s11); ?></td>
        <td align="left"><?=$row->s12==0 ? "" : number_format($row->s12); ?></td>
    </tr>
        <?
        }
    ?>
</table>
<div class="pagingbox">
    <?=$pagination?>

</div>
