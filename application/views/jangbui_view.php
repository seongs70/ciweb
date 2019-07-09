<?
$no=$row->no;

//삼항 연산자
$tmp = $text1 ? "/no/$no/text1/$text1/page/$page" : "/no/$no/page/$page";
?>
<br />

<div class="alert mycolor1" role="alert">매입장</div>

<form name="form1" action="" method="post">
<table class="table table-sm table-bordered mymargin5">
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">번호</td>
        <td width="80%" align="left"><?=$row->no;?></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>날짜</td>
        <td width="80%" align="left"><?=$row->writeday;?></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>제품명</td>
        <td width="80%" align="left"><?=$row->product_name;?></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">단가</td>
        <td width="80%" align="left"><?=$row->price;?></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">수량</td>
        <td width="80%" align="left"><?=$row->numi;?></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">금액</td>
        <td width="80%" align="left"><?=$row->prices;?></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">비고</td>
        <td width="80%" align="left"><?=$row->bigo;?></td>
    </tr>
</table>
</form>
<div class="center">
    <a href="/jangbui/edit<?=$tmp;?>" class="btn btn-sm mycolor1">수정</a>
    <a href="/jangbui/del<?=$tmp;?>" class="btn btn-sm mycolor1" onClick="return confirm('삭제할까요 ?');">삭제</a>&nbsp;
    <input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();" />
</div>
