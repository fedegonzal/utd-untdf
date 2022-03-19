<?php
$context = Timber::context();

$context['eventos'] = Timber::get_posts([
    'post_type' => 'evento',
    'numberposts' => 2,
    'nopaging'  => true,
]);

$context['novedades'] = Timber::get_posts([
    'post_type' => 'novedad',
    'numberposts' => 2,
    'nopaging'  => true,
]);
 
Timber::render('index.twig', $context);
