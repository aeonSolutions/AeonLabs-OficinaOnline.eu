
 
 
 <?php
 //check if its an ajax request, exit if not
 if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'):
 
     //exit script outputting json data
     $output = json_encode(
     array(
         'type'=>'error', 
         'text' => 'Request must come from Ajax'
     ));
     
     die($output);
 endif;
 
 //cotação
 if(isset($_POST["userName"]) and isset($_POST["userEmail"]) and isset($_POST["userPhone"]) and isset($_POST["userMessage"])):
 	$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"perguntar")); // file system path
 
 	if($_POST["userName"]<>'' and $_POST["userEmail"]<>'' and $_POST["userPhone"]<>'' and $_POST["userMessage"]<>''): // é uma cotação
 		$output = json_encode(
 		array(
 		    'type'=>'error', 
 		    'text' => 'Cotação nao está disponivel'
 		));
 		
 		die($output);
 		
 		
 		
 		
 		    $to_Email       = "mtpsilva€icloud.com"; //Replace with recipient email address
 		    $subject        = 'Oficina Online Quote ORDER!'; //Subject line for emails
 		    
 		    
 		
 		    
 		
 		
 		    //Sanitize input data using PHP filter_var().
 		    $user_Name        = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
 		    $user_Email       = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
 		    $user_Phone       = filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);
 		    $user_Message     = filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING);
 		    
 		    //additional php validation
 		    if(strlen($user_Name)<4) // If length is less than 4 it will throw an HTTP error.
 		    {
 		        $output = json_encode(array('type'=>'error', 'text' => 'Insira o primeiro e último nome!'));
 		        die($output);
 		    }
 		    if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
 		    {
 		        $output = json_encode(array('type'=>'error', 'text' => 'Insira um email válido!'));
 		        die($output);
 		    }
 		    if(!is_numeric($user_Phone)) //check entered data is numbers
 		    {
 		        $output = json_encode(array('type'=>'error', 'text' => 'Insira um número de telefone válido!'));
 		        die($output);
 		    }
 		    if(strlen($user_Message)<5) //check emtpy message
 		    {
 		        $output = json_encode(array('type'=>'error', 'text' => 'Indique aqui a marca do carro, o modelo, ano e peças, componentes ou acessórios que procura.'));
 		        die($output);
 		    }
 		    
 		    //proceed with PHP email.
 		
 		    /*
 		    Incase your host only allows emails from local domain, 
 		    you should un-comment the first line below, and remove the second header line. 
 		    Of-course you need to enter your own email address here, which exists in your cp.
 		    */
 			
 		
 		
 			
 		    //$headers = 'From: your-name@YOUR-DOMAIN.COM' . "\r\n" .
 		    $headers = 'From: '.$user_Email.'' . "\r\n" . //remove this line if line above this is un-commented
 		    'Reply-To: '.$user_Email.'' . "\r\n" .
 		    'X-Mailer: PHP/' . phpversion();
 		    
 		        // send mail
 			$user_Message='Formulário submetido Oficina Online'.chr(13).'Nome: '.$user_Name.chr(13).'Phone:'.$user_Phone.chr(13).'Compomente/Peça:'.$user_Message;	
 		    $sentMail = @mail($to_Email, $subject, $user_Message, $headers);
 		    
 		    if(!$sentMail)
 		    {
 		        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
 		        die($output);
 		    }else{
 		        $output = json_encode(array('type'=>'message', 'text' => 'Bem vindo, '.$user_Name .' dentro em breve receberá um email com o preço.'));
 		        die($output);
 		    }
 		}
 		
 		
 		
 		
 		
 	elseif($_POST["userMessage"]<>''): // é uma pergunta
 	
 	
 		if($_POST["EnableAdvOpt"]<>''): // selected advanced options
 			include($server['root']['path'].'/perguntar/inicio.php');
 		endif;
 	endif;
 
 else:
     $output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
     die($output);
 endif;
 
 ?>
