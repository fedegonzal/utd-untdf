<?php
$context = Timber::context();

$context['eventos'] = Timber::get_posts([
    'post_type' => 'evento',
    'nopaging'  => true,
]);
 
Timber::render('archive-evento.twig', $context);
