<?php 

 require 'database.php';
 $db = Database::connect();


if(isset($_POST['forminscription'])){
    
   if(!empty($_POST['nom']) and !empty($_POST['email']) and !empty($_POST['mdp'])){
       
      $nom = checkInput($_POST['nom']);
      $prenom = checkInput($_POST['prenom']);
      $email = checkInput($_POST['email']);
      $date = checkInput($_POST['date']);
      $nation = checkInput($_POST['nation']);
//      $phone = checkInput($_POST['phone']);
//      $age = checkInput($_POST['age']);
       
       
       $mdp = md5($_POST['mdp']);
        $mdp2 = md5($_POST['mdp2']);
       
       $nomlength =strlen($nom);
       if($nomlength <= 225){
           
           $reqnom= $db->prepare('SELECT *FROM membre WHERE email=?');
           $reqnom->execute(array($email));
           $pseudexist = $reqnom->rowCount();
           if($pseudexist ==0){
               
           
           
           if($mdp ==$mdp2){
               
               
               
               $insertmbr = $db->prepare('INSERT INTO membre(nom,prenom,date,nation,email,password ) VALUES( ?,?,?,?,?,?)');
               $insertmbr ->execute(array($nom,$prenom,$date,$nation,$email,$mdp));
               $Error = '<div class="alert alert-success">Votre inscription a été effectuer avec success </div>';
               
           }else{
               $Error ='<div class="alert alert-danger">Les deux mots de passe ne sont pas identique!!!</div>';
           }
           
           } else{
               $Error ='<div class="alert alert-danger">Vous ne pouvez pas utliser le même email plus d\'une fois!!!!!</div>';
           }
         
               
       } else{ 
          $Error = " nom ne doit pas depasser 225 caractères";
       
       }
           
       
   } 
    
    else{ 
        
        $Error =  '<div class="alert alert-danger" style="color:red">Tous les champs doivent être obligatoirement remplir!!!!</div>';
        }
    
    
    
    
}


 function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>





<!DOCTYPE html>

<html>
<head>
<title>Inscrition</title>    
       <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<script src="js/jquery.min.js"></script>
    
    
<!--
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
-->
<link rel="stylesheet" type="text/css" href="css/all.min.css">
  <link rel="stylesheet" type="text/css" href="js/all.min.js">
    <link rel="stylesheet" href="css/style.css">
    <script src="script.js"></script>
           
    
</head>
    <body>
        
        <script>
        
        	var i=0;
	$(document).ready(function(){
     $('#add_more').on('click', function(){
      var colorR = Math.floor((Math.random() * 256));
      var colorG = Math.floor((Math.random() * 256));
      var colorB = Math.floor((Math.random() * 256));
      i++;
      var html ='<div id="append_no_'+i+'" class="animated bounceInLeft">'+
//          '<div class="input-group mt-3">'+
//		  '<div class="input-group-prepend">'+
//		  '<span class="input-group-text br-15" style="color:rgb('+colorR+','+colorG+','+colorB+'">'+
//		  '<i class="fas fa-user-graduate"></i></span>'+
//		  '</div>'+
//		  '<input type="text" placeholder="Student Name"  class="form-control"/>'+
//		  '</div>'+
		  '<div class="input-group mt-3">'+
		  '<div class="input-group-prepend">'+
		  '<span class="input-group-text br-15" style="color:rgb('+colorR+','+colorG+','+colorB+'">'+
		  '<i class="fas fa-phone-square"></i></span>'+
		  '</div>'+
		  '<input type="text" name="phone" id="phone" placeholder="Entrer votre numéro si vous voulez " class="form-control"/>'+
		  '</div>'+
		  '<div class="input-group mt-3">'+
		  '<div class="input-group-prepend">'+
		  '<span class="input-group-text br-15" style="color:rgb('+colorR+','+colorG+','+colorB+'">'+
		  '<i class="fas fa-square"></i></span>'+
		  '</div>'+
		  '<input type="text" name="age" id="age" placeholder="Entrer votre fonction si vous voulez" class="form-control"/>'+
		  '</div></div>';

	  $('#dynamic_container').append(html);
	  $('#remove_more').fadeIn(function(){
	  	 $(this).show();
	  });
     });

     $('#remove_more').on('click', function(){
         
         $('#append_no_'+i).removeClass('bounceInLeft').addClass('bounceOutRight')
            .fadeOut(function(){
            	$(this).remove();
            });
            i--;
            if(i==0){
            	$('#remove_more').fadeOut(function(){
            		$(this).hide()
            	});;
            }
   
     });
	});
        
        
        
        </script>
        
        
        
        
        
        
    <div align="center">
        
        
        	<dvi class="container h-100">
	<div class="d-flex justify-content-center">
		<div class="card mt-5 col-md-4 animated bounceInDown myForm">
			<div class="card-header">
				<h4>INSCRIPTION </h4>
			</div>
			<div class="card-body">
				<form method="POST">
                            
        <?php
        
       if(isset($Error)){
            echo '<font color="red">'.$Error.'</font>';
        }
        
        ?>
					<div id="dynamic_container">
						<div class="input-group">
                            
							<div class="input-group-prepend">
								<span class="input-group-text br-15"><i class="fas fa-user"></i></span>
							</div>
							<input type="text"  name="nom" id="nom" placeholder="nom" class="form-control"  value="<?php if(isset($nom)){echo $nom;} ?>"/>
						</div>
                        
                        
                         <div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text br-15"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="prenom" id="prenom" placeholder=" prenom" class="form-control"/>
						</div>
                        
                        <div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text br-15"><i class="fas fa-calendar-alt"></i></span>
							</div>
							<input type="date" name="date" id="date" placeholder=" date de naissance" class="form-control"/>
						</div>
                        
                         <div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text br-15"><i class="fas fa-flag"></i></span>
							</div>
							<input type="text" name="nation" id="nation" placeholder="votre nationnalité" class="form-control"/>
						</div>
                        
                        
                        <div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text br-15"><i class="fas fa-at"></i></span>
							</div>
							<input type="email" name="email" id="email" placeholder=" Email" class="form-control"/>
						</div>
                        
                         
                       
                        
						<div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text br-15"><i class="fas fa-user-lock"></i></span>
							</div>
							<input type="password" name="mdp" id="mdp" placeholder="password" class="form-control"/>
						</div>
                        <div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text br-15"><i class="fas fa-user-lock"></i></span>
							</div>
							<input type="password" name="mdp2" id="mdp2" placeholder="password" class="form-control"/>
						</div>
                        
						
					</div>
                    
                    
                    <div class="card-footer">
                            
				
				<input  type="submit" style="font-size: 20px;"  value="ENVOYER"  name="forminscription" class="btn btn-success btn-sm float-right submit_btn"/>
                   
			</div>
                    
                    
                    
				</form>
			</div>
			
		</div>
	</div>
	</dvi>
        

        
    
    </div>
    

        
    </body>
</html>