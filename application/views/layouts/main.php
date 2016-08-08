<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Asosiasi Pengusaha Kesehatan Dan Kecantikan Indonesia</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php
		// Page Title
		if(isset($theme['assets']['header']['title']))
			echo $this->template->get_title() . "\n";

		// Meta Tags
		if(isset($theme['assets']['header']['meta'])) {
			foreach($this->template->get_meta() as $meta_tag) {
				echo $meta_tag . "\n";
			}
		}

		// Custom CSS Files
		if(isset($theme['assets']['header']['css'])) {
			foreach($this->template->get_css() as $css_file) {
				echo $css_file . "\n";
			}
		}

		// Custom JS Files
		if(isset($theme['assets']['header']['js'])) {
			foreach($this->template->get_js('header') as $js_file) {
				echo $js_file . "\n";
			}
		}
	?>	


<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--lightboxfiles-->
<script type="text/javascript">
	$(function() {
	$('.team a').Chocolat();
	});
</script>		
<script type="text/javascript">
	$(function() {
		$(' #da-thumbs > li ').each(function() {
			$(this).hoverdir();
		});
	});
</script>
<!--script-->

</head>
<body>
	<!-- Header -->
	<?php  
	  	if(isset($parts['header'])) {
            echo $parts['header'];
        }  	
	?>
	<!-- Eof Header -->

	<!-- Banner -->
	<?php  
	  	if(isset($parts['banner'])) {
            echo $parts['banner'];
        }  	
	?>
	<!-- Eof Banner -->

	<!-- Content -->
	<?php 
        if(isset($content)) {
            echo $content;
        }
    ?>
	<!-- Eof Content -->

	<!-- Posts -->
	<?php  
	  	if(isset($parts['posts'])) {
            echo $parts['posts'];
        }  	
	?>
	<!-- Eof Posts -->
			
	<!-- Footer -->
	<?php  
	  	if(isset($parts['footer'])) {
            echo $parts['footer'];
        }  	
	?>
	<!-- Eof Footer -->

	<?php
        // Custom JS Files
        if(isset($theme['assets']['footer']['js'])) {
            foreach($this->template->get_js('footer') as $js_file) {
                echo $js_file . "\n";
            }
        }

    ?>
</body>
</html>