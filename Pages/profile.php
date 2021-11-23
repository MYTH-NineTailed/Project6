<?php

require_once '../config/dbconnect.php';

if(!$uname = Input::get('userName')) {
    Redirect::to('../index.php');
} else {
    $user = new User ($uname);
    if(!$user->exists()){
        Redirect::to(404);
    } else {
        $data = $user->data();
    }
?>

<h3><?php echo escape($data->uname); ?></h3>
<p>Full name: <?php echo escape($data->name); ?></p>

<?php
}
?>