
         <p class="w3-center"><img src="<?php echo htmlspecialchars($donnes['photo_mombre']);?>" class="w3-circle" style="height:130px;width:106px" alt="Avatar"></p>
         <p><center> <?php echo htmlspecialchars($donnes['prenom']).' '.htmlspecialchars($donnes['nom']) ;?> </center></p>
		 
		  <div style="    margin-bottom: 39px;">
		 
			<div style="float:left;"><?php if($donnes['blog']!=''){echo '<a target="_blank" href="'.$donnes['blog'].'">';} ?>
			<img src="<?php if($donnes['blog']!=''){echo 'images/blogon.png';}
							else{echo 'images/blogoff.png';}?>" style="width:20px;" /><?php if($donnes['blog']!=''){echo '</a>';}	?>
			</div>
			<div style="float:left;"><?php if($donnes['linkedin']!=''){echo '<a target="_blank" href="'.$donnes['linkedin'].'">';} ?>
			<img src="<?php if($donnes['linkedin']!=''){echo 'images/inon.png';}
							else{echo 'images/inoff.png';}?>" style="width:25px;" /><?php if($donnes['linkedin']!=''){echo '</a>';}	?>
			</div>
			<div style="float:left;"><?php if($donnes['facebook']!=''){echo '<a target="_blank" href="'.$donnes['facebook'].'">';} ?>
			<img src="<?php if($donnes['facebook']!=''){echo 'images/faceon.png';}
							else{echo 'images/faceoff.png';}?>" style="width:20px;" /><?php if($donnes['facebook']!=''){echo '</a>';}	?>
			</div>
			<div style="float:left;"><?php if($donnes['twitter']!=''){echo '<a target="_blank" href="'.$donnes['twitter'].'">';} ?>
			<img src="<?php if($donnes['twitter']!=''){echo 'images/twiton.png';}
							else{echo 'images/twitoff.png';}?>" style="width:25px;" /><?php if($donnes['twitter']!=''){echo '</a>';}	?>
			</div>
			<div style="float:left;"><?php if($donnes['lien']!=''){echo '<a target="_blank" href="'.$donnes['lien'].'">';} ?>
			<img src="<?php if($donnes['lien']!=''){echo 'images/lienon.png';}
							else{echo 'images/lienoff.png';}?>" style="width:20px;" /><?php if($donnes['lien']!=''){echo '</a>';}	?>
			</div>
			
			</div>

         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo htmlspecialchars($donnes['titre']);?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php echo htmlspecialchars($donnes['adresse']);?></p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo htmlspecialchars($donnes['naissance']);?></p>
		 <p><?php
	
	if(isset($_SESSION['id'])){
	if((htmlspecialchars($_GET['id'])!=htmlspecialchars($_SESSION['id']))){
		
		if(isset($_GET['valid']) and htmlspecialchars($_GET['valid'])=='abonne' ){
			$sabonne = $bdd->prepare('INSERT INTO abonnement(abonne, avec, datedabonnement)VALUES(:abonne, :avec, NOW())');
			$sabonne->execute(array('abonne' => htmlspecialchars($_SESSION['id']),
									'avec' => htmlspecialchars($_GET['id'])	  ));
									
			echo "<p style=\"color: #73C54C;margin-left: 40px;\">Vous ètes abonné(e) avec ";echo htmlspecialchars($donnes['prenom']) ; echo " </p>"; 
		}
		if(isset($_GET['valid']) and htmlspecialchars($_GET['valid'])=='desabonne' ){
			$sabonne = $bdd->prepare('DELETE FROM abonnement WHERE abonne = :abonne AND avec = :avec ');
			$sabonne->execute(array('abonne' => htmlspecialchars($_SESSION['id']),
									'avec' => htmlspecialchars($_GET['id'])	  ));
									
			echo "<p style=\"color:red;margin-left: 40px;\">Vous ètes désabonné(e) avec ";echo htmlspecialchars($donnes['prenom']) ; echo " </p>"; 
		}
		$verification= $bdd->prepare('SELECT * FROM abonnement WHERE abonne = :abonne AND avec= :avec');
		$verification->execute(array('abonne' => htmlspecialchars($_SESSION['id']),
									'avec' => htmlspecialchars($_GET['id'])));
		if(!($abonnement=$verification->fetch())){
		?>
		<form action="profilex.php?id=<?php echo htmlspecialchars($_GET['id']);?>&valid=abonne" method="POST" >
		<input  type="hidden" value="<?php echo htmlspecialchars($_GET['id']);?>" name="abonne"/>
		<input class="btn btn-primary" role="button"style="margin-left: 40px;background-color: rgb(109, 199, 208);" 
		type="submit" title="S'abonner" value="S'abonner">
		
		<?php
		}
		else{
			?>
			<form action="profilex.php?id=<?php echo htmlspecialchars($_GET['id']);?>&valid=desabonne" method="POST" >
		<input type="hidden" value="<?php echo htmlspecialchars($_GET['id']);?>" name="desabonne"/>
		<input class="btn btn-primary" role="button"style="margin-left: 40px;background-color: rgb(255, 47, 0);" 
		type="submit" title="Désabonner" value="Désabonner"></form>
			<?php
		}
	}
	}
	}
	
     ?> 
</p>