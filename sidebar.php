<?php
if($_SESSION['privilege'] == 'Admin'){
    include 'admin_sidebar.php';
}elseif($_SESSION['privilege'] == 'ZM'){
    include 'zm_sidebar.php';

}
elseif($_SESSION['privilege'] == 'TM'){
    include 'tm_sidebar.php';
    
}elseif($_SESSION['privilege'] == 'ASM'){
    include 'asm_sidebar.php';
    
}elseif($_SESSION['privilege'] == 'Order'){
    include 'orders_sidebar.php';
    
}
elseif($_SESSION['privilege'] == 'Logistics'){
    include 'logistic_sidebar.php';
    
}
elseif($_SESSION['privilege'] == 'App_order'){
    include 'app_order_sidebar.php';
    
}
elseif($_SESSION['privilege'] == 'Forward_order'){
    include 'forward_order_sidebar.php';
    
}
elseif($_SESSION['privilege'] == 'Back_orders'){
    include 'back_order_sidebar.php';
    
}
?>