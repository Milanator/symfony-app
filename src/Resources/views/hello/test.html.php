<?php $view->extend('hello/layout.html.php') ?>

<?php $view['slots']->set('title', 'test site') ?>

<h1><? echo "Ahoj " . $message ?></h1>