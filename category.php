<?php get_header(); ?>

<section class="main">
    <div class="container general-main">
        <main>
            <h1 class="post-title">
                <?php 
                if ( is_category() ) {
                    single_cat_title('カテゴリ: ');
                } else {
                    echo 'Category Archive';
                }
                ?>
            </h1>
            
            <?php if ( category_description() ) : ?>
                <div class="archive-meta">
                    <?php echo category_description(); ?>
                </div>
            <?php endif; ?>
            
            <!-- 検索結果ページと同様に "newsBlock" でループ部分をラップ -->
            <section class="newsBlock">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="news">
                            <div class="news-text">
                                <div class="entryInfo">
                                    <time class="news-time" datetime="<?php the_time('Y-m-d'); ?>">
                                        <?php the_time('Y/m/d (D)'); ?>
                                    </time>
                                    <div class="categories">
                                        <?php echo '&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
                                        <i class="fas fa-tag"></i>
                                        <?php the_category(' | '); ?>
                                    </div>
                                </div>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php the_excerpt(); ?>
                                <p>[<a href="<?php the_permalink(); ?>">続きを読む</a>]</p>
                            </div>
                            <figure class="news-figure">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('custom-thumb'); ?>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-noimage300.png" height="180" width="180" alt="No Image">
                                    </a>
                                <?php endif; ?>
                            </figure>
                        </article><!-- /.news -->
                    <?php endwhile; ?>
                    
                    <div class="pagination">
                        <?php posts_nav_link(); ?>
                    </div>
                <?php else: ?>
                    <p>このカテゴリに該当する記事は見つかりませんでした。</p>
                <?php endif; ?>
            </section><!-- /.newsBlock -->
        </main>
    </div><!-- /.container -->
</section><!-- /.main -->

<?php get_footer(); ?>
