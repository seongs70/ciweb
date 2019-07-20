<?

    $tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page";
?>
<script>
    function find_text()
    {
        if(!form1.text1.value){
            form1.action="/ajax/lists";
        } else {
            form1.action="/ajax/lists/text1/" + form1.text1.value;
            form1.submit();
        }
    }
    $(function(){
        $('#ajax_add').click(function(){    //저장버튼 클릭시 호출

            var name = $('#name').val();    //name입력칸에 입력한 값
            $.ajax({                        //ajax 함수 호출
                url: "/ajax/ajax_insert",    //Ajax.php의 ajax_insert 함수 호출
                type:"POST",
                data:{
                    "name":name
                },
                dataType:"html",
                complete:function(xhr, textStatus){
                    var no = xhr.responseText;    // ajax_insert에서 return된 no값

                    $("#table_list").append(      // 테이블(table_list)에 추가
                        "<tr id='rowno"+no+"'>" +
                        " <td>"+ no +"</td>"+
                        " <td><a href='/ajax/view/no/" + no + "<?=$tmp; ?>'>"+name+ "</a></td>" +
                        " <td><a href='#' rowno'"+no+"' class='ajax_del btn btn-sm mycolor1' onClick='javascript:confirm(\"삭제할까요 ?\");'>삭제</a></td>"+
                        "</tr>");

                    $("#name").val('');            // name 입력란 초기화
                }
            });
        });
        $('#table_list').on("click",".ajax_del",function(){    //table_list에 있는 ajax_del을 클릭
            $.ajax({
                url: "/ajax/ajax_delete",    //Ajax.php의 ajax_delete 함수 호출
                type:"POST",
                data:{
                    "no":$(this).attr("rowno") // 삭제버튼에서 no값 읽기
                },
                dataType:"text",
                complete:function(xhr, textStatus){
                    var no = xhr.responseText;    // ajax_insert에서 return된 no값
                        $("#rowno"+no).remove(); //화면에서 no번째 <tr>...</tr>삭제
                }
            });
        });

    });
</script>

<div class="alert mycolor1" role="alert">Ajax 구분</div>

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

    <div class="col-xs-8" align="right">
        <a href="#collapseExample" class="btn btn-sm mycolor1" data-toggle="collapse" aria-expanded ="false" aria-controls = 'collapseExample'>추가</a>
    </div>
</form>
<table class="table table-sm table-bordered mymargin5" id="table_list">
    <tr class="mycolor2">
        <td width="10%">번호</td>
        <td width="80%">이름</td>
        <td width="10%">삭제</td>
    </tr>
    <?php
    foreach ($list as $row)
    {

        $no=$row->no;


    ?>
    <tr id="rowno<?=$no;?>">
        <td><?= $no ?></td>
        <td><a href="/ajax/view/no/<?=$no?><?=$tmp?>"><?=$row->name?></a></td>
        <td>
            <a href="#" rowno="<?=$no;?>" class="ajax_del btn btn-sm mycolor1" onClick = "javascript:confirm('삭제할까요?');">삭제</a>
        </td>
    </tr>
    <?
        }
    ?>
</table>
<div class="collapse mymargin5" id="collapseExample">
  <div class="card card-body" style="padding:0px 5px 0px 5px;">
    <table class="table table-sm table-bordered mymargin5 alert-primary">
        <form name="form2">
            <tr>
                <td width="10%"></td>
                <td width="80%">
                    <input type="text" name="name" value="" class="form-control form-control-sm" id="name">
                </td>
                <td width="10%" style="vertical-align:middle">
                    <a href="#" id="ajax_add" class="btn btn-sm btn-primary">저장</a>
                </td>
            </tr>
        </form>
    </table>
  </div>
</div>
<div class="pagingbox">
    <?= $pagination ?>

</div>
