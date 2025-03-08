        <!--Layer3 (START CONTENTS)-->
        <!-- asideは補足情報のセクションであることを示す -->
        <div class="recentArchives">
            <p class="sidebar-header">月別アーカイブ</p>
            <ul class="sidebar-archives">
                <?php 
                $args = array(
                'type' => 'monthly', //月別を指定
                'show_post_count' => true, //投稿数を表示
                );
                wp_get_archives( $args );
                ?>
            </ul>
        </div>