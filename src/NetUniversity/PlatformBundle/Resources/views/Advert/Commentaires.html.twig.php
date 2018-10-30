<?php	
	if(isset($_GET['affich'])){
	
	



$commentaires=$bdd->prepare('SELECT * FROM commentaires WHERE (idmur= :idmur AND activation = 1)');
$commentaires->execute(array('idmur' => htmlspecialchars($_GET['affich'])));

?>
<div class="w3-container w3-card-2 w3-white w3-round w3-margin">

  
            <h3>Commentaires</h3>

            <!-- commentlist -->

<div style=" background-color: <?php
	$n=1;  if($n%2==1){echo "#eee";}else{echo "#fff";}
	  ?>; ;">
<?php


while($commentaire = $commentaires->fetch()){
	
	?>
			
			 
      <div style="padding:10px 30px;  background-color:<?php
	  if($n%2==1){echo "#eee";}else{echo "#fff";}
	  ?> ;"class="media-object-default">
        <?php  if(isset($_SESSION['id'])){?>
	<!--	<ul style="float: right; background: #6dc7d0;"class="nav navbar-nav navbar-right hidden-sm">
				<li class="dropdown"> <a style="color: #FFFFFF;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php
						if($_SESSION['grad']=='admin'){
						?><li><a href="message.php?mess=ecrire&destinatere=<?php echo htmlspecialchars($commentaire['idproprietaire']);?>">L'envoyer un message</a></li>
						<?php  }  ?>
						<li>
							<center>
							<form  action="#" method="post" enctype="multipart/form-data">
								<input type="hidden" name="mod"  value="supprimer">
								<input type="hidden" name="repsupr"  value="<?php echo $commentaire['id'];?>">
								<input class="btn btn-primary" role="button"style="background-color: white;color: black;border: white;" type="submit" title="Contenu indésirable" value="Contenu indésirable">
							</form>
							</center>
						</li>
						
						<?php
						if($_SESSION['grad']=='admin'){
						?>
						<li>
						<center>
							<form  style=""action="gestion.php?mode=supcompte" method="post" enctype="multipart/form-data">
							<input type="hidden" name="idmembre"  value="<?php echo htmlspecialchars($commentaire['idproprietaire']);?>">
							<input class="btn btn-primary" role="button"style="    background-color: rgb(255, 47, 0);" type="submit" title="Le Désactiver" value="Désactiver ce membre">
							</form> 
						</center>
						</li>
						<?php
						}
						?>
					</ul>
			   </li>
			</ul>  -->
		<?php } ?>
		
			<div class="media">
		<?php 		$repandeur = $bdd->prepare('SELECT * FROM coordonnemombre WHERE id= :id');
					$repandeur->execute(array('id' => htmlspecialchars($commentaire['idproprietaire'])));
										
					$donrepandeur = $repandeur->fetch();//données du repondeur du sujet?>
          <div style="width:80px;" class="media-left"> <img style="max-width:70px;max-height:150px;" class="avatar" src="<?php echo htmlspecialchars($donrepandeur['photo_mombre']);?>" alt=""></div>
          <div style="  " class="media-body">
            <p class="media-heading"><a href="profilex.php?id=<?php echo htmlspecialchars($commentaire['idproprietaire']);?>"><?php 
			
					
					echo htmlspecialchars($donrepandeur['prenom']);
			?></a> 
			</p>
             <p class="comment-time" datetime="<?php echo $commentaire['datecommentaire'];?>"><?php echo $commentaire['datecommentaire'];?></p>
			
			<p ><?php echo nl2br (htmlspecialchars($commentaire['lecommentaire']));?></p>
			<br><img style="max-width:780px;position:absolue;max-height:2000px;" src="<?php echo htmlspecialchars($commentaire['image']);?>"/>
		</div>
      </div>
    </div><br>

	
	<?php $n++;
}
?>
</div>
 </div> 
 <!-- Commentlist End -->
<?php
if(isset($_SESSION['id'])){
?>


   <!-- respond -->
           <br><br>
		   <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
               <h3>Laisser un commentaire</h3>

               <!-- form -->
<form action="#" method="POST" enctype="multipart/form-data"> 				
<div style="padding:2%;">

                 <label   style="vertical-align: top;">Votre commentaire : </label> 
<textarea class="form-control" style="width: 100%; height: 250px; max-width: 500px; max-height: 250px;" name="commentaire" rows="8" cols="100"></textarea><br>
<label style="vertical-align: top;">Ajouter à une image : </label>  <br>
<input  class="form-control" style="" type="file" name="image" /><br />
<br><input class="btn btn-default" type="submit" value="Envoyer"/>
</form> 
</div>
					</div> 
				   <!-- Form End -->

             <!-- Respond End -->
			 <div class="journal-bottom-nav">

               <ul class="bottom-nav">
                 
                  <li><a href="#top">Back to Top<i></i></a></li>
               </ul>

            </div>
			

<?php
	}
}


?>
</div>
	<?php } ?>