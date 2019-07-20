<script>
    function find_text()
    {
        if(!form1.text1.value){
            form1.action="/picture/lists";
        } else {
            form1.action="/picture/lists/text1/" + form1.text1.value;
            form1.submit();
        }
    }
    function zoomimage(iname,pname)
    {
        w = window.open("/picture/zoom/iname/"+iname+"/pname/"+pname , "imageview","resizable = yes, scrollbars = yes, status = no, width=800, height = 600");
        w.focus();
    }
</script>
<style>
    .mythumb_box {
        font-size:14px; text-align:center;
        border:1px solid lightgray; padding:3px;
        margin:5px 0px 5px 0px;
    }
    .mythumb_image{
        width:150px; height:150px;
        margin-bottom:3px;
    }
    .mythumb_text{
        border:1px solid lightgray; background-color:lightsteelblue;
        padding:3px;
    }
    .mythumb_bigimage{
        height:550px; max-width:100%;
        margin-bottom:3px;
    }
</style>
<div class="alert mycolor1" role="alert">제품사진</div>
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

<div class="row">
    <?
        foreach($list as $row)
        {
            $iname = $row->pic ? $row->pic : "";
            $pname = $row->name;
    ?>
    <div class="col-3">
        <div class="mythumb_box">
            <a href="javascript:zoomimage('<?=$iname?>','<?=$pname?>');">
                <img src="/product_img/thumb/<?=$iname?>" class="mythumb_image" alt="">
            </a>
            <div class="mythumb_text"><?=$pname?></div>
        </div>
    </div>

<?
    }
?>

</div>
