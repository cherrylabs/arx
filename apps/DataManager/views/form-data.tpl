<?php

$form = new c_form(APP_URL.'/action/create/data', array('class' => 'form-horizontal'));

// $form->label('name', 'Name');

$form->label('name', 'Titre');

$form->input('name', 'titre');

$form->label('value', 'Description');

$form->textarea('value', 'TEST');

$form->br();

$form->add('TESST TALER');

$form->br();

$form->submit('send', 'Envoyer');

echo $form->output();