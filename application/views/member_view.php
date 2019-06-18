    <?
    $no=$row->no;
    $tel1 = trim(substr($row->tel,0,3));
    $tel2 = trim(substr($row->tel,3,4));
    $tel3 = trim(substr($row->tel,7,4));
    $tel = $tel1 . "-" . $tel2 . "-" . $tel3;
    //삼항 연산자
    $rank = $row == '0' ? '직원' : '관리자';
    $tmp = $text1 ? "/no/$no/text1/$text1" : "/no/$no";
    ?>
    <br />

    <div class="alert mycolor1" role="alert">사용자</div>
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
            <td width="80%" align="left"><?=$row->no;?></td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>이름</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->name;?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>아이디</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->uid;?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle"><font color="red">*</font>암호</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->pwd;?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle">전화</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->tel;?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2" style="vertical-align:middle">등급</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->rank;?>
                </div>
            </td>
        </tr>
    </table>
    </form>
    <div class="center">
        <a href="/member/edit<?=$tmp;?>" class="btn btn-sm mycolor1">수정</a>
        <a href="/member/del<?=$tmp;?>" class="btn btn-sm mycolor1" onClick="return confirm('삭제할까요 ?');">삭제</a>&nbsp;
        <input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();" />
    </div>
