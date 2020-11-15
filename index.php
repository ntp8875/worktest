<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Search</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include('layout/header.php'); ?>
<?php include('layout/aside.php'); ?>
  <div class="content-wrapper">
      <div class="card">
        <div class="card-header">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Search</h1>
                </div>
                <div class="col-sm-6">
                  <span id="alert"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <span>ชื่อหนัง</span>
                <input type="text" class="form-control" name="search" id="search" placeholder="Movie Name">
                <div id="show-add-search" class="row"></div>
              </div>
              <div class="form-group text-right">
                <button type="button" class="btn btn-info" onclick="addSearch()"><i class="fas fa-search-plus"></i> เพิ่มรายละเอียด</button>
                <button type="button" class="btn btn-success" onclick="searchData()"><i class="fas fa-search"></i> ค้นหา</button>
              </div>
            </div>
            <div class="col-lg-12">
              <table id="search-table" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Type</th>
                    <th>Save</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
        </div>
      </div>
    </section>
  </div>
 <?php include('layout/footer.php'); ?>

</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="layout/js_checklogin.js"></script>
<script>
  $('#search-table').DataTable({
      destroy : true,
      paging: false,
      searching: false
  });
  checkSes();
    function checkSes(){
        $.getJSON('./ajax_authen.php?action=checkLogin',function(data){
            //console.log(data);
            if(data.message === 'logout'){
                location.replace('/login.php');
            }
        })
    }
  function searchData(){
    let add_search = '';
    let search = $('#search').val();
    let TypeSearch = $('#TypeSearch').val();
    let YearSearch = $('#YearSearch').val();
    if(TypeSearch !== '' && TypeSearch != 'all' && typeof TypeSearch === 'string'){
      add_search += '&type='+TypeSearch;
    }
    if(YearSearch !== '' && typeof YearSearch === 'string'){
      add_search += '&y='+YearSearch;
    }
    //console.log(add_search);
    $.getJSON('https://www.omdbapi.com/?s='+search+add_search+'&apikey=32f246bc',
    function(data){
      let dataSearch = data.Search;
      let html = '';
      if(typeof dataSearch === 'object' && typeof dataSearch !== 'undefined'){
        $('#search-table').DataTable({
          columnDefs: [ {
            orderable: false, 
            targets: [0,4]
          }],
          destroy : true,
          paging: false,
          searching: false,
          data: dataSearch,
          "columns" : [
              { "data" : "Poster" , 
                render : function (data) {
                    return '<img src="' +data+ '" height="100px" />';
              }},
              { "data" : "Title" },
              { "data" : "Year" },
              { "data" : "Type" },
              { "data" : "imdbID",
                render : function (data) {
                    return '<button class="btn btn-primary" onclick="saveMovie(this,\'' + data + '\')"><i class="fas fa-save"></i></button>';
              }}
          ]
        });
      
      }else{
        $('#search-table').DataTable().clear().draw();
      }
    })
  }
  function saveMovie(button,id){
    $(button).prop('disabled', true);
    //console.log(id);
    $.getJSON('https://www.omdbapi.com/?i='+id+'&apikey=32f246bc',
      function(data){
        let dataMovie = data;
        //console.log(dataMovie);
        $.post('./ajax_movie.php?action=save',dataMovie,
        function(data){
          let data_json = JSON.parse(data);
          //console.log(data_json.message);
          if(data_json.message === 'success'){
            $("#alert").html("<div class='alert alert-success'>");
            $("#alert > .alert-success")
                .html(
                    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                )
                .append("</button>");
            $("#alert > .alert-success").append(
                "<strong>Saved!</strong>"
            );
            $("#alert > .alert-success").append("</div>");
            $('html, body').animate({
                scrollTop: 0
            }, '300');
            setTimeout(function () {
                $("#alert").html('');
            }, 3000);
          }else if(data_json.message === 'duplicate'){
            $("#alert").html("<div class='alert alert-warning'>");
            $("#alert > .alert-warning")
                .html(
                    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                )
                .append("</button>");
            $("#alert > .alert-warning").append(
                "<strong>Duplicated!</strong>"
            );
            $("#alert > .alert-warning").append("</div>");
            $('html, body').animate({
                scrollTop: 0
            }, '300');
            setTimeout(function () {
                $("#alert").html('');
            }, 3000);
          }
        })
      })
  }
  function addSearch(){
      let div = $('#show-add-search');
      let html = '<div class="col-lg-6"><b>Type :</b>\
                      <select class="form-control" id="TypeSearch">\
                        <option value="all">all</option>\
                        <option value="movie">movie</option>\
                        <option value="series">series</option>\
                        <option value="episode">episode</option>\
                      </select>\
                  </div>\
                  <div class="col-lg-6"><b>Year :</b>\
                      <input type="text" id="YearSearch" class="form-control">\
                  </div>';
      div.html(html);
  }
</script>
</body>
</html>
