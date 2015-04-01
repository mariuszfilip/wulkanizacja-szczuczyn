<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.page
 */


/**
 * Obsłga modułu stron
 *
 * @package smartsystem.page
 */
class PageAction extends Action {

	public function init() {
		$this->captcha = new Captcha();
		$this->rnd = $this->captcha->rnd_string();
		$this->uid = urlencode( $this->captcha->md5_encrypt ( $this->rnd ) );
		$this->response->addParameter( 'uid', $this->uid );
		$this->cid = $this->captcha->md5_encrypt	( $this->rnd );
		$this->response->addParameter( 'cid', $this->cid );

			$confirm = $this->request->getParameter('confirms');
			
			if( $confirm == 1 && $this->request->getParameter('form') )
			{
				$this->passed = false;
				$validate = $this->validateForm($this->request->getParameter('id'), $this->request->getParameter('form'));
				
				if($this->request->getParameter('cid'))
				{
					if(strlen($this->request->getParameter('cid'))>0)
					{
						$cid = $this->captcha->md5_decrypt ( $this->request->getParameter('cid') );
						if ( $cid == strtoupper($this->request->getParameter('uid')) ) 
							$this->passed = true;
						else
							$this->passed = false;
					}
				}
				
				if($validate == 1 && $this->passed)
				{//echo '1';
					$this->send($this->request->getParameter('id'), $this->request->getParameter('form'));
					$this->response->addParameter('form_message', 'Form sent.');
					$this->response->addParameter('send', '1');
				}
				elseif($validate == 2)
				{//echo'2';
					$this->response->addParameter('form_message', 'Error. Please  fill in all required fields.');
					$this->response->addParameter('send', '2');
				}
				elseif($validate == 1 && !$this->passed)
				{//echo '1';
					$this->response->addParameter('form_message', 'Invalid code!');
					$this->response->addParameter('send', '2');
				}elseif($validate == 3 && $this->passed)
				{//echo '3';
					$this->response->addParameter('form_message', 'Sending error, the same data has already been sent!');
					$this->response->addParameter('send', '2');
				}
			}

	 	$this->genAnkieta($this->request->getParameter('id'));
	}

	public function doAction($param) {
		$param = strip_tags($param);
		
		switch($param) {
			case 'ajax_captcha':
        	$this->ajaxCaptcha();
        	break;
			case 'ajax_gen_new_captcha':
        	$this->ajaxGenNewCaptcha();
        	break;
		}
		
    $id_page = $this->request->getParameter('id');

		if((int)$id_page > 0 ) {
			//dane strony
			$page = new Page($id_page);
			$name = $page->getName();

			//pelna sciezka dla strony
			$node = new PageNode($id_page);
			$node->nodePath($id_page);
			$x = $node->getNodePath();
			$this->response->addParameter('path',$x);
			
			if(empty($name)) {
				$this->response->addParameter('moduletpl','page/templates/empty.tpl');
			} else {
			
				$this->response->addParameter('page',$page);
				$this->response->addParameter('moduletpl','page/templates/page.tpl');
				
				//podstrony dla tej strony
				$nodeList = new PageNode();
				$this->response->addParameter('submenu',$nodeList->getAllChildren((int)$_GET['id']));

				//poprzednie submenu
				$preNode = new PageNode($id_page);
				$prevNode = $preNode->getIdParent();

				$prevName = new PageNode($prevNode);
				$prevName = $prevName->getName();
				if(!$prevName || $prevName=='') $prevName = $name;
				
				$this->response->addParameter('prevsubmenu',$nodeList->getAllChildren($prevNode));
				$this->response->addParameter('prevsubmenuname',$prevName);

				//przypisane pliki
	    	$page_file = new PageFile( $id_page );
		    $this->response->addParameter('addedFiles', $page_file->getFiles());

				//przypisane galerie
	    	$page_gallery = new PageGallery( $id_page );
	   		$this->response->addParameter('gallerys', $page_gallery->getGallerys());
			}

		} else {
			$this->response->addParameter('moduletpl','page/templates/empty.tpl');
		}

	}


    function genAnkieta($pageId)
    {
        $tablica = "_ankieta";
        $tablica2 = "_ankieta_pytania";
        $tablica3 = "_ankieta_odpowiedzi";
        $sql_pytania = "SELECT `id_ankieta`, `topic`, `description`, `e_mail`, `id_smtp_account` FROM `".$tablica."` WHERE `check` = '1' AND `pageId` = '".$pageId."' LIMIT 1";

        $DB = DB::getInstance();
		$stmt = $DB->query($sql_pytania);

		if((int)$stmt && $rs = $stmt->fetchAll(PDO::FETCH_ASSOC))
		{
			$stmt->closeCursor();

			foreach($rs as $row)
			{
				$sql_lista = "SELECT `id`, `topic`, `type`, `required` FROM `".$tablica2."` WHERE `check` = '1' AND `id_ankieta` = '".$row['id_ankieta']."' AND `pageId` = '".$pageId."' ORDER BY `sort`";
				$stmt = $DB->query($sql_lista);
				if($res_lista = $stmt->fetchAll(PDO::FETCH_ASSOC))
				{
      				foreach($res_lista as $row2)
      				{
      					unset($answers);
      					unset($html);
      					//unset($html_label);
      					unset($html_required);

						//$html_label = '<span>'.$row2['topic'].'&nbsp;:</span>';

      					if($row2['type'] == 1)
      					{
		      				$answers = $this->genAnswers($row2['id'],$row2['type']);
      					}
      					elseif($row2['type'] == 2)
      					{
		      				$answers = $this->genAnswers($row2['id'],$row2['type']);
      					}
      					elseif($row2['type'] == 3)
      					{
		      				$required_class = ($row2['required'] == 1) ? ' class="required"' : '';
							$html = '<input'.$required_class.' type="text" name="form_'.$row2['id'].'" value="'.$this->request->getParameter('form_'.$row2['id']).'" />';
      					}
      					elseif($row2['type'] == 4)
      					{
		      				$required_class = ($row2['required'] == 1) ? ' class="required"' : '';
							$html = '<textarea '.$required_class.' name="form_'.$row2['id'].'" cols="10" rows="10" >'.$this->request->getParameter('form_'.$row2['id']).'</textarea>';
							
      					}
      					elseif($row2['type'] == 5)
      					{
		      				$answers = $this->genAnswers($row2['id'],$row2['type']);
      					}
						
						if($row2['required'] == 1) $html .= '<small>*</small>';


      					/*if($row2['required'] == 1)
      					{
      						$html_label = '<small>*</small>'.$row2['topic'];
		      				//$html_required = '<small class="star">*</small>';
      					}
      					else
      					{*/
      						$html_label = $row2['topic'];
      					//}


      					//$html_label = $html_label.'&nbsp;'.$html_required;

                		$lista_pytan[] = array(
                		//'topic' => $row2['topic'],
                		'id' 	=> $row2['id'],
                		'type' 	=> $row2['type'],
                		//'required' => $row2['required'],
						'html' =>	$html,
						'html_label' => $html_label,
						//'html_required' => $html_required,
						'answers' => $answers
                		);
					}
				}

				$ankieta[] = 
				array(
				'id_ankieta' => $row['id_ankieta'], 
				'topic' => $row['topic'], 
				'description' => $row['description'], 
				'e_mail' => $row['e_mail'],
				'pytania' => $lista_pytan
				);
				$_SESSION['wyslij_na_maila'] = $row['e_mail'];
				$_SESSION['id_smtp_account'] = $row['id_smtp_account'];

            	unset($lista_pytan);
			}
		}

		$this->response->addParameter('ankieta', $ankieta);

    } // function genAnkieta()



	function genAnswers($question_id,$question_type)
	{
	    $sql = 'SELECT *
    	FROM
    		`_ankieta_odpowiedzi`
    	WHERE 
    		`id_pytania` =  "'.$question_id.'"
    		AND 
    		`check` = "1"
    	ORDER BY 
    		`sort` ASC';

      	$DB = DB::getInstance();
      	$stmt = $DB->query($sql);
      	if($answers = $stmt->fetchAll(PDO::FETCH_ASSOC))
      	{
      		foreach($answers as $row)
      		{
      			unset($html);
      			unset($html_a_label);


      			$html_a_label = $row['text'];

      			if($question_type == 1)
      			{
      				if($this->request->getParameter('form_'.$question_id) && $this->request->getParameter('confirm'))
      				{
      					$this_field = $this->request->getParameter('form_'.$question_id);
      					if($this_field[$row['id']] == $row['id'])
      					{
      						$checked = 'checked="checked"';
      					}
      					else
      					{
      						$checked = '';
      					}
      				}

      				$html = '<input type="checkbox" class="check" name="form_'.$question_id.'['.$row['id'].']" value="'.$row['id'].'" '.$checked.' />';
      			}
      			elseif($question_type == 2)
      			{
      				if($this->request->getParameter('form_'.$question_id) && $this->request->getParameter('confirm'))
      				{
      					$this_field = $this->request->getParameter('form_'.$question_id);
      					if($this_field == $row['id'])
      					{
      						$checked = 'checked="checked"';
      					}
      					else
      					{
      						$checked = '';
      					}
      				}

      				$html = '<input type="radio" name="form_'.$question_id.'" value="'.$row['id'].'" '.$checked.' /><br />';
      			}
      			
      			elseif($question_type == 5)
      			{
      				if($this->request->getParameter('form_'.$question_id) && $this->request->getParameter('confirm'))
      				{
      					$this_field = $this->request->getParameter('form_'.$question_id);
      					if($this_field == $row['id'])
      					{
      						$checked = 'selected="selected"';
      					}
      					else
      					{
      						$checked = "";
      					}
      				}

      				$html = '<option value="'.$row['id'].'" '.$checked.'>'.$row['text'].'</option>';
      			}

      			$answer[] = array(
      			id => $row['id'],
      			text => $row['text'],
      			check => $row['check'],
      			html => $html,
      			html_a_label => $html_a_label
      			);
      		}
      		
      		return $answer;
      	}
	}



	public function validateForm($pageId, $form_id)
	{
		/**
		 * Pobieramy z bazy wszystkie pola nastepnie odczytujemy je z tablicy POST 
		 * poprzez request->getParameter. Jeżeli wszystkie wymagane zostały prawidłowo
		 * wypełnione przechodzimy do funkcji send(), która wygeneruje wiadomośc e-mail, 
		 * a następnie wyśle ją pod domyślny adres e-mail.
		 */

		$tablica2 = '_ankieta_pytania';
		$DB = DB::getInstance();

		$sql_questions = 'SELECT `id`, `type`, `required` FROM `'.$tablica2.'` WHERE `check` = "1" AND `id_ankieta` = "'.(int)$form_id.'" AND `pageId` = "'.(int)$pageId.'" ';
		$stmt = $DB->query($sql_questions);
		if($res_lista = $stmt->fetchAll(PDO::FETCH_ASSOC))
		{
      		foreach($res_lista as $row)
      		{
      			if($this->request->getParameter('form_'.$row['id']))
      			{
      				$filled = 1;
      			}
      			elseif(!$this->request->getParameter('form_'.$row['id']))
      			{
      				$filled = 0;
      			}

      			if($form_validate != '2' || !$form_validate)
      			{
      				if($row['required'] == 1 && $filled == 0)
      				{
      					$form_validate = '2';
      				}
      				elseif($row['required'] == 1 && $filled == 1 && ( !$form_validate || $form_validate == '1' ) )
      				{
      					$form_validate = '1';
      				}
      			}
						
						
						
						if($this->request->getParameter('cid') == $_SESSION['last_cid'])
							$form_validate = '3';
						else
							$_SESSION['last_cid'] = $this->request->getParameter('cid');

      			$questions[] = array(
      			'id_pytania' 	=> $row['id'],
      			'type'				=> $row['type'],
      			'required'		=> $row['required'],
      			'filled'			=> $filled,
      			'value'				=> $this->request->getParameter('form_'.$row['id'])
      			);
      		}

      		$this->response->addParameter('form_questions', $questions);
      		$this->response->addParameter('form_validate', $form_validate);
      		return $form_validate;
		}
	}
 	

	public function send($pageId,$id_ankieta)
	{
		$_default_email = $_SESSION['wyslij_na_maila'];
		$_FROM = 'Strona '.SITE_NAME.' <'.$_default_email.'>';
		$header = 'Content-Type: text/html; charset="UTF-8"'."\r\n";
		$header .= 'From: '.$_FROM;
		$this->subject = 'Formularz';
		$this->content .= '<html><body>
<style>
*{
	font-size: 11px;
	line-height: 18px;
	color: #54565C;
	font-family: Verdana, sans-serif;
}
</style>';

       	$DB = DB::getInstance();
		$sql_lista = 'SELECT `id`, `topic`, `type` FROM `_ankieta_pytania` WHERE `check` = "1" AND `id_ankieta` = "'.(int)$id_ankieta.'" AND `pageId` = "'.(int)$pageId.'" ORDER BY `sort`';
		$stmt = $DB->query($sql_lista);
		if($res_lista = $stmt->fetchAll(PDO::FETCH_ASSOC))
		{
  			foreach($res_lista as $row2)
  			{
   				unset($answer);

      			if($row2['type'] == 1)
      			{
	     			$answer = $this->showAnswer($row2['topic'],$row2['id'],$row2['type']);
	      			$this->content .= '<br /><br />'.$answer;
  				}
   				elseif($row2['type'] == 2)
   				{
	      			$answer = $this->showAnswer($row2['topic'],$row2['id'],$row2['type']);
	      			$this->content .= '<br /><br />'.$answer;
    			}
    			elseif($row2['type'] == 3)
      			{
      				$this->content .= '<br /><br />'.$row2['topic'].': '.$this->request->getParameter('form_'.$row2['id']).'<br />';
      			}
      			elseif($row2['type'] == 4)
      			{
      				$this->content .= '<br /><br />'.$row2['topic'].': '.$this->request->getParameter('form_'.$row2['id']);
      			}
      			elseif($row2['type'] == 5)
      			{
		      		$answer = $this->showAnswer($row2['topic'],$row2['id'],$row2['type']);
		      		$this->content .= '<br /><br />'.$answer;
      			}
			}
		}

		$this->content .= '<br /><br />Wiadomośc wysłano z komputera o numerze IP: '.$_SERVER['REMOTE_ADDR'].'<br />';
		$this->content .= 'Data wysłania: '.date("Y-m-d H:i:s").'<br /><br />';
    $this->content .= '</body></html>';

		$_MESSAGE .= stripslashes($this->content);
			$page = new Page($pageId);
			$subject = 'Formularz ze strony \''.$page->getName().'\'';
			if($mailer) unset($mailer);
			$mailer = new SNSMailer($_SESSION['id_smtp_account']);
			$mailer->FromName = SITE_NAME;
			$mailer->AddAddress($_default_email);
			$mailer->AddReplyTo($smtp_data['mail'], SITE_NAME);
			$mailer->Subject = $subject;
			$mailer->Body = $_MESSAGE;
			if( $mailer->Send() )
				return true;
			else
				return false;
	}



	public function showAnswer($topic,$question_id, $question_type)
	{
	    $sql = 'SELECT *
    	FROM
    		`_ankieta_odpowiedzi`
    	WHERE 
    		`id_pytania` =  "'.$question_id.'"
    		AND 
    		`check` = "1"
    	ORDER BY 
    		`sort` ASC';

      	$DB = DB::getInstance();
      	$stmt = $DB->query($sql);
      	if($answers = $stmt->fetchAll(PDO::FETCH_ASSOC))
      	{
      		foreach($answers as $row)
      		{
      			if($question_type == 1)
      			{
      				if($this->request->getParameter('form_'.$question_id) && $this->request->getParameter('confirms'))
      				{
      					$this_field = $this->request->getParameter('form_'.$question_id);
      					if($this_field[$row['id']] == $row['id'])
      					{
      						return ''.$topic.': '.$row['text'].'<br />';
      					}
      				}
      			}
      			elseif($question_type == 2)

      			{
      				if($this->request->getParameter('form_'.$question_id) && $this->request->getParameter('confirms'))
      				{
      					$this_field = $this->request->getParameter('form_'.$question_id);
      					if($this_field == $row['id'])
      					{
      						return ''.$topic.': '.$row['text'].'<br />';
      					}
      				}
      			}
      			elseif($question_type == 5)
      			{
      				if($this->request->getParameter('form_'.$question_id) && $this->request->getParameter('confirms'))
      				{
      					$this_field = $this->request->getParameter('form_'.$question_id);
      					if($this_field == $row['id'])
      					{
      						return ''.$topic.': '.$row['text'].'<br />';
      					}
      				}
      			}
      		}
      	}
	}
	
	
  protected function ajaxCaptcha() {
			$passed = false;
			if(strlen($_POST['cid'])>0)
			{
				$cid = $this->captcha->md5_decrypt ( $_POST['cid'] );
				if ( $cid == strtoupper($_POST['uid']) ) 
				{
					$passed = true;
				}
				else {
					$passed = false;
				}
			}elseif(strlen($_GET['cid'])>0)
			{
				$cid = $this->captcha->md5_decrypt ( $_GET['cid'] );
				if ( $cid == strtoupper($_GET['uid']) ) 
				{
					$passed = true;
				}
				else {
					$passed = false;
				}
			}
			echo json_encode($passed);
			die; 
  }
	
	
	protected function ajaxGenNewCaptcha() {
		$data= array('uid'=>$this->uid, 'cid'=>$this->cid);
		echo json_encode($data);
		die; 
  }
	
}
?>