<?php
    include 'SQLManager.php';

    use Ratingthomas\SQL;

    $sql = new SQL\SQL();

    $sql->connect("localhost", "root", "", "auth");
    // print_r($sql->displayconnection());

    // echo '<br>';

    // $result = $sql->query("SELECT * FROM users WHERE userid = ? AND user_type = ?", ['1', 'superadmin']);
    $result = $sql->query("SELECT * FROM users", []);
    print_r($result);
?>