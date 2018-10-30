						  <?php
						if($don['type']=='video'){
							
							if(!strstr(htmlspecialchars($don['participation']), 'videoparti')){?>
					<iframe width="100%" style="min-height: 250px;" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($don['participation']);?>" frameborder="0" allowfullscreen></iframe>
				<?php	}
					 if((strstr(htmlspecialchars($don['participation']), '.MP4') OR strstr(htmlspecialchars($don['participation']), '.mp4'))AND strstr(htmlspecialchars($don['participation']), 'videoparti')){
						?>
						<video width="100%" style="min-height: 250px;" controls>
						<source src="<?php echo  htmlspecialchars($don['participation']);?>" type="video/mp4">
						</video>
						<?php
					}
					
				
			}
			if($don['type']=='article'){
				?>
			<!--
		<a href="profilex.php?id=<?php echo htmlspecialchars($_SESSION['id']);?>&affich=<?php echo htmlspecialchars($don['id']);?>">
	 <h4 title="<?php echo htmlspecialchars($don['titre']); ?>"><?php echo substr(htmlspecialchars($don['titre']), 0, 70); ?></h4>
      
    </a> -->
				<?php
			}