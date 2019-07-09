<script>
    function find_text()
    {
        if(!form1.text1.value){
            form1.action="/gubun/lists";
        } else {
            form1.action="/gubun/lists/text1/" + form1.text1.value;
            form1.submit();
        }
    }
</script>
<div class="alert mycolor1" role="alert">구분</div>
<br/>
<form name="form1" action="" method="post">
    <div class="row">
        <div class="col-3" align="left">
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
    <div class="col-xs-8" align="right">
        <a href="/gubun/add<?=$tmp ?? ''; ?>" class="btn btn-primary btn-sm">추가</a>
    </div>
</form>

<table class="table table-sm table-bordered mymargin5">
    <tr class="mycolor2">
        <td width="10%">번호</td>
        <td width="20%">이름</td>

    </tr>
    <?php
    foreach ($list as $row)
    {

        $no=$row->no;


    ?>
    <tr>
        <td><?= $no ?></td>
        <td><a href="/gubun/view/no/<?=$no?><?=$tmp?>"><?=$row->name?></a></td>
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
