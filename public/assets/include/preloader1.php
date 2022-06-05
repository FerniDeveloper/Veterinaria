<script src="vendors/scripts/core.js"></script>
<script src="assets/js/funciones.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
	var matcher = window.matchMedia('(prefers-color-scheme: dark)');
	matcher.addListener(onUpdate);
	onUpdate();

	function onUpdate() {
	  if (matcher.matches) {
	    $('link#light-scheme-icon').remove();
	    document.head.append($('link#dark-scheme-icon'));
	  } else {
	    document.head.append($('link#light-scheme-icon'));
	    $('link#dark-scheme-icon').remove();
	  }
	}
</script>

<?php require("assets/include/seshead.php"); ?>

<?php require("assets/include/sesadmin.php"); ?>
<?php if (isset($_SESSION['VSPINT'])) {
	?>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img style="width: 250px;" src="vendors/images/logo_veterianria.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Cargando...
			</div>
		</div>
	</div>
	<?php
}
?>
