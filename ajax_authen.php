<?php
require_once 'conn/db.php';
require_once 'conn/MysqliDb.php';

$action = $_GET['action'] ? $_GET['action'] : '';
$db = new MysqliDb(DB_HOST , DB_USERNAME , DB_PASSWORD , DB_NAME);
$db->setPrefix(DB_PREFIX);
switch($action) {
    case 'login' :
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $checkdb = $db->where('username',$username)->where('password',$password)->get('user',null,'id,username');
        if(count($checkdb) > 0){
            session_start();
            $_SESSION['user_id'] = $checkdb[0]['id'];
            $_SESSION['username'] = $checkdb[0]['username'];
            $return['message'] = 'success';
            echo json_encode($return);
        }else{
            $return['message'] = 'fail';
            echo json_encode($return);
        }
    break;
    case 'checkLogin' :
        session_start();
        if(isset($_SESSION['user_id'])){
            $return['message'] = 'login';
            $return['username'] = $_SESSION['username'];
            echo json_encode($return);
        }else{
            $return['message'] = 'logout';
            echo json_encode($return);
        }
    break;
    case 'logout' :
        session_start();
        session_destroy();
        $return['message'] = 'success';
        echo json_encode($return);
    break;

}
?>