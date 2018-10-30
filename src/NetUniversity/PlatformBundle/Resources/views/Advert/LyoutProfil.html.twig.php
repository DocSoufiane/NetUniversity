<!-- بـسم الله الرحمـن الرحيم -->
<!DOCTYPE html>
<html>
<?php include("title.php");?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="mode2.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!--  menu top  -->
<?php 
	include("new-menu-top.php");

if(isset($_GET['id'])OR (isset($_GET['id']) AND isset($_GET['affich']))){
	
	$mombre=$bdd->prepare('SELECT * FROM coordonnemombre WHERE id= :id');
	$mombre->execute(array('id'=> htmlspecialchars($_GET['id'])));
	$donnes=$mombre->fetch();
	if( $donnes['activation']!= 0){
?>
<!-- Page Container -->

<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
	  <?php 
	$mombre=$bdd->prepare('SELECT * FROM coordonnemombre WHERE id= :id');
	$mombre->execute(array('id'=> htmlspecialchars($_GET['id'])));
	$donnes=$mombre->fetch(); ?>
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"> Profile</h4>
         {{ include("NetUniversityPlatformBundle:Advert:CartEx.html.twig") }} 
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card-2 w3-round">
        <div class="w3-accordion w3-white">
        	{{ include("NetUniversityPlatformBundle:Advert:MenuProfil.html.twig") }}
        </div>      
      </div>
      <br>
      
      <!-- Interests 
      <div class="w3-card-2 w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Interests</p>
          <p>
            <span class="w3-tag w3-small w3-theme-d5">News</span>
            <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
            <span class="w3-tag w3-small w3-theme-d3">Labels</span>
            <span class="w3-tag w3-small w3-theme-d2">Games</span>
            <span class="w3-tag w3-small w3-theme-d1">Friends</span>
            <span class="w3-tag w3-small w3-theme">Games</span>
            <span class="w3-tag w3-small w3-theme-l1">Friends</span>
            <span class="w3-tag w3-small w3-theme-l2">Food</span>
            <span class="w3-tag w3-small w3-theme-l3">Design</span>
            <span class="w3-tag w3-small w3-theme-l4">Art</span>
            <span class="w3-tag w3-small w3-theme-l5">Photos</span>
          </p>
        </div>
      </div>
      <br>
      
      <!-- Alert Box 
      <div class="w3-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-hover-text-grey w3-closebtn">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Hey!</strong></p>
        <p>People are looking at your profile. Find out who.</p>
      </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
	
	
    
      <?php
		if(!isset($_GET['affich']) AND $donnes['activation']!= 0){
		
			$murarticle= $participation->prepare('SELECT * FROM mur WHERE (idparticipant = :id AND activation = 1)');
			$murarticle->execute(array('id'=>htmlspecialchars($_GET['id'])));
			$n=0;
			if(!($don = $murarticle->fetch())){
			
	?>
	
	<div class="w3-container w3-card-2 w3-white w3-round w3-margin">
	
	<p>
	Je n'est rien piblié !
	</p>
	
	</div>
	
	<?php
			
				
			}
			while ($don = $murarticle->fetch())
			{
			$propr=$bdd->prepare('SELECT * FROM coordonnemombre WHERE (id= :id )');
			$propr->execute(array('id' => htmlspecialchars($don['idparticipant'])));
			$propr = $propr->fetch()
			?>
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
        <img src="<?php echo htmlspecialchars($propr['photo_mombre']);?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity"><?php echo htmlspecialchars($don['datedepub']);?></span>
        <h4><?php echo htmlspecialchars($propr['prenom']);?></h4><br>
		<a href="profilex.php?id=<?php echo htmlspecialchars($propr['id']);?>&affich=<?php echo htmlspecialchars($don['id']);?>">
	 <h4 title="<?php echo htmlspecialchars($don['titre']); ?>"><?php echo substr(htmlspecialchars($don['titre']), 0, 70); ?></h4>
      
    </a>
        <hr class="w3-clear">
          <div class="w3-row-padding" style="margin:0 -16px">
            <div style=" width:100%;" class="w3-half">

			{{ include("NetUniversityPlatformBundle:Advert:AffichPublication.html.twig") }}
			
		
           ?> </div>
        </div>
       <!-- <button type="button" class="w3-btn w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> -->
      </div>
	  			
			
		
				
				<?php
		}
		?>
		      </div>
		<?php
}


	if(isset($_GET['affich'])){
		
		//verifier si le visiteur a visiter cette page ou nn
		
		
		/*il ya deux cas: 
		**le visiteur est connecter, dans ce cas on prend compt a l'id du membre. Il ne doit pas être exister pour ajouter une vu
		**s'il est déconnecter on prend compt a l'id du de la machin. elle ne doit pas être exister pour ajouter une vu
		
		*/
		
		if(isset($_SESSION['id'])){
			$partiafich=$bdd->prepare('SELECT * FROM vus WHERE (idmembre= :id AND url= :url)');
		$partiafich->execute(array('id' => htmlspecialchars($_SESSION['id']), 'url' => htmlspecialchars($url)));
		if(!($donafich=$partiafich->fetch())){
			$vu=$participation->prepare('UPDATE mur SET nbvus=:nb WHERE id= :id');
			$vu->execute(array('id' => htmlspecialchars($_GET['affich']), 'nb' => $donafich['nbvus']+1));
		}
		}
		else{
		$partiafich=$bdd->prepare('SELECT * FROM vus WHERE (idmachin= :id AND url= :url)');
		$partiafich->execute(array('id' => htmlspecialchars($_COOKIE['idmachine']), 'url' => htmlspecialchars($url)));
		if(!($donafich=$partiafich->fetch())){
			$vu=$participation->prepare('UPDATE mur SET nbvus=:nb WHERE id= :id');
			$vu->execute(array('id' => htmlspecialchars($_GET['affich']), 'nb' => $donafich['nbvus']+1));
		}
		}
		
		$partiafich=$participation->prepare('SELECT * FROM mur WHERE (id= :id AND activation= 1)');
		$partiafich->execute(array('id' => htmlspecialchars($_GET['affich'])));
		$donafich=$partiafich->fetch();?>
	
   <!--<div style="height: <?php if(htmlspecialchars($donafich['type'])=='article'){ echo '1098px';} else{echo '535px';} ?>;">  -->
         <div class="w3-container w3-card-2 w3-white w3-round w3-margin">

	<h3 style="margin-bottom: -50px;"><?php echo htmlspecialchars($donafich['titre']); ?> </h3>
			
		
	 	<div>
				{{ include("NetUniversityPlatformBundle:Advert:AlbomeProfil.html.twig") }}
		</div>
			
    </div>
	
	
	{{ include("NetUniversityPlatformBundle:Advert:Commentaires.html.twig") }}
	
	
    <!-- Right Column -->
    <div class="w3-col m2">

 	{{ include("NetUniversityPlatformBundle:Advert:menuAlbume.html.twig") }}
  
  <!--
<div class="w3-card-2 w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Upcoming Events:</p>
          <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button class="w3-btn w3-btn-block w3-theme-l4">Info</button></p>
        </div>
      </div>
      <br>
      
      <div class="w3-card-2 w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Friend Request</p>
          <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
          <span>Jane Doe</span>
          <div class="w3-row w3-opacity">
            <div class="w3-half">
              <button class="w3-btn w3-green w3-btn-block w3-section" title="Accept"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-btn w3-red w3-btn-block w3-section" title="Decline"><i class="fa fa-remove"></i></button>
            </div>
          </div>
        </div>
      </div>
      <br> -->
     
      
      <div class="w3-card-2 w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>
	  <br>
	   
      <div class="w3-card-2 w3-round w3-white w3-padding-16 w3-center">
        <?php include("pub.php");?>
      </div>
      <br>
      

  
    <!-- End Right Column -->
    </div>
  


	  <?php
}
else{
	?>
	
	<div class="w3-container w3-card-2 w3-white w3-round w3-margin">
	
	<p>
	Ce profile n'existe pas!
	</p>
	
	</div>
	
	<?php
	
}
?>
</div>
		
    
  <!-- End Grid -->


<!-- End Page Container -->
</div>
<br>
<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
 <!-- <h5>Footer</h5>  -->
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="http://www.netunivrsity.ma" target="_blank">Soufiane BERJAMY</a></p>
</footer>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html> 