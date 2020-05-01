<?php  
    include 'defines.php';    
    function uSetConnection($host, $user, $passw){
        $link = mysqli_connect($host, $user, $passw);
        mysqli_set_charset($link, "utf8");
        return $link;
    }

    function uRegExprEmail($login){
       $res = preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $login);
       return $res;
    }

    function uCloseConnection($link){
        mysqli_close($link);
    }
    function uCheckAccountInDB($login, $password){
        $link = uSetConnection(host, username, passw);
        mysqli_select_db($link, cat_db_name);
        $query = "SELECT * FROM `login_tb` WHERE email = '".$login."';";

        //echo $query;
        //echo "</br>";
        $res = mysqli_query($link, $query); 
        uCloseConnection($link);
        if (!mysqli_num_rows($res)){
            return 0;
        }
        else
            return 1;
    }
    function uCheckPasswordInDB($login, $password){
            $link = uSetConnection(host, username, passw);
            mysqli_select_db($link, cat_db_name);
            $query = "SELECT * FROM `login_tb` WHERE email = '".$login."';";
            
            //echo $query;
            //echo "</br>";
            $res = mysqli_query($link, $query); 
            $row = mysqli_fetch_assoc(mysqli_query($link, $query));
            uCloseConnection($link);
            if ($row['password'] == $password){
                return 1;
            }
            else
                return 0;
    }
    function uAddAccoutToDB($login, $password){
        $link = uSetConnection(host, username, passw);
        mysqli_select_db($link, cat_db_name);
        $query = "INSERT INTO login_tb(email, password, last_input) values("."\"".$login."\"".", "."\"".$password."\"".", "."\"".        date("y-m-d")."\");";

        //echo "</br>";
        //echo $query;
        $res = mysqli_query($link, $query); 
        uCloseConnection($link);

    }
    function uCalculateNumOfItemByID($id){
        $link = uSetConnection(host, username, passw);
        mysqli_select_db($link, cat_db_name);
        $query = "SELECT * FROM `product_info_tb` WHERE type_id = ".$id.";";
        $res = mysqli_query($link, $query);
        uCloseConnection($link);

        return mysqli_num_rows($res);
    }

    function uGetRowFromDBByID($idx){
        $link = uSetConnection(host, username, passw);
        mysqli_select_db($link, cat_db_name);
        $query = "SELECT * FROM `product_info_tb` WHERE id = ".$idx.";";
        $res = mysqli_query($link, $query);
        uCloseConnection($link);
        return mysqli_fetch_assoc($res);    
    }

?>

