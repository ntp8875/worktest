<?php
require_once 'conn/db.php';
require_once 'conn/MysqliDb.php';
$db = new MysqliDb(DB_HOST , DB_USERNAME , DB_PASSWORD , DB_NAME);
$db->setPrefix(DB_PREFIX);
$action = isset($_REQUEST['action']) ?  $_REQUEST['action'] : '';
switch($action){
    case 'save' : 
        $data = array();
        $data['imdbID'] = $_REQUEST['imdbID'];
        $data['Title'] = $_REQUEST['Title'];
        $data['Actors'] = $_REQUEST['Actors'];
        $data['Genre'] = $_REQUEST['Genre'];
        $data['Plot'] = $_REQUEST['Plot'];
        $data['Poster'] = $_REQUEST['Poster'];
        $data['Released'] = date("Y-m-d", strtotime($_REQUEST['Released']));
        $data['Runtime'] = $_REQUEST['Runtime'];
        $data['Type'] = $_REQUEST['Type'];
        $data['Writer'] = $_REQUEST['Writer'];
        $data['Year'] = $_REQUEST['Year'];
        $check = $db->where('imdbID',$_REQUEST['imdbID'])->get('movie_save');
        if(count($check) > 0){
            $return['message'] = 'duplicate';
        }else{
            $id = $db->insert ('movie_save', $data);
            if ($id){
                $return['message'] = 'success';
                $return['id'] = $id;
            }else{
                $return['message'] = 'fail';
                $return['error'] = $db->getLastError();
            }        
        }

        echo json_encode($return);

    break;
    case 'getMovie' : 
        $movie = $db->get('movie_save');
        if ($movie){
            $return['message'] = 'success';
            $return['movie'] = $movie;
        }else{
            $return['message'] = 'fail';
            $return['error'] = $db->getLastError();
        }

        echo json_encode($return);

    break;
    case 'getMovieID' : 
        $id = $_REQUEST['id'];
        $movie = $db->where('id',$id)->get('movie_save');
        if ($movie){
            $return['message'] = 'success';
            $return['movie'] = $movie[0];
        }else{
            $return['message'] = 'fail';
            $return['error'] = $db->getLastError();
        }

        echo json_encode($return);

    break;
    case 'editMovie' : 
        $id = $_REQUEST['id'];
        $data = array();
        $data['Title'] = $_REQUEST['Title'];
        $data['Actors'] = $_REQUEST['Actors'];
        $data['Genre'] = $_REQUEST['Genre'];
        $data['Plot'] = $_REQUEST['Plot'];
        $data['Released'] = date("Y-m-d", strtotime($_REQUEST['Released']));
        $data['Runtime'] = $_REQUEST['Runtime'];
        $data['Type'] = $_REQUEST['Type'];
        $data['Writer'] = $_REQUEST['Writer'];
        $data['Year'] = $_REQUEST['Year'];
        if(isset($_FILES['Poster']) && $_FILES['Poster']['name'] !=''){
            $locate_img ="img_poster/";
            $name_file =  $_FILES['Poster']['name'];
            $tmp_name =  $_FILES['Poster']['tmp_name'];
            move_uploaded_file($tmp_name,$locate_img.$name_file);
            $data['Poster'] = $locate_img.$name_file;
        }

        $ids = $db->where('id',$id)->update('movie_save', $data);
        if ($ids){
            $return['message'] = 'success';
        }else{
            $return['message'] = 'fail';
            $return['error'] = $db->getLastError();
        }

        echo json_encode($return);

    break;
    case 'delMovieID' : 
        $id = $_REQUEST['id'];
        $check = $db->where('id',$id)->delete('movie_save');
        if ($check){
            $return['message'] = 'success';
        }else{
            $return['message'] = 'fail';
            $return['error'] = $db->getLastError();
        }
        echo json_encode($return);
    break;   
}
?>