<?php

/**
 * Dashboard menu
 */

Arxmin::registerMenu(array(
    'name' => __('Dashboard'),
    'ref' => 'dashboard',
    'type' => 'module',
    'ico' => 'fa-home',
    'link' => url('/arxmin/modules/dashboard'),
    'position' => 0,
));
