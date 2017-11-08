<base href="<?php echo getenv('URL') ?>">
<title><?php echo isset($title) ? $title : getenv('TITLE') ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="public/src/style/css/global.css">
<script src="public/src/plugins/bower/jquery/dist/jquery.min.js"></script>
<script src="config.js"></script>
<script type="text/javascript" src="public/src/js/functions.js"></script>

<?php if (isset($resources)) {
	foreach($resources as $resource) {
		$ext = pathinfo($resource, PATHINFO_EXTENSION);
		if ($ext === 'js') {
			echo '<script src="public/src/' . $resource . '"></script>' . "\n\r";
		}
		else if ($ext === 'css') {
			echo '<link rel="stylesheet" type="text/css" href="public/src/' . $resource . '">' . "\n\r";
		}
	}
}
?>