?php

/**
 * User Add
 *
 * @param $
 *
 * @return
 *
 * @code
 *
 * @endcode
 */

arx::uses('c_form,m_prousers');

$data = m_prousers::$_column;

$form = new c_form('/prousers/add');

c_hook::css(array(ARX_CSS.DS.'bootstrap.css'));

foreach ($data as $key=>$v) {
    $form->label($key);
    $form->input($key, $v['default_value']);

}

$form->button('send', 'send');

if (isset($_GET['add'])) {

}

$app->_body = $form->output();
