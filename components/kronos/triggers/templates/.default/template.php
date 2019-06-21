<?
$this->SetViewTarget('triggers', 100);
?>
<div class="content-head d-tb-none">

	<div class="container-fluid">

		<div class="content-head__row">

			<div class="content-head__col">
				<? include($_SERVER['DOCUMENT_ROOT'].'/local/include/templates/triggers.php'); ?>
			</div>

			<div class="content-head__col">
				<? include($_SERVER['DOCUMENT_ROOT'].'/local/include/templates/videos.php'); ?>
			</div>

		</div>

	</div>

</div>
<?
$this->EndViewTarget();
