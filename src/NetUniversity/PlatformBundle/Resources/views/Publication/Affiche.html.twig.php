	
public function menuAction(){
	
		<?php 
	if(isset($_GET['affich'])){
		
	?>
	
      <div class="w3-card-2 w3-round w3-white w3-center" style="    padding: 7px;    margin: -8px;    margin-bottom: 13px;">
   
	   <div class="w3-container" style="    padding: 2px;">
         		<div style="  
	border: solid 1px #73C5BD;
    background-color: white;
   width: 100%;
    height: 1000px;
    overflow: auto;
    font-size: 11px; ">
		 <ul style="margin-left: -45px;"> 
<?php

			$murarticle= $participation->prepare('SELECT * FROM mur WHERE (idparticipant = :id AND activation = 1) ORDER BY id DESC');
			$murarticle->execute(array('id'=>htmlspecialchars($_GET['id'])));
			$n=0;
			
			while ($don = $murarticle->fetch())
			{ 
		if($don['type']=='article'){
			?>
			
    <li style="<?php if($n%2==1){
		echo "    background-color: #73c5bd; ";
		
	}?>padding: 2px;height:60px;margin: 3px;list-style-type:none;">
	<div> <img style="float:left;width:50px;height:50px;" src="images/pdficon.png"></div>
		<a href="profilex.php?id=<?php echo htmlspecialchars($_GET['id']);?>&affich=<?php echo htmlspecialchars($don['id']);?>">
	 <p style="margin-left:60px;"title="<?php echo htmlspecialchars($don['titre']); ?>"><?php echo substr(htmlspecialchars($don['titre']), 0, 50); ?></p>
      
    </a>
	</li>

			
<?php        }
			 
			?>

	
	
	
	<?php
	
	if($don['type'] == 'video'){ 
			?>
    <li style="<?php if($n%2==1){
		echo "    background-color: #73c5bd; ";
		
	}?>padding: 5px;height:60px;margin: 3px;list-style-type:none;">
	
	
	 <a href="profilex.php?affich=<?php echo htmlspecialchars($don['id']);?>&id=<?php echo htmlspecialchars($_GET['id']);?>">
	 <!--<div style=" float:left; width: 50px; height: 50px; background: rgba(109, 199, 208, 0.25);
    z-index: 2;" title="<?php echo htmlspecialchars($don['titre']);?>">
	
	</div>  -->
	
		
	<?php if(!strstr(htmlspecialchars($don['participation']), 'videoparti')){?>
		
		<div style="width: 50px;
		height: 50px;z-index: 1;">
		<iframe width="50" height="50" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($don['participation']);?>" frameborder="0" allowfullscreen></iframe>
		</div>
		
		<?php	}
		?><?php if((strstr(htmlspecialchars($don['participation']), '.MP4') OR strstr(htmlspecialchars($don['participation']), '.mp4'))AND strstr(htmlspecialchars($don['participation']), 'videoparti')){
			?>
			
			<div style="width: 50px;
		height: 50px;z-index: 1;">
				
				<video width="50"	height=" 50" controls>
					<source src="<?php echo  htmlspecialchars($don['participation']);?>" type="video/mp4">
					</video>
				
			</div>
			
      
			<?php
		}
	?>
	
	

	<div style="margin-top: -45px;margin-left: 60px;">
	<p title="<?php echo htmlspecialchars($don['titre']); ?>"><?php echo substr(htmlspecialchars($don['titre']), 0, 50); ?></p>
</div>
	</a>
	</li>
			
<?php      }
		if($don['type']=='blog'){
		?>
		 <li style="<?php if($n%2==1){
		echo "    background-color: #73c5bd; ";
		
	}?>padding: 5px;height:60px;margin: 3px;list-style-type:none;">
	<div> <img style="float:left;width:50px;height:50px;" src="images/blognet.png"></div>
		<a href="profilex.php?id=<?php echo htmlspecialchars($_GET['id']);?>&affich=<?php echo htmlspecialchars($don['id']);?>">
	 <p style="margin-left:60px;"title="<?php echo htmlspecialchars($don['titre']); ?>"><?php echo substr(htmlspecialchars($don['titre']), 0, 50); ?></p>
      
    </a>
	</li>
<?php		
		}
		$n++;	
			}
			


?>
   </ul> 
        </div>
      </div>
      <br> 
	  </div>
  <?php
	

}
  ?>
}




	<?php 

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
	<?php
		
		if(!strstr(htmlspecialchars($donafich['participation']), 'videoparti') and htmlspecialchars($donafich['type'])== 'video'){?><br><br><br>
		<div >
		<iframe width="100%" style="height: 450px;" style="margin: 0px;    margin-bottom: 90px;" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($donafich['participation']);?>" frameborder="0" allowfullscreen></iframe>
		
		</div>
		<?php	}
		?><?php if((strstr(htmlspecialchars($donafich['participation']), '.MP4') OR strstr(htmlspecialchars($donafich['participation']), '.mp4'))AND strstr(htmlspecialchars($donafich['participation']), 'videoparti')){
			?><br><br><br>
			<div>
				
				<video width="100%" style="height: 450px;" style="margin: -13px;  margin-bottom: 90px;" controls>
					<source src="<?php echo  htmlspecialchars($donafich['participation']);?>" type="video/mp4">
					</video>
				
				
		</div>
			<?php
		}
		elseif(htmlspecialchars($donafich['type'])== 'article'){
			?><br><br><br>
		<div style="height: 720px;width:100%;">
		<iframe height="900px" width="100%"  src="<?php echo htmlspecialchars($donafich['participation']);?>" ></iframe>
		
		</div><br><br><br><br><br><br><br><br><br>
		<?php	
		}
		elseif(htmlspecialchars($donafich['type'])== 'blog'){    ?>
		<div style="width:100%;"><br><br><br>
			 <center><h3 style="    background-color: rgba(0, 150, 136, 0.55);"><?php  echo $donafich['titre']; ?><h3></center>
 <p style="float:right;"><?php echo $donafich['datedepub'];?> </p>
 <br>
 <?php echo $donafich['participation'];?> <hr></div>
 <?php
		}}
		?>
		</div>
			
    </div>
	
	
{{ render(controller("NetUniversityPlatformBundle:CommentairePub:index")) }}