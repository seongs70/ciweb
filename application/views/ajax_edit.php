<div class="alert mycolor1" role="alert">Ajax 구분</div>

<form name="form1" action="" method="post">
<table class="table table-sm table-bordered mymargin5">
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle">번호</td>
        <td width="80%" align="left"><?=$row->no; ?></td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>구분명</td>
        <td width="80%" align="left">
            <div class="form-inline">
                <input type="text" name="name" size="20" maxlength="20" value="<?=$row->name; ?>" class="form-control form-control-sm" />
            </div>
            <? if(form_error("name") == true ) echo form_error("name");?>
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
