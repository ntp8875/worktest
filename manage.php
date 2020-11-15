<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manage</title>
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
                            <h1 class="m-0 text-dark">Manage Movie</h1>
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
                        <table id="show-movie-table" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Title</th>
                                <th>Year</th>
                                <th>Type</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="modal" id="show-movie" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Show</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="poster"></div>
                                </div>
                                <div class="form-group">
                                    <p><b>Title :</b><span class="title"></span></p>
                                    <p><b>Year :</b><span class="year"></span></p>
                                    <p><b>Type :</b><span class="type"></span></p>
                                    <p><b>Runtime :</b><span class="runtime"></span></p>
                                    <p><b>Actors :</b></p><p><span class="actors"></span></p>
                                    <p><b>Genre :</b></p><p><span class="genre"></span></p>
                                    <p><b>Plot :</b></p><p><span class="plot"></span></p>
                                    <p><b>Released :</b><span class="released"></span></p>
                                    <p><b>Writer :</b><span class="writer"></span></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="edit-movie" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Show</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="formEdit" action="./ajax_movie.php?action=editMovie" method="post" enctype="multipart/form-data" onsubmit="return false">
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <div class="poster"></div>
                                        <div class="col-lg-12">
                                            <b>Poster :</b>
                                            <input type="file" name="Poster" id="poster" class="form-control" onchange="checkImg(this)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <b>Title :</b>
                                            <input type="text" name="Title" id="title" class="form-control title">
                                        </div>
                                        <div class="col-lg-12">
                                            <b>Year :</b>
                                            <input type="text" name="Year" id="year" class="form-control year">
                                        </div>
                                        <div class="col-lg-12">
                                            <b>Type :</b>
                                            <input type="text" name="Type" id="type" class="form-control type">
                                        </div>
                                        <div class="col-lg-12">
                                            <b>Runtime :</b>
                                            <input type="text" name="Runtime" id="runtime" class="form-control runtime">
                                        </div>
                                        <div class="col-lg-12">
                                            <b>Actors :</b>
                                            <textarea name="Actors" id="actors" class="form-control actors" rows="5"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <b>Genre :</b>
                                            <textarea name="Genre" id="genre" class="form-control genre" rows="5"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <b>Plot :</b>
                                            <textarea name="Plot" id="plot" class="form-control plot" rows="5"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <b>Released :</b>
                                            <input type="date" name="Released" id="released" class="form-control released">
                                        </div>
                                        <div class="col-lg-12">
                                            <b>Writer :</b>
                                            <input type="text" name="Writer" id="writer" class="form-control writer">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" onclick="editMovie()">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal" id="confirmModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete "<span id="movie-name"></span>"?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- <div class="modal-body">
                            <p>Modal body text goes here.</p>
                        </div> -->
                        <div class="modal-footer">
                            <input type="hidden" id="id_del" name="id">
                            <button type="button" class="btn btn-primary" onclick="delMovie(this)">Confirm</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
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
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="layout/js_checklogin.js"></script>
<script>
    $('#show-movie-table').DataTable({
        destroy : true,
        paging: false,
        searching: false
    });
    getMovie();
    function getMovie(){
        $.get('./ajax_movie.php?action=getMovie',function(data){
            let json_data = JSON.parse(data);
            if(json_data.message === 'success'){
                $('#show-movie-table').DataTable({
                    columnDefs: [ {
                    orderable: false, 
                    targets: [0,4]
                    }],
                    destroy : true,
                    paging: true,
                    searching: true,
                    data: json_data.movie,
                    "columns" : [
                        { "data" : "Poster" , 
                        render : function (data) {
                            return '<img src="' +data+ '" height="100px" />';
                        }},
                        { "data" : "Title" },
                        { "data" : "Year" },
                        { "data" : "Type" },
                        { "data" : "id",
                        render : function (data) {
                            return '<button class="btn btn-info" onclick="seeMovie(\'' + data + '\')"><i class="fas fa-eye"></i></button>\
                            <button class="btn btn-primary" onclick="getEditMovie(\'' + data + '\')"><i class="fas fa-pen"></i></button>\
                            <button class="btn btn-danger" onclick="checkDelMovie(\'' + data + '\')"><i class="fas fa-trash"></i></button>';
                        }}
                    ]
                });
            }else{
                $('#show-movie-table').DataTable().clear().draw();
            }
            
        })
    }
    function seeMovie(id){
        $.getJSON('./ajax_movie.php?action=getMovieID&id='+id,function(data){
                let data_movie = data.movie;
                if(data.message === 'success'){
                    $('.poster').html('<img src="'+data_movie.Poster+'">');
                    $('.title').text(data_movie.Title);
                    $('.runtime').text(data_movie.Runtime);
                    $('.year').text(data_movie.Year);
                    $('.type').text(data_movie.Type);
                    $('.actors').text(data_movie.Actors);
                    $('.genre').text(data_movie.Genre);
                    $('.plot').text(data_movie.Plot);
                    $('.released').text(moment(data_movie.Released).format('l'));
                    $('.writer').text(data_movie.Writer);
                    $('#show-movie').modal('show');
                }
        });
    }
    function getEditMovie(id){
        $.getJSON('./ajax_movie.php?action=getMovieID&id='+id,function(data){
                let data_movie = data.movie;
                if(data.message === 'success'){
                    $('#id').val(data_movie.id);
                    $('.poster').html('<img src="'+data_movie.Poster+'" width="300px" class="show-poster">');
                    $('.title').val(data_movie.Title);
                    $('.runtime').val(data_movie.Runtime);
                    $('.year').val(data_movie.Year);
                    $('.type').val(data_movie.Type);
                    $('.actors').val(data_movie.Actors);
                    $('.genre').val(data_movie.Genre);
                    $('.plot').val(data_movie.Plot);
                    $('.released').val(data_movie.Released);
                    $('.writer').val(data_movie.Writer);
                    $('#edit-movie').modal('show');
                }
        });
    }
    function editMovie(){
        $('#formEdit').submit(function (e) {
            e.preventDefault()
            $.ajax({
                url: "./ajax_movie.php?action=editMovie",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#edit-movie').modal('hide');
                    $("#alert").html("<div class='alert alert-success'>");
                    $("#alert > .alert-success")
                        .html(
                            "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                        )
                        .append("</button>");
                    $("#alert > .alert-success").append(
                        "<strong>Edited!</strong>"
                    );
                    $("#alert > .alert-success").append("</div>");
                },
                complete: function () {
                    getMovie();
                    setTimeout(function () {
                        $("#alert").html('');
                    }, 3000);
                }
            });
        });
    }
    function checkDelMovie(id){
        $.getJSON('./ajax_movie.php?action=getMovieID&id='+id,function(data){
                let data_movie = data.movie;
                if(data.message === 'success'){
                    $('#id_del').val(data_movie.id);
                    $('#movie-name').text(data_movie.Title);
                    $('#confirmModal').modal('show');
                }
        });
    }
    function delMovie(button){
        let id = $(button).parent().find('#id_del').val();
        $.post('./ajax_movie.php?action=delMovieID&id='+id,function(data){
                if(data.message === 'success'){
                    $('#confirmModal').modal('hide');
                    $("#alert").html("<div class='alert alert-success'>");
                    $("#alert > .alert-success")
                        .html(
                            "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                        )
                        .append("</button>");
                    $("#alert > .alert-success").append(
                        "<strong>Deleted!</strong>"
                    );
                    $("#alert > .alert-success").append("</div>");
                    getMovie();
                    setTimeout(function () {
                        $("#alert").html('');
                    }, 3000);
                }
        },'JSON');
    }
    function checkImg(input) {
       
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('.show-poster').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
</body>
</html>
