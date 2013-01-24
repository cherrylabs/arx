<?php
/**
     * A Labels easy system tools
     * @author Daniel Sum
     * @version 0.9
     * @package arx
     * @comments :
     * @TODO : Cleaning this tool
*/
require_once dirname(__FILE__).'/../../'.'core.php';

arx::uses('a_idiorm,c_form');

$GLOBALS['lang'] = ZE_LANG;

if(!empty($_GET['lang']))
    $GLOBALS['lang'] = $_GET['lang'];

global $lb;

class _l extends c_singleton
{
    public function __construct( $lang = null )
    {
        global $lb;

        if(! $lang)
            $lang = $GLOBALS['lang'];

        if(!is_array($lb))	$lb = array();

        $oLabels = ORM::for_table('t_labels')->where('isocode', $lang)->find_many();

        //predie($lb);

        foreach ($oLabels as $key=>$l) {
            $key = $l->name;
            $lb[$key] = $mActionhis->{$key} = $l->value;
        }
    }

    public function __get($name)
    {

    }

}

/**
 * [lg description]
 * @param  string $name [description]
 * @param  string $mAction [description]
 * @param  string $p [description]
 * @param  string $i [description]
 * @param  string $c [description]
 * @return [type]
 */
function _l($name = '', $mAction = 'r', $p = '',$i = '',$c = '')
{
    global $lb;

    if(!empty($_GET['lang']))
        $GLOBALS['lang'] = $_GET['lang'];

    if(!empty($i))	$lang = $i;
    else				$lang = $GLOBALS['lang'];

    $l = $lang;

    $lg = new lg();

    if ($mAction == "r") {

        if(strpos($name,'|'))
            $v = ORM::for_table('t_labels')->find_one($name)->value;
        else
            $v = $lb[$name];

        // add context tagging
        if (LEVEL_ENV < 1) {

            if ($_GET['labelMode'] == 'flag') {
                $oLabel = ORM::for_table('t_labels')->find_one($name.'|'.$l);

                $aContext = json_decode($oLabel->context, TRUE);

                $aContext['FLAG'][$_SERVER['REQUEST_URI']] = date('YmdHis');

                $oLabel->context = json_encode($aContext);

                $oLabel->save();
            } elseif ($_GET['labelMode'] == 'edit') {
                return '<div class="labelMode">'. $v .'</div>';
            } elseif ($_GET['labelMode'] == 'info') {
                return ($name.'|'.$l);
            }

        }

        return $v;
    } elseif ($mAction == 'w' || $mAction == 1) {
        if (empty($p)) {
            $p = $name;
        }
        if (is_array($p)) {
            $aLanguages = array();
            foreach ($p as $l=>$v) {
                try {
                    //Trying to create
                    $a = ORM::for_table('t_labels')->create();
                    $a->id = $name.'|'.$l;
                    $a->name = $name;
                    $a->value = $v;
                    $a->isocode = $l;
                    $a->context = $c;
                    $a->save();
                    $aLanguages[] = $l;
                } catch (Exception $e) {
                    //Trying to update
                    if(ZE_ENVIRONNMENT == 'dev')

                        return ('<span class="error">error creating the label : ' . $name.'|'.$l ."/n". $e."</span>");
                    return lg($name);
                }

                foreach ($GLOBALS['cfg']['languages'] as $key=>$name) {
                    if (!in_array($key, $aLanguages)) {
                            $a = ORM::for_table('t_labels')->create();
                            $a->id = $name.'|'.$key;
                            $a->name = $name;
                            $a->value = $p;
                            $a->isocode = $key;
                            $a->context = $c;
                            $a->save();
                    }

                }

            }

            return lg($name);

        } else {
            try {
                    $a = ORM::for_table('t_labels')->create();
                    $a->id = $name.'|'.$l;
                    $a->name = $name;
                    $a->value = $p;
                    $a->isocode = $lang;
                    $a->context = $c;
                    $a->save();

                    foreach ($GLOBALS['cfg']['languages'] as $key=>$name) {
                        if ($key != $l) {
                            $a = ORM::for_table('t_labels')->create();
                            $a->id = $name.'|'.$key;
                            $a->name = $name;
                            $a->value = $p;
                            $a->isocode = $key;
                            $a->context = $c;
                            $a->save();
                        }
                    }

                    return $p;
            } catch (Exception $e) {
                    die('error creating the single label : ' . $name.'|'.$l."/n". $e);
            }

            return str_replace('&apos;', '\'', $p);
        }
    } elseif ($mAction == 'd' || $mAction == 0) {

    }
}

/**
     * Insert fonction
     * @author Daniel Sum
     * @version 0.9
     * @package arx
     * @comments :
*/

if (isset($_GET['insert'])) {

    $id = $_POST['id'];
    $c = explode('|',$_POST['id']); //id explode
    $mAction = $c[0]; //type
    $name = $c[1]; //name
    $i = $c[2]; //isocode

    $v = str_replace('&quot;&amp;quot;','',$v);

    $v = ($_POST['value']); //value

    switch ($mAction) {
        case 'value':
            $label = ORM::for_table('t_labels')->where('id', $name.'|'.$i)->find_one();
            $label->set('value', stripslashes($v));
            $label->save();
            die(stripslashes($v));
        break;
        case 'name':
            $result = ORM::for_table('t_labels')->raw_query("UPDATE t_labels SET name = '".str_replace('|','',$v)."' WHERE name = '".$name."' AND isocode = '".$i."'");
            die(stripslashes($v));
        break;
        case 'isocode':
            $result = ORM::for_table('t_labels')->raw_query("UPDATE t_labels SET isocode = '".$v."' WHERE name = '".$name."' AND isocode = '".$i."'");
            die(stripslashes($v));
        break;
        case 'context':
            $result = ORM::for_table('t_labels')->raw_query("UPDATE t_labels SET context = '".$v."' WHERE name = '".$name."' AND isocode = '".$i."'");
            die(stripslashes($v));
        break;
    }
}

if (ARX::VERSION < 1 || ARX_RETROCOMPATIBLE) {
    c_debug::notice('these functions are deprecated');

    function lg($name = '' ,$mAction = 'r',$p = '',$i = '',$c = '')
    {
        return _l($name,$mAction,$p,$i,$c);
    }

    class lg extends _l
    {
        public function __construct($lang = null)
        {
            parent::__construct($lang);

            if (ARX::VERSION > 1) {
                arx::notice("LG function is deprecated");
            }

        }
    }

}
