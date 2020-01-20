<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="<?= base_url('test/onclick_load') ?>" target="_blank" onClick="openWindowReload(this)">Click here</a>
<input type="text">

</form>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
<script>
			function openWindowReload(link) {
				var href = link.href;
				document.location.reload(true)
			}
		</script>	

</body>
</html>