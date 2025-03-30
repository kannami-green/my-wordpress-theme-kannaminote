<?php
//スタイルのエンキュー
//テーマが読み込まれる際に sanitize.css と styles.css が指定したバージョン番号とともに head 内に出力される（cssファイル更新後にここのバージョンを更新する→キャッシュ更新を促す）
function mytheme_enqueue_styles() {
    wp_enqueue_style( 'mytheme-sanitize', get_template_directory_uri() . '/css/sanitize.css', array(), '1.0' );  // sanitize.css を読み込む（バージョン番号を指定）
    wp_enqueue_style( 'mytheme-style', get_template_directory_uri() . '/css/styles.css', array('mytheme-sanitize'), '2.20' );  // styles.css を読み込む（sanitize.css に依存させ、バージョン番号を指定）
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );


//管理画面のアイキャッチ画像投稿、カスタムメニュー機能を使用可能にする
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );


//カスタムサムネイルの定義
//WordPress の the_post_thumbnail() で出力されるサイズは "thumbnail" サイズ（通常 150×150）となるため180×180で表示するカスタムサイズを定義する
add_image_size('custom-thumb', 180, 180, true);


//動的なパンくずリストを生成する自作関数を定義
function custom_breadcrumb() {
    // パンくずリストの開始タグ
    echo '<div class="pankuzu">';
    echo '<ol>';
    // HOMEリンク
    echo '<li><a href="' . home_url() . '">HOME</a></li>';

    if ( is_category() || is_single() ) {
        // 投稿の場合
        if ( is_single() ) {
            $categories = get_the_category();
            if ( $categories ) {
                // 最初のカテゴリを使用
                $cat = $categories[0];
                // カテゴリ階層を取得して出力（セパレーターは </li><li> で区切る）
                $cat_parents = get_category_parents($cat, true, '</li><li>');
                // もし$cat_parentsが正常取得できた場合のみ末尾処理
                if ( $cat_parents && ! is_wp_error($cat_parents) ) {
                    // 末尾の "</li><li>" を削除
                    $cat_parents = rtrim($cat_parents, "</li><li>");
                    echo '<li>' . $cat_parents . '</li>';
                }
            }
            // 最後に投稿タイトル
            echo '<li>' . get_the_title() . '</li>';
        } elseif ( is_category() ) {
            // カテゴリアーカイブの場合
            echo '<li>' . single_cat_title( '', false ) . '</li>';
        }
    } elseif ( is_page() ) {
        // 固定ページの場合
        global $post;
        if ( $post->post_parent ) {
            // 親ページがある場合、祖先ページを逆順で出力
            $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
            foreach ( $ancestors as $ancestor ) {
                echo '<li><a href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
            }
        }
        // 現在のページタイトル
        echo '<li>' . get_the_title() . '</li>';
    } elseif ( is_search() ) {
        echo '<li>Search results for "' . get_search_query() . '"</li>';
    } elseif ( is_404() ) {
        echo '<li>404 Not Found</li>';
    }

    echo '</ol>';
    echo '</div>';
}


//MathJax（記事への数式埋め込み）のエンキュー
function mytheme_enqueue_mathjax() {
    $mathjax_config = "
        window.MathJax = {
            tex: { inlineMath: [['\\\\(', '\\\\)']], displayMath: [['\\\\[', '\\\\]']] },
            chtml: { displayAlign: 'left' },
            options: { ignoreHtmlClass: 'tex2jax_ignore', processHtmlClass: 'tex2jax_process' }
        };
    ";
    wp_register_script( 'mathjax', 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js', array(), null, true );
    wp_add_inline_script( 'mathjax', $mathjax_config, 'before' );
    wp_enqueue_script( 'mathjax' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_mathjax' );


//WordPress の管理画面から編集できる「フッターメニュー」として動的に管理する自作関数を定義
function mytheme_register_menus() {
    register_nav_menus( array(
        'footer' => __( 'Footer Menu', 'mytheme' ),
    ) );
}
add_action( 'after_setup_theme', 'mytheme_register_menus' );


//JavaScriptをエンキューする関数
function mytheme_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('mytheme-common', get_template_directory_uri() . '/js/hamburger-script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

