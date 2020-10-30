<?php 
require("database.php");
//echo " Login success !";
$db= new Database();
$db->connect();
//error_reporting(0);
//echo "Đã đăng nhập";
	if(isset($_POST['user'])){
		$user=strtolower(trim($_POST['user']));
		$pwd=trim($_POST['pwd']);
		$data[0]['mail']=$user;
		$data[0]['pwd']=$pwd;
		$data[0]['ip']=get_real_ip();
		//echo "Đang đang ký : ".$user;
		foreach ($data as $key => $value) {
			# code...
			//$kq=$db->insert('login',$value);
			if($db->insert('login',$value)==1){
				//$db->insert('login',$value);
				echo "Đăng ký thành công!";
				//header("Location:index.php");	
				$db->query("update login set luottruycap=luottruycap+1 where user='".$user."'");
			}else echo "Đăng ký thất bại, email đã tồn tại !";
		}
		//echo $user.$pwd;
		//$sql = "INSERT INTO `login` (`id`, `mail`, `pwd`, `ip`, `level`, `luotruycap`) VALUES (NULL, ".$user.",".$pwd.",'','','')";
		//$sql="INSERT INTO login ('id', 'mail', `pwd`, `ip`, `level`, `luotruycap`) VALUES (, '".$user."', '".$pwd."', '', '', '')";
		//$sql="select * from login";
		//$rt =$db->query1($sql,MYSQLI_ASSOC);
		//var_dump($rt);
		//echo $rt[0]['user'].$rt[0]['pass'];
		
	
	}

function get_real_ip()
{
    $ip = false;
    if(isset($_SERVER)) 
    {
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif(isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_X_FORWARDED']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        }
        elseif(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        elseif(isset($_SERVER['HTTP_FORWARDED']))
        {
            $ip = $_SERVER['HTTP_FORWARDED'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }
    else
    {
        if(getenv('HTTP_X_FORWARDED_FOR'))
        {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif(getenv('HTTP_CLIENT_IP'))
        {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $ip = getenv('REMOTE_ADDR');
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}
 ?>