<div class="alert mycolor1" role="alert">제품</div>
<pre>
<? print_r($list); ?>
<? print_r($row); ?>
</pre>
<form name="form1" action="" method="post" enctype="multipart/form-data" class="form-inline">
<table class="table table-sm table-bordered mymargin5">
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>구분명</td>
        <td width="80%" align="left">

            <div class="form-inline">
                <select name="gubun_no" class="form-control form-control-sm">
                    <option value="">선택하세요</option>
                    <?php $gubun_no = set_value("gubun_no");
                    foreach ($list as $list_row)
                    {

                        if($row->no == $gubun_no){
                        echo("<option value='$row->no' selectd>$list_row->name</option>");}
                        else {
                            echo ("<option value='$list_row->no'>$list_row->name</option>");

                        }
                    }
                    ?>
                </select>
                <!-- <input type="text" name="gubun_no" value="<?=set_value("gubun_no")?>" class="form-control form-control-sm"> -->
            </div>
            <? if(form_error("gubun_no") == true ) echo form_error("gubun_no");?>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>제품명</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="text" name="name" size="20" maxlength="20" value="<?=$row->name?>" class="form-control form-control-sm" />
            </div>
            <? if(form_error("name") == true ) echo form_error("name");?>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>단가</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="text" name="price" value="<?=$row->price?>" class="form-control form-control-sm">
            </div>
            <? if(form_error("price") == true ) echo form_error("price");?>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">재고</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="text" name="jaego" value="<?=$row->jaego?>" class="form-control form-control-sm">
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">사진</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <b>파일이름</b> : <?=$row->pic;?><br>
            </div>
            <?
                if($row->pic){
                    echo ("<img src='/product_img/$row->pic' width='200' class='img-fluid img-thumnail'>");
                } else {
                    echo ("<img src='' width='200' class='img-fluid img-thumnail'>");
                }
            ?>
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
