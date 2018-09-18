<?php $view->extend('hello/layout.html.php') ?>

<?php $view['slots']->set('title', 'index site') ?>

<?php for( $i = 0; $i < 10; $i++ ) : ?>
	<?= $i ?> <br>
<?php endfor; ?>