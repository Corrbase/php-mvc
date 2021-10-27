
<?php
$main_page = ''; // Your mane page url


session_start();
include "core/model.php";
include "core/functions.php";

$get = '';
if (isset($_GET['url'])){
$get = explode('/', $_GET['url']);
}




if (isset($get[0]))
{
    if ($get[0])
    {
        $controllerFile = 'controller/' . $get[0] . '.php';
        if (file_exists($controllerFile))
        {
            include $controllerFile;
            $controller = new $get[0];
            if (isset($get[1]))
            {
                if (method_exists($controller,$get[1])) {
                    if (isset($get[2])) {
                        $controller->{$get[1]}($get[2]);
                    } else {
                        $controller->{$get[1]}();
                    }
                }else{
                    header("$main_page");
                }

            }else{
                header("$main_page");
            }
        }else{
            header("$main_page");
        }
//        header("location: http://webline.loc/customer/posts");
    }
}else{

}

