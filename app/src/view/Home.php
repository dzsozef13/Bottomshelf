<?php 
include_files(array(
    "BadgeModel",
));

$test = new BadgeModel();

?>

<p>Home</p>
<?php var_dump($test->getById(1)) ?>