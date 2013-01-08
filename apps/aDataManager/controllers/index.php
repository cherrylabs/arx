<?php

$t_data = a_db::table('t_data');

$t_type = a_db::table('t_data_type');

$t_tree = a_db::table('t_data_tree');

$aMenu = array();

foreach ($t_tree->find_many() as $key=>$v) {
    $aMenu[$v->id] = $v->as_array();
    $aMenu[$v->id]['attr']['class'] = 'iframe';
    $aMenu[$v->id]['attr']['id'] = $v->id;
}

$app->aMenu = $aMenu;

$app = new ctrl_table('t_data');

$app->display();
exit;
