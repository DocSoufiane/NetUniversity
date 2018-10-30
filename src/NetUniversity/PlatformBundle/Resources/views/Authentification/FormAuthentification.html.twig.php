<?php //بـسم الله الرحمـن الرحيم
session_start();
try
{
   $bdd = new PDO('mysql:host=localhost;dbname=netunive_coordonne;charset=utf8', 'netunive_use1', 'kamyoDYALBSSA7');
	$participation = new PDO('mysql:host=localhost;dbname=netunive_participation;charset=utf8', 'netunive_use2', 'kamyoDYALBSSA7');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
		
		}
		include ("authentification.php");
		if(empty($_COOKIE['idmachine'])){
			$mombre=$bdd->query('SELECT MAX(id) AS id_max FROM idmachine');
			$lemax = $mombre->fetch();
			$idmax=$lemax['id_max']+1;
	
 setcookie('idmachine', $idmax, time() + 365*24*3600, null, null, false, true); 
	 $ajout= $bdd->prepare('INSERT INTO idmachine(id, premieredate, dernieredate) VALUES(:id, NOW(), NOW())');
	 $ajout->execute(array(   'id' => $idmax));	
		}
	else{
				$repsup=$bdd->prepare('UPDATE idmachine SET dernieredate= NOW() WHERE id= :id');
				$repsup->execute(array('id'=> htmlspecialchars($_COOKIE['idmachine'])));
		
		}
$url = "http://".$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];    
 if(isset($_SESSION['id'])){
		

			$ajout= $bdd->prepare('INSERT INTO vus(idmachin, idmembre, url, datevu) VALUES(:idmachine, :idmembre, :url, NOW())');
			$ajout->execute(array(   'idmachine' => $_COOKIE['idmachine'], 'idmembre' => $_SESSION['id'], 'url' => $url));	
		}
		else{
			$ajout= $bdd->prepare('INSERT INTO vus(idmachin, url, datevu) VALUES(:idmachine, :url, NOW())');
			$ajout->execute(array(   'idmachine' => $_COOKIE['idmachine'], 'url' => $url));	
		
		}
		?>
<!-- بـسم الله الرحمـن الرحيم -->
<!DOCTYPE html>
<html>
<?php include("title.php");?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="mode2.css">
<body class="w3-content" style="max-width:1300px">

<!-- First Grid: Logo & About -->
<div class="w3-row">
  <div class="w3-half w3-black w3-container w3-center" style="height:700px">
    <div class="w3-padding-64">
      <h1>My Logo</h1>
    </div>
    <div class="w3-padding-64">
      <a href="#con" class="w3-btn w3-btn-block w3-hover-blue-grey w3-padding-16">Se Connecter</a>
     <!--<a href="#work" class="w3-btn w3-btn-block w3-hover-teal w3-padding-16">My Work</a>
      <a href="#work" class="w3-btn w3-btn-block w3-hover-dark-grey w3-padding-16">Resume</a>
      <a href="#contact" class="w3-btn w3-btn-block w3-hover-brown w3-padding-16">Contact</a>-->
    </div>
  </div>
  <div class="w3-half w3-blue-grey w3-container" id="con" style="height:700px">
  
    	<div style="    padding-top: 20%;">
		
		<?php 




?>
		
		
		   <form class="navbar-form navbar-right" 
		  
		   action="new-profil.php" method="post">
	<div class="w3-panel">
      <label>E-mail</label>
	  <input class="w3-input w3-border w3-hover-shadow w3-margin-bottom"  type="text" name="email" />
      <label>Le mot de passe</label>
	  <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" type="password" name="mot_de_passe" />
      <?php if(isset($_POST['validationcompt'])){?><input class="form-control" type="hidden" name="validationcompt" value="<?php echo htmlspecialchars($_POST['validationcompt']);?>" />  <?php  }?>
	  <div class="w3-section">
        <center><button type="submit" value="Se connecter" class="w3-btn w3-red">Se connecter</button></center><br>
		</div> 
	  </form> 
      <center><a  href="javascript:void(0)" onclick="document.getElementById('id03').style.display='block'" class="w3-btn w3-light-grey">S'inscrire</a></center>
	  	  

  </div>
</div>

<!-- Second Grid: Work & Resume -->
<!--
<div class="w3-row">
  <div class="w3-half w3-light-grey w3-center" style="min-height:800px" id="work">
    <div class="w3-padding-64">
      <h2>My Work</h2>
      <p>Some of my latest projects.</p>
    </div>
    <div class="w3-row">
      <div class="w3-half"><p>Photo 1</p>
        <img src="image/color52.jpg" style="width:100%">
      </div>
      <div class="w3-half"><p>Photo 2</p>
        <img src="image/color3.jpg" style="width:100%">
      </div>
    </div>
    <div class="w3-row w3-hide-small">
      <div class="w3-half"><p>Photo 3</p>
        <img src="image/color2.jpg" style="width:100%">
      </div>
      <div class="w3-half"><p>Photo 4</p>
        <img src="image/color4.jpg" style="width:100%">
      </div>
    </div>

    <div class="w3-row w3-hide-small">
      <div class="w3-half"><p>Photo 5</p>
        <img src="image/color4.jpg" style="width:100%">
      </div>
      <div class="w3-half"><p>Photo 6</p>
        <img src="image/color5.jpg" style="width:100%">
      </div>
    </div><br>
    <p>Just call me awesome.</p>
  </div>
  <div class="w3-half w3-indigo w3-container" style="min-height:800px">
    <div class="w3-padding-64 w3-center">
      <h2>Resume</h2>
      <p>A draft from my CV</p>
      <div class="w3-container w3-responsive">
        <table class="w3-table">
          <tr>
            <th>Year</th>
            <th>Title</th>
            <th>Where</th>
          </tr>
          <tr class="w3-white">
            <td>2012-2016</td>
            <td>The rest is history..</td>
            <td>Lorem ipsum</td>
          </tr>
          <tr>
            <td>2009-2012</td>
            <td>Started my own company</td>
            <td>My Garage</td>
          </tr>
          <tr class="w3-white">
            <td>2008-2009</td>
            <td>Started working for Lorem</td>
            <td>London, UK</td>
          </tr>
          <tr>
            <td>2005-2008</td>
            <td>Degree in Bachelor of Design</td>
            <td>Harvard, USA</td>
          </tr>
          <tr class="w3-white">
            <td>2002-2005</td>
            <td>Degree in Bachelor of Business</td>
            <td>RMIT University, Melbourne, Australia</td>
          </tr>
          <tr class="w3-hide-medium">
            <td>2002-2005</td>
            <td>Degree in Bachelor of Business</td>
            <td>RMIT University, Melbourne, Australia</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
-->
<!-- Third Grid: Swing By & Contact 
<div class="w3-row" id="contact">
  <div class="w3-half w3-dark-grey w3-container w3-center" style="height:700px">
    <div class="w3-padding-64">
      <h1>Swing By</h1>
    </div>
    <div class="w3-padding-64">
      <p>..for a cup of coffee, or whatever.</p>
      <p>Chicago, US</p>
      <p>+00 1515151515</p>
      <p>test@test.com</p>
    </div>
  </div>
  <div class="w3-half w3-teal w3-container" style="height:700px">
    <div class="w3-padding-64 w3-padding-xxlarge">
      <h1>Contact</h1>
      <p class="w3-opacity">GET IN TOUCH</p>
      <form class="w3-container w3-card-2 w3-padding-32 w3-white" action="form.asp" target="_blank">
        <div class="w3-group">
          <label>Name</label>
          <input class="w3-input" style="width:100%;" type="text" required name="Name">
        </div>
        <div class="w3-group">
          <label>Email</label>
          <input class="w3-input" style="width:100%;" type="text" required name="Email">
        </div>
        <div class="w3-group">
          <label>Message</label>
          <input class="w3-input" style="width:100%;" type="text" required name="Message">
        </div>
        <button type="submit" class="w3-btn w3-padding w3-right">Send</button>
      </form>
    </div>
  </div>
</div>

<!-- Modal that pops up when you click on "inscription" -->
<div id="id03" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-red">
       <span onclick="document.getElementById('id03').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
      <h2>Inscription </h2>
    </div>
	
	<form class="navbar-form navbar-right" style="margin-top: 50px;" action="#" method="post"><br>
		
		<label style="margin-left:5%;">Choisissez votre titre :</label><br><br>
		
				  <center><div style="margin-left:10%;">
				  
					<input class="form-control" style="float:left;width:500px" placeholder="Nom" type="text" name="nom"><br><br>
			        <input class="form-control" style="float:left;width:500px" placeholder="Prénom" type="text" name="prenom"><br><br>
			
			
			        <input class="form-control" style="float:left;width:500px" placeholder="E-mail" type="email" name="email"><br><br>
            		<input class="form-control" style="float:left;width:500px" placeholder="Confirmation d'email" type="email" name="re-email"><br><br>
					<input class="form-control" style="float:left;width:500px" placeholder="Mot de passe" type="password" name="mot_de_passe"><br><br>
					<input class="form-control" style="float:left;width:500px" placeholder="Confirmation du mot de passe" type="password" name="remot_de_passe"><br><br>
			</div></center>
			  <div class="w3-section">
				<a class="w3-btn w3-red" onclick="document.getElementById('id03').style.display='none'">Cancel  <i class="fa fa-remove"></i></a>
				<input class="w3-btn w3-right w3-light-grey"  type="submit" value="Envoyer"/>
			  </div> 
	</form>
		
    </div>
  </div>
</div>
<!--  finsend media -->

<!-- Footer -->
<footer class="w3-container w3-black w3-padding-16">
  <p>Powered by <a href="http://www.netuniversity.ma" target="_blank">Soufiane BERJAMY</a></p>
</footer>

</body>
</html>
