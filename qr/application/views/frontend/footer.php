		<?php if (@$home_popup->content && @$home_popup->display == 1) {?>
		<div id="info_popup">
			<?=@$home_popup->content;?>
		</div>
		<style>
		#info_popup {display: none;}
		img.cboxPhoto { width:100% !importatnt; }
		</style>
		<?php } ?>
		
	<footer id="page-footer">
		
	</footer>
		
</div>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="<?=base_url('assets/js/360degreesview.js')?>" type="text/javascript" ></script>
	<script type="text/javascript">
		var crl = circlr('circlr', {
			scroll : true,
			loader : 'loader'
		});
	</script>	
	<script src="<?=base_url('assets/plugins/owl-carousel/js/owl.carousel.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/core.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/script.js')?>" type="text/javascript"></script>
	<?=@$global_footer_code;?>
	<?=@$post_footer_code;?>