<?php 
    require_once 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if(isset($_GET['page_layout'])){
            switch ($_GET['page_layout']) {
                case 'danhsach':
                    require_once 'ad_set/danhsach.php';
                    break;
                case 'them':
                    require_once 'ad_set/them.php';
                    break;
                case 'sua':
                    require_once 'ad_set/sua.php';
                    break;
                case 'xoa':
                    require_once 'ad_set/xoa.php';
                     break;
                default:
                    require_once 'ad_set/danhsach.php';
                    break;
            }
        } else {
            require_once 'ad_set/danhsach.php';
        }
    ?>
</body>
</html>