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
    <div class="container general-main">
    <!--Layer2 (class属性を2つ付与)-->
        <main>
        <!--Layer3 (START CONTENTS)-->
        	<!--functions.phpで定義した動的なパンくずリストの呼び出し-->
            <?php custom_breadcrumb(); ?>
            
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
            ?>

            <div class="general-main-container">
                <h1 class="post-title"><?php the_title(); ?></h1>
            </div>

            <div class="entry-info">
                <div class="entry-time">
                    <i class="far fa-clock"></i>
                    <time class="post-time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d (D)'); ?></time>
                </div>

                <div class="entry-update">
                    <i class="fa-solid fa-rotate"></i>
                    <time class="modified-time" datetime="<?php the_modified_time('Y-m-d'); ?>"><?php the_modified_time('Y/m/d (D)'); ?></time>
                </div>

                <div class="entry-tag">
                    <i class="fas fa-tag"></i>
                    <?php the_category('&nbsp;|&nbsp;'); ?>
                </div>
            </div>


			<!-- ここでアイキャッチ画像を表示 -->
<!-- ================================================================================================== *
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('full');
                    ?>
                </div>
            <?php endif; ?>
* ================================================================================================== -->
            <div class="general-main-description">
                <?php the_content(); ?>
            </div>

            <div class="postNavi">
                <span class="prev"><?php previous_post_link('%link','<i class="far fa-arrow-alt-circle-left"></i> %title', true); ?></span>
    			<span class="separator">&nbsp;&nbsp;&nbsp;&nbsp;</span>
   				<span class="next"><?php next_post_link('%link','%title <i class="far fa-arrow-alt-circle-right"></i>', true); ?></span>
            </div>
            
            <?php 
                endwhile;
            endif;
            ?>
        </main><!-- main -->


        <aside class="sidebar">
        <?php get_sidebar('author'); ?>
        <?php get_sidebar('categories'); ?>
            <?
            //php get_sidebar('archives');
            ?>
        </aside><!-- aside -->


    </div><!-- /.container -->
</section>

<?php get_footer(); ?>