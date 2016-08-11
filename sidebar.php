<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */
 $context = array();
 $context['dynamic_sidebar'] = Timber::get_widgets('sidebar');
 Timber::render('partials/sidebar.twig', $context);
