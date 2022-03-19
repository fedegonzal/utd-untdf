<?php
$context = Timber::context();

$context['novedades'] = Timber::get_posts([
    'post_type' => 'novedad',
    'nopaging'  => true,
]);
 
Timber::render('archive-novedad.twig', $context);
