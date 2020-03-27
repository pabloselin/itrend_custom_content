<?php wp_footer(); ?>

<div id="itrend_visualization_footer">
	<div class="container">
		<div class="row flex-row">
			<div class="col m4 logoconecta">
				<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/ConectaResiliencia.png" alt="">
			</div>
			<div class="col m8 logos-footer">
				<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/logos_footer.svg" alt="">
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function(){
		var key = 'hadModal';
        hadModal = localStorage.getItem(key);

        $('#modal-instrucciones').modal('open');

        if(!hadModal) {
			$('#modal-instrucciones').modal('open');
			localStorage.setItem(key, true);
		}
	});
</script>
</body>
</html>