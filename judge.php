<?php

    $html=<<<EOT

<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>查看赛事</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="./css/blog.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item  active" href="?sel=1">审核</a>
          <a class="blog-nav-item  " href="?sel=2">库存查询</a>
        </nav>
      </div>
    </div>
    <div class="container"  >
     <table class="table table-bordered">
              <thead>
                <tr>
                  <th>比赛项目</th>
                  <th>田赛/径赛</th>
                  <th>状态</th>
                  <th class="info">成绩</th>
                </tr>
              </thead>
              <tbody>
               
              </tbody>
            </table>
            <script>
            
            function opens(pid)  {
              window.open('viewPid.php?pid='+pid);
            }
</script>

    </div><!-- /.container -->
    <footer class="blog-footer">
      <p>出入库单审核</p>
      <p>
        <a href="#">退出登录</a>
      </p>
    </footer>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
EOT;

    echo $html;
