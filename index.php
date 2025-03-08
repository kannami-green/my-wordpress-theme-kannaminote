<?php get_header(); ?>

<!-- ================================================================================================== *
*
* []header []nav [○]main []footer
*
* ================================================================================================== -->
<!--mainは親要素を<section>として<div class="container">の子要素に設置する（sidebar等を同じ深さに設置するため）-->
<section class="main">
<!--Layer1-->



<!-- ================================================================================================== *
* [○]main：description-BOX
* ================================================================================================== -->
    <div class="container home-main-description">
    <!--Layer2 (class属性を2つ付与)-->
        <main>
        <!--Layer3 (START CONTENTS)-->
            <?php if( is_month() ): ?>
                <h1 class="post-title"><?php the_time('Y年m月'); ?></h1>
            <?php else: ?>
                <h1 class="post-title"><?php wp_title(''); ?></h1>
            <?php endif; ?>
            <section class="newsBlock">

                <!-- 記事一覧 -->
                <?php get_template_part('loop', 'main'); ?>
                
            </section><!-- /.newsBlock -->
        </main><!-- main -->
	</div><!-- /.container -->
</section>

<?php get_footer(); ?>