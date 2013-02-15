<?php

$form = new c_form(APP_URL.'/action/create/data', array('class' => 'form-horizontal'));

// $form->label('name', 'Name');

$form->label('title', 'Titre');

$form->input('title', 'titre');

$form->label('body', 'Description');

$form->textarea('body', 'TEST');

$form->br();

$form->add('TESST TALER');

$form->br();

$form->submit('send', 'Envoyer');

echo $form->output();