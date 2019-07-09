<?
$no=$row->no;

//삼항 연산자
$rank = $row == '0' ? '직원' : '관리자';
$tmp = $text1 ? "/no/$no/text1/$text1" : "/no/$no";
?>
<br />

<div class="alert mycolor1" role="alert">제품</div>
<script>
    function find_next(){
        form1.action="#",
        form1.submit();
    }
</script>
<form name="form1" action="" method="post">
<table class="table table-sm table-bordered mymargin5">
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">번호</td>
        <td width="80%" align="left"><?=$row->gubun_no;?></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>구분명</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <?=$row->gubun_name;?>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>제품명</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <?=$row->name;?>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>단가</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <?=$row->price;?>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">재고</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <?=$row->jaego;?>
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
</form>
<div class="center">
    <a href="/product/edit<?=$tmp;?>" class="btn btn-sm mycolor1">수정</a>
    <a href="/product/del<?=$tmp;?>" class="btn btn-sm mycolor1" onClick="return confirm('삭제할까요 ?');">삭제</a>&nbsp;
    <input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();" />
</div>
