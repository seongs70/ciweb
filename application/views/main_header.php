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
          <li class="nav-item"><a class="nav-link" href="#">기간조회</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              통계
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">BEST제품</a>
                <a class="dropdown-item" href="#">월별제품별현황</a>
                <a class="dropdown-item" href="#">종류별 분포도</a>
            </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">기초정보</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/gubun">구분</a>
              <a class="dropdown-item" href="/product">제품</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/member">사용자</a>
            </div>

          </li>
        </ul>
        <a class="btn btn-sm btn-outline-secondary btn-dark" href="#">로그인</a>
      </div>
    </nav>
