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
		}
		?>