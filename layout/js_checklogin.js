checkSes();
function checkSes(){
    $.getJSON('./ajax_authen.php?action=checkLogin',function(data){
        console.log(data);
        if(data.message === 'logout'){
            location.replace('/login.php');
        }else if(data.message === 'login'){
            $(".username").text(data.username);
        }
    })
}
function logout(){
    $.post('./ajax_authen.php?action=logout',function(data){
        console.log(data);
        if(data.message === 'success'){
            location.replace('/login.php');
        }
    },'JSON')
}