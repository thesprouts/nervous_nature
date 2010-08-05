<meta name="keywords" content="Nervous System, Design, Computational Design" />
<meta name="description" content="couse materials for the Springs and Things workshop for AIGA Boston">
<meta name="author" content="Nervous System">
<meta name="copyright" content="This website and all of its content are the property of Nervous System unless otherwise specified. Licensed under the Creative Commons Share-Alike 3.0 license.">
<meta name="resource-type" content="document">
<meta name="robots" content="ALL">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="language" content="English">
<meta name="doc-type" content="Web Page">
<meta name="doc-class" content="Published">
<link rel="stylesheet" type="text/css" href="/media/css/style.css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
			     $(".gist").before("<h5 class='code'>shrink</h5>");
			     $(".gist").wrap("<div></div>");
			     $('h5.code').click(function() {
			     $(this).next().slideToggle('fast');
				if(this.innerHTML=='shrink') this.innerHTML='expand';
				else this.innerHTML='shrink';
			     });
$('iframe#textframe').load(function() {
        this.style.height =
        (this.contentWindow.document.body.offsetHeight+20) + 'px';
	//$('div#content').height=this.style.height+100;
    }
);

});
</script>
</head>

<body>
<?php
function menu($url) {
	$page = $_SERVER["REQUEST_URI"];
	$pos = strpos($page,$url);
	if($pos !== false) $style = "class='menuSel'";
	else $style = 'class="menu"';		
	return $style;		
	}
?>
	<div id="content" class="content">
		<div class="menuwrapper">
			<ul class="menu">
			<li class="menu"><a <?php $url = '/education/simulation/index.php';echo menu($url);?> href="<?php echo $url;?>">home</a></li>
			<li class="menu"><a <?php $url='/education/simulation/examples.php';echo menu($url);?> href="<?php echo $url;?>">examples</a></li>
			<li class="menu"><a <?php $url='/education/simulation/links.php';echo menu($url);?> href="links.php">links</a></li>
			</ul>
		</div>
		<div class="bod">
		<div style="width:800px;">
  		<span class="main">Simulation and Nature in Design</span>
  	</div>
	
			