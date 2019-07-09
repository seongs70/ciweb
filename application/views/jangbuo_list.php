<script>
    function find_text()
    {
        form1.action="/jangbuo/lists/text1/"+form1.tex1.value+"/page";
        form1.submit();
    }
    $(function(){
        $('#text1') .datetimepicker({
            locale:'ko',
            format:'YYYY-MM-DD',
            defaultDate:moment ()
        });

        $('#text1').on('dp.change', function(e){
                find_text();
        });
    });
</script>
<div class="alert mycolor1" role="alert">매출장</div>
<br/>
<form name="form1" action="" method="post">
    <div class="row">
        <div class="col-3" align="left">
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
    </div>
    <?
        if(isset($text1))$tmp = $text1 ? "/text1/$text1" : "";
    ?>
    <div class="col-xs-8" align="right">
        <a href="/jangbuo/add<?=$tmp ?? ''; ?>" class="btn btn-primary btn-sm">추가</a>
    </div>
</form>

<table class="table table-sm table-bordered mymargin5">
    <tr class="mycolor2">
        <td width="5%">번호</td>
        <td width="15%">날짜</td>
        <td width="30%">제품명</td>
        <td width="15%">단가</td>
        <td width="10%">수량</td>
        <td width="15%">금액</td>
        <td width="10%">비고</td>
    </tr>
    <?php
    foreach ($list as $row)
    {

        $no=$row->no;


    ?>
    <tr>
        <td><?= $no ?></td>
        <td><?=$row->writeday ?></td>
        <td align="left"><a href='/jangbuo/view/no/<?=$no?><?=$tmp?>'><?=$row->product_name?></a></td>
        <td align="right"><?=number_format($row->price)?></td>
        <td align="right"><?=number_format($row->numo)?></td>
        <td align="right"><?=number_format($row->prices)?></td>
        <td align="left"><?=$row->bigo?></td>
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
