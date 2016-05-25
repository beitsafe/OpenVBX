<div class="vbx-content-main">

	<div class="vbx-content-menu vbx-content-menu-top">
		<h2 class="vbx-content-heading">Test-a-roo</h2>
	</div><!-- .vbx-content-menu -->

	<div class="vbx-content-container">
		<div class="vbx-content-section">
			<div class="vbx-form">
				<h3>Receipt of Number passed:</h3>
					<div>
						And here we made it the whole way.... didnt think we could do it huh? 
 						<?php 
 						echo "lets do this for sanity's sake... to: ".$calltonum." and from: ".$callfromnum." ...see no issues with the data!";
 						$html = "<script> $('document').ready(function(){OpenVBX.clientDial({'to': '".$calltonum."', 'callerid': '".$callfromnum."'});}); </script>";
 						echo $html;
 						?>
					</div>
			</div>
		</div><!-- .vbx-content-section -->
	</div><!-- .vbx-content-container -->
	
</div><!-- .vbx-content-main -->