	
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