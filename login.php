<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Log In</p>
      <form id="FormLogin" onsubmit="return false">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" onclick="checkLogin()">Log In</button>
          </div>
        </div>
        <div class="row">
            <div class="col-12 form-group text-center" id="alert"></div>
        </div>
      </form>
  </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
    checkSes();
    function checkSes(){
        $.getJSON('./ajax_authen.php?action=checkLogin',function(data){
            console.log(data);
            if(data.message === 'login'){
                location.replace('/');
            }
        })
    }
    function checkLogin(){
        let form = $('#FormLogin');
        let username = form.find('[name=username]').val();
        let password = form.find('[name=password]').val();
        if(username != '' && password != ''){
            $.post('./ajax_authen.php?action=login',{
                username : username,
                password : password
            },function(data){
                console.log(data);
                if(data.message === 'success'){
                   location.replace('/');
                }else{
                    $("#alert").html("<div class='text-warning'>");
                    $("#alert > .text-warning")
                        .html(
                            "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                        )
                        .append("</button>");
                    $("#alert > .text-warning").append(
                        "<strong>Username or Password invalit !</strong>"
                    );
                    $("#alert > .text-warning").append("</div>");
                    setTimeout(function () {
                        $("#alert").html('');
                    }, 3000);
                }
            },'JSON')
        }else{
            $("#alert").html("<div class='text-danger'>");
            $("#alert > .text-danger")
                .html(
                    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                )
                .append("</button>");
            $("#alert > .text-danger").append(
                "<strong>Please fill out all information.</strong>"
            );
            $("#alert > .text-danger").append("</div>");
            setTimeout(function () {
                $("#alert").html('');
            }, 3000);
        }
    }
</script>
</body>
</html>
