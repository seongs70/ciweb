<script>
    function find_text()
    {
        if(!form1.text1.value){
            form1.action="/product/lists";
        } else {
            form1.action="/product/lists/text1/" + form1.text1.value;
            form1.submit();
        }
    }
</script>
<div class="alert mycolor1" role="alert">제품</div>
<br/>


<form name="form1" action="" method="post" style="margin-bottom:15px;">
            <div class="input-group-addon">
                <span class="btn" style="float:left">이름</span>
                <input type="text" style="width:150px; float:left; margin-right:10px;" name="text1" value="<?=$text1 ?? '' ;?>" class="form-control" onkeydown="if (event.keyCode == 13 ){ find_text(); }">
                <span class="input-group-btn" style="float:left">
                    <button class="btn mycolor1" type="button" onClick="javascript:find_text();">검색
                    </button>
                </span>
            </div>
    <?
        $tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page";
    ?>
    <div class="col-xs-8" align="right">
        <a href="/product/add<?=$tmp ?? ''; ?>" class="btn btn-primary ">추가</a>
        <a href="/product/jaego<?=$tmp;?>" class="btn btn-sm mycolor1">재고계산</a>
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
        <td align="left"><a href='/product/view/no/<?=$no?><?=$tmp?>'><?=$row->name?></a></td>
        <td align="right"><?=number_format($row->price)?></td>
        <td align="right"><?=number_format($row->jaego)?></td>
    </tr>
    <?
        }
    ?>
</table>
<div class="pagingbox">
    <?= $pagination ?>

</div>
