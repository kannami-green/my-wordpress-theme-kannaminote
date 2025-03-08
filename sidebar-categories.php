        <!--Layer3 (START CONTENTS)-->
        <!-- asideは補足情報のセクションであることを示す -->
        <div class="recentCategories">
            <p class="sidebar-header">カテゴリ一覧</p>
            <ul class="sidebar-categories">
                <?php
                $args = array(
                'title_li' => '', //見出しを削除
                'show_count' => true, //投稿数を表示
                );
                wp_list_categories( $args );
                ?>
            </ul>
        </div>