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

            <div class="general-main-description">
                <?php the_content(); ?>
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