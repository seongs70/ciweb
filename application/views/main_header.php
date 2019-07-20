
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>판매관리</title>
    <link href="/my/css/bootstrap.css" rel="stylesheet" />
    <link href="/my/css/my.css" rel="stylesheet" />
    <link href="/my/css/bootstrap-datetimepicker.css" rel="stylesheet" />
    <link href="/my/css/all.min.css" rel="stylesheet" />
    <script src="/my/js/jquery-3.4.1.min.js"></script>
    <script src="/my/js/bootstrap.min.js"></script>
    <script src="/my/js/moment-with-locales.min.js"></script>
    <script src="/my/js/bootstrap-datetimepicker.min.js"></script>

  </head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">판매관리</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="/jangbui">매입</a></li>
          <li class="nav-item"><a class="nav-link" href="/jangbuo">매출</a></li>
          <li class="nav-item"><a class="nav-link" href="/gigan">기간조회</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              통계
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/best">BEST제품</a>
                <a class="dropdown-item" href="/crosstab">월별제품별현황</a>
                <a class="dropdown-item" href="/graph">구분별 분포도</a>
            </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">기초정보</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/gubun">구분</a>
              <a class="dropdown-item" href="/product">제품</a>

              <?
                  if(!$this->session->userdata('rank')==1)
                  {
                      echo(" <div class='dropdown-divider'></div>
                             <a class='dropdown-item' href='/member'>사용자</a>");
                  }
              ?>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="/picture">사진</a></li>
        </ul>
      </div>
<?
        print_r($_SESSION);
    if(!$this->session->userdata('uid'))
    {
        echo("<a href='#exampleModal' data-toggle='modal' class='btn btn-sm btn-secondary'>로그인</a>");
    } else {

        echo("<a href='/login/logout' class='btn btn-sm btn-outline-secondary btn-dark'>로그아웃</a>");
    }

?>
    </nav>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header mycolor1">
        <h4 class="modal-title" id="exampleModalLabel">로그인</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-light" style="text-align:center">
          <form name="form_login" method="post" action="/login/check">
              <div class="form-inline">
                  아이디 : &nbsp;&nbsp;
                  <input type="text" name="uid" size="15" value="" class="form-control form-control-sm" />
              </div>
              <div style="height:10px"></div>
              <div class="form-inline">
                  암 &nbsp;&nbsp; 호 : &nbsp;&nbsp;
                  <input type="password" name="pwd" size="15" value="" class="form-control form-control-sm" />
              </div>
          </form>
      </div>
      <div class="modal-footer alert-secondary" style="text-align:center">
        <button type="button" class="btn btn-secondary" onclick="javascript:form_login.submit();">확인</button>
        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>
