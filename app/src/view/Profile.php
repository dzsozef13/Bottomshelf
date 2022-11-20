<?php
$test = new UserController();
$testS = new SessionController();
$user = $testS->getUser();
if (isset($user)) {
    var_dump($test->fetchById($user['userId']));
}

?>

<p>Profile page</p>
<p>wjrfnjernf</p>