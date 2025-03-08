<?php get_header(); ?>

<section class="main">
    <div class="container general-main">
        <main>
            <h1 class="post-title">
                <?php 
                if ( is_category() ) {
                    // カテゴリアーカイブの場合
                    single_cat_title('Category: ');
                } elseif ( is_tag() ) {
                    // タグアーカイブの場合
                    single_tag_title('Tag: ');
                } elseif ( is_author() ) {
                    // 著者アーカイブの場合：最初の投稿を取得して著者名を出力し、ループを巻き戻す
                    the_post();
                    echo 'Author Archives: ' . get_the_author();
                    rewind_posts();
                } elseif ( is_day() ) {
                    // 日別アーカイブの場合
                    echo 'Daily Archives: ' . get_the_date();
                } elseif ( is_month() ) {
                    // 月別アーカイブの場合
                    echo '月別アーカイブ: ' . get_the_date('Y年m月');
                } elseif ( is_year() ) {
                    // 年別アーカイブの場合
                    echo 'Yearly Archives: ' . get_the_date('Y');
                } else {
                    echo 'Archives';
                }
                ?>
            </h1>

            <?php if ( have_posts() ) : ?>
                <section class="newsBlock">
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
                </section><!-- /.newsBlock -->
                
                <div class="pagination">
                    <?php posts_nav_link(); ?>
                </div>
            <?php else: ?>
                <p>該当する記事は見つかりませんでした。</p>
            <?php endif; ?>
        </main>
    </div><!-- /.container -->
</section><!-- /.main -->

<?php get_footer(); ?>
