<?php
	/**
		 * A Labels easy system tools
		 * @author Daniel Sum
		 * @version 0.9
		 * @package arx
		 * @comments :
		 * @TODO : Cleaning this tool
	*/
	require_once(dirname(__FILE__).'/../../'.'core.php');
	
	arx::uses('a_idiorm,c_form');
	
	$GLOBALS['lang'] = ZE_LANG;
	
	if(!empty($_GET['lang']))
		$GLOBALS['lang'] = $_GET['lang'];
	
	class lg{
		
		public function __construct( $lang = null){
		
			if(! $lang)
				$lang = $GLOBALS['lang'];
			
			$GLOBALS['lb'] = ORM::for_table('t_labels')->where('isocode', $lang)->find_many();
			
			//predie($GLOBALS['lb']);
			
			foreach($GLOBALS['lb'] as $key=>$l){
				$keyi = $l->name;
				$GLOBALS['lb'][$keyi] = $this->{$keyi} = $l->value;
			}
			
			return $GLOBALS['lb'];
		}
		
	}
	
	$lg = new lg();
	
	function lg($u = '' ,$t = 'r',$p = '',$i = '',$c = ''){
	
		if(!empty($_GET['lang']))
			$GLOBALS['lang'] = $_GET['lang'];
	
		if(!empty($i))	$lang = $i;
		else				$lang = $GLOBALS['lang'];
		
		$l = $lang;
		
		$lg = new lg();
		
		
		if($t == "r"){
			if(strpos($u,'|'))
				$v = ORM::for_table('t_labels')->find_one($u)->value;
			else
				$v = $GLOBALS['lb'][$u];
			
			// add context tagging
			if(LEVEL_ENV < 1){
			
				if($_GET['labelMode'] == 'flag')
				{
					$oLabel = ORM::for_table('t_labels')->find_one($u.'|'.$l);
					
					$aContext = json_decode($oLabel->context, TRUE);
					
					$aContext['FLAG'][$_SERVER['REQUEST_URI']] = date('YmdHis');
					
					$oLabel->context = json_encode($aContext);
					
					$oLabel->save();
				}
				
				elseif($_GET['labelMode'] == 'edit')
				{
					return '<div class="labelMode">'. $v .'</div>';
				}
				
				elseif($_GET['labelMode'] == 'info')
				{
					return ($u.'|'.$l);
				}
				
			}
			
			return $v;
		}
		elseif($t == 'w' || $t == 1){
			if(empty($p))
			{
				$p = $u;
			}
			if(is_array($p))
			{
				$aLanguages = array();
				foreach($p as $l=>$v)
				{
					try{
						//Trying to create 
						$a = ORM::for_table('t_labels')->create();
						$a->id = $u.'|'.$l;
						$a->name = $u;
						$a->value = $v;
						$a->isocode = $l;
						$a->context = $c;
						$a->save();
						$aLanguages[] = $l;
					}catch (Exception $e) {
						//Trying to update
						if(ZE_ENVIRONNMENT == 'dev')
							return ('<span class="error">error creating the label : ' . $u.'|'.$l ."/n". $e."</span>");
						return lg($u);
					}
					
					foreach($GLOBALS['cfg']['languages'] as $key=>$name){
						if(!in_array($key, $aLanguages))
						{
								$a = ORM::for_table('t_labels')->create();
								$a->id = $u.'|'.$key;
								$a->name = $u;
								$a->value = $p;
								$a->isocode = $key;
								$a->context = $c;
								$a->save();
						}
					
					}
					
				}
				
				return lg($u);
				
			}
			else
			{
				try{
						$a = ORM::for_table('t_labels')->create();
						$a->id = $u.'|'.$l;
						$a->name = $u;
						$a->value = $p;
						$a->isocode = $lang;
						$a->context = $c;
						$a->save();
						
						foreach($GLOBALS['cfg']['languages'] as $key=>$name){
							if($key != $l)
							{
								$a = ORM::for_table('t_labels')->create();
								$a->id = $u.'|'.$key;
								$a->name = $u;
								$a->value = $p;
								$a->isocode = $key;
								$a->context = $c;
								$a->save();
							}
						}
						return $p;
				}catch (Exception $e) {
						die('error creating the single label : ' . $u.'|'.$l."/n". $e);	
				}
				return str_replace('&apos;', '\'', $p);
			}
		}
		elseif($t == 'd' || $t == 0){
			
		}
	}
	
	function jlg($u=''){
		return addslashes(htmlspecialchars_decode(str_replace('&apos;', '\'', $GLOBALS['lb'][$u]['value'])));
	}
	
	function plg($u=''){
		$b = array('[br]','[h1]','[/h1]','[b]','[/b]','[strong]','[/strong]','[i]','[/i]','[em]','[/em]', '&apos;','&lt;','&gt;','[url={','}]','[/url]','[spancolor={','[/span]');
		$h = array('<br />','<h1>','</h1>','<strong>','</strong>','<strong>','</strong>','<em>','</em>','<em>','</em>','\'','<','>','<a rel="external" href="','">','</a>','<span style="color:','</span>');
		return str_replace($b,$h,htmlspecialchars_decode(str_replace('&apos;', '\'', $GLOBALS['lb'][$u]['value'])));
	}
	
	function tlg($u=''){
		echo str_replace(htmlspecialchars_decode(str_replace('&apos;', '\'', $GLOBALS['lb'][$u]['value'])));
	}
	
	
	/**
		 * Insert fonction
		 * @author Daniel Sum
		 * @version 0.9
		 * @package arx
		 * @comments :
	*/
	
	if(isset($_GET['insert'])){
		
		$id = $_POST['id'];
		$c = explode('|',$_POST['id']); //id explode
		$t = $c[0]; //type
		$u = $c[1]; //name
		$i = $c[2]; //isocode
		
		$v = str_replace('&quot;&amp;quot;','',$v);
		
		$v = ($_POST['value']); //value
		
		switch($t)
		{
			case 'value':
				$label = ORM::for_table('t_labels')->where('id', $u.'|'.$i)->find_one();
				$label->set('value', stripslashes($v));
				$label->save();
				die(stripslashes($v));
			break;
			case 'name':
				$result = ORM::for_table('t_labels')->raw_query("UPDATE t_labels SET name = '".str_replace('|','',$v)."' WHERE name = '".$u."' AND isocode = '".$i."'");
				die(stripslashes($v));
			break;
			case 'isocode':
				$result = ORM::for_table('t_labels')->raw_query("UPDATE t_labels SET isocode = '".$v."' WHERE name = '".$u."' AND isocode = '".$i."'");
				die(stripslashes($v));
			break;
			case 'context':
				$result = ORM::for_table('t_labels')->raw_query("UPDATE t_labels SET context = '".$v."' WHERE name = '".$u."' AND isocode = '".$i."'");
				die(stripslashes($v));
			break;
		}
	}
?>