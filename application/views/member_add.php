    <div class="alert mycolor1" role="alert">사용자</div>

    <form name="form1" action="" method="post">
    <table class="table table-sm table-bordered mymargin5">
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle">번호</td>
            <td width="80%" align="left">1</td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>이름</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="name" size="20" maxlength="20" value="<?=set_value("name")?>" class="form-control form-control-sm" />
                </div>
                <? if(form_error("name") == true ) echo form_error("name");?>
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>아이디</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="uid" size="20" maxlength="20" value="<?=set_value("uid")?>" class="form-control form-control-sm" />
                </div>
                <? if(form_error("uid") == true ) echo form_error("uid");?>
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>암호</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="pwd" size="20" maxlength="20" value="<?=set_value("pwd")?>" class="form-control form-control-sm" />
                </div>
                <? if(form_error("pwd") == true ) echo form_error("pwd");?>
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle">전화</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="tel1" size="3" maxlength="3" value="" class="form-control form-control-sm" />
                    <input type="text" name="tel2" size="4" maxlength="4" value="" class="form-control form-control-sm" />
                    <input type="text" name="tel3" size="4" maxlength="4" value="" class="form-control form-control-sm" />
                </div>
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle">등급</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="radio" name="rank" value="0" />직원&nbsp;&nbsp;
                    <input type="radio" name="rank" value="1" />관리자
                </div>
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
