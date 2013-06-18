<?php

use Arx\h_widget;

require dirname(__FILE__).'/vendor/autoload.php';

$widget = new h_widget(array(
    'class' => 'span4',
    'icon' => 'icon-dashboard',
    'title' => 'My dashboard',
    'body' => 'Lorem ipsum dolor sit amet...'
));

predie($widget->output());
