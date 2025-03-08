<!-- ================================================================================================== *
*
* []header []nav []main [○]footer
*
* ================================================================================================== -->
<footer>
<!--Layer1-->
	<div class="container footer-container">
    <!--Layer2 (class属性を2つ付与)-->
        <div class="footer-inner">
        <!--Layer3 (START CONTENTS)-->
			<nav class="footer-nav">
			    <?php
			    wp_nav_menu( array(
			        'theme_location' => 'footer',
			        'container'      => false,
			        'menu_class'     => 'footer-nav',
			        'depth'          => 1,  // これで親ページのみ表示
			    ) );
			    ?>
			</nav>
            <p class="copyright"><small>© 2025 KANNAMI</small></p>
        </div><!-- /.footer-inner -->
    </div><!-- /footer-container -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
