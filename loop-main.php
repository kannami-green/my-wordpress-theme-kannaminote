                <?php 
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                ?>

                <article class="news">
                    <div class="news-text">
                        <div class="entryInfo">
                            <time class="news-time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d (D)'); ?></time>
                            <div class="categories">
                                <?php echo '&nbsp;&nbsp;&nbsp;&nbsp;'; ?><!-- 投稿日時とカテゴリ間を半角スペース×4 -->
                                <i class="fas fa-tag"> </i>
                                <?php the_category(' | '); ?>
                            </div>
                        </div>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                        <p>[<a href="<?php the_permalink(); ?>">続きを読む</a>]</p>
                    </div>

                    <figure class="news-figure">
                    <?php if( has_post_thumbnail() ): ?>
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('custom-thumb'); ?></a>
                    <?php else: ?>
                        <a href="<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-noimage300.png" height="180" width="180" alt="No Image"></a>
                    <?php endif; ?>
                    </figure>
                </article><!-- /.news -->

                <?php 
                    endwhile;
                endif;
                ?>