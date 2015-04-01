<?php

class SitemapAction extends Action
{
	public function init()
	{
		
	}


	public function doAction($param)
	{
		$param = strip_tags($param);

		$menuTopL = array();
		$menuTopA = array();
		$menuTopR = array();

		switch ($param)
		{
			case 'mailing_list':
			$this->genClients();
			break;

			default:
			$this->genSitemap();
			break;
		}

		$menuTopL = array ( ) ;
		$menuTopA = array ( ) ;
		$menuTopR = array ( ) ;

		if( $param == '')
		{
			$menuTopA = array ( 'title' => 'Generowanie sitemap' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=sitemap' );
			//$menuTopR[] = array ( 'title' => 'Zaczytywanie e-maili z pliku txt' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=sitemap&act=mailing_list' );
		}
		elseif( $param == 'mailing_list')
		{
			$menuTopL[] = array ( 'title' => 'Generowanie sitemap' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=sitemap' );
			$menuTopA = array ( 'title' => 'Zaczytywanie e-maili z pliku txt' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=sitemap&act=mailing_list' );
		}

		$this->response->addParameter('menuTopL', $menuTopL);
    	$this->response->addParameter('menuTopA', $menuTopA);
    	$this->response->addParameter('menuTopR', $menuTopR);

		$this->response->addParameter('moduletpl', 'sitemap/templates/list.tpl');
	}



	protected function genClients()
	{
		$nazwa_pliku = "../mailing_".(date("Y_m_d")).".txt";

		if(file_exists($nazwa_pliku))
		{
			$uchwyt = fopen($nazwa_pliku, "r");
			$tresc = fread($uchwyt, filesize($nazwa_pliku));
			fclose($uchwyt);

			$_mails = explode("\r\n", $tresc);

			foreach($_mails as $email)
			{
				if($email != "")
				{
					$email = str_replace(" ","",$email);
					$_mails_uniq[$email] = $email;
				}
			}

			$_comment = 'E-maili w pliku txt: '.count($_mails);
			$_comment .= '<br />';
			$_comment .= 'E-maili unikalnych w pliku txt: '.count($_mails_uniq);
			$_comment .= '<br />';


			$j=0;
			$i=0;
			foreach($_mails_uniq as $e_mail)
			{
				$check = $this->CheckEmail($e_mail);

				if($check == 0)
				{
					$password = md5(microtime());
					$password = substr($password,0,8);
					$new_email[] = array('e_mail' => $e_mail, 'password' => $password);
					$i++;
				}
				else 
				{
					$wrong_email[] = $e_mail;
					$j++;
				}
			}

			$_comment .= 'Nowych e-maili: '.$i;
			$_comment .= '<br />';
			$_comment .= 'Zdublowanych w bazie e-maili: '.$j;
			$_comment .= '<br />';

			if($i>0)
			{
				//print_r($new_email);
				$a=0;
				foreach($new_email as $e_mail_add)
				{
					$this->addClient($e_mail_add);
					$a++;
				}

				if($a > 0)
				{
					$_comment .= 'Dodanych do bazy: '.$a;
				}
			}
		}
		else
		{
			$_comment = 'Nie znaleziono pliku z listą mailingową.';
		}



		$this->response->addParameter('message', $_comment);
	}



	protected function CheckEmail($e_mail)
	{
		$sql = "SELECT `email` FROM `client` WHERE `email` = '".$e_mail."' LIMIT 1";
		$DB = DB::getInstance();
		$stmt = $DB->query($sql);
		if($result = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$stmt->closeCursor();
			return 1;
		}
		else 
		{
			return 0;
		}
	}

	
	protected function addClient($data_arr)
	{
		$sql = "";
		$sql = "
		INSERT INTO 
			`client` 
		SET 
			`added` = '".date('Y-m-d H:i:s')."', 
			`deleted` = 'N',
			`active` = 'Y',
			`email` = '".$data_arr['e_mail']."',
			`type` = '0',
			`password` = '".$data_arr['password']."',
			`id_province` = '0'";

		//echo $sql;
		//break;
		$DB = DB::getInstance();
		$insert = $DB->exec($sql);
	}






	protected function genSitemap()
	{
		
		if($_SESSION['user']['permit']['modules'][$_GET['mod']] && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['view']){
			$_SESSION['message'] = 'Nie posiadasz uprawnień do wykonania tej operacji!';					
			return FALSE;
		}
		
		$nazwaStrony = SITE_NAME;
		
		if($_POST['confirms']){
			if($_SESSION['user']['permit']['modules'][$_GET['mod']] && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['edit']){
				$_SESSION['message'] = 'Nie posiadasz uprawnień do wykonania tej operacji!';					
				return FALSE;
			}
			
			$header ="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
              <urlset
                xmlns=\"http://www.google.com/schemas/sitemap/0.84\"
                xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
                xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84
                                    http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">
<url>
<loc>".SITE_ADDRESS."index.html
</loc>
<priority>0.9</priority>
<changefreq>daily</changefreq>
</url>";

			$footer = "</urlset>";

			$output_xml = $header;


			$sql = "SELECT * FROM `page` WHERE `active` = 'Y' AND `redirect` = '' AND `id_page` > 1 AND `language`='pl' ORDER BY `id_page` ASC ";
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);
			if($result = $stmt->fetchAll(PDO::FETCH_ASSOC))
			{
				foreach ($result as $row)
				{
					$output_xml .= '<url>';
					$output_xml .= '<loc>'.SITE_ADDRESS.''.strtolower(String::toModerewrite($row['name'])).','.$row[id_page].'.html</loc>';
					$output_xml .= '<priority>0.'.$row['priority'].'</priority>';
					$output_xml .= '<changefreq>daily</changefreq>';
					$output_xml .= '</url>
';
				}
			}
		


			$output_xml .= $footer;

			$h = fopen('../sitemap.xml','w+');
			fwrite($h,$output_xml);
			fclose($h);
			$this->response->addParameter('message', '<br /><br />Mapa została wygenerowana.<br /><br /><br /><br /><a href="../sitemap.xml" target="_blank">sitemap.xml</a>');

	}else{
		
		if($_SESSION['user']['permit']['modules'][$_GET['mod']] && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['edit']){
			$this->response->addParameter('message', '<br /><br /><a href="../sitemap.xml" target="_blank">sitemap.xml</a><br />&nbsp;');
		}else{
			$this->response->addParameter('message', '<br /><br /><form method="post" action="index.php?mod=sitemap"><input type="submit" class="form-button" name="confirms" value="Generuj"/></form><br /><br /><br /><a href="../sitemap.xml" target="_blank">sitemap.xml</a><br />&nbsp;');
		}

	}
	}
}

?>