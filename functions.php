<?php 
/**
 * header.phpからの移行
 * テーマが読み込まれる際に sanitize.css と styles.css が、指定したバージョン番号とともに head 内に出力される（cssファイル更新を実施したらここのバージョンを更新する→キャッシュ更新を促す）
 */
function mytheme_enqueue_styles() {
    // sanitize.css を読み込む（バージョン番号を指定）
    wp_enqueue_style( 'mytheme-sanitize', get_template_directory_uri() . '/css/sanitize.css', array(), '1.0' );
    
    // styles.css を読み込む（sanitize.css に依存させ、バージョン番号を指定）
    wp_enqueue_style( 'mytheme-style', get_template_directory_uri() . '/css/styles.css', array('mytheme-sanitize'), '2.7' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );


/**
 * 管理画面のアイキャッチ画像投稿を使用可能にする
 */
add_theme_support( 'post-thumbnails' );

/**
 * 管理画面のカスタムメニュー機能を使用可能にする
 */
add_theme_support( 'menus' );

/**
 * WordPress の the_post_thumbnail() で出力されるサイズは、デフォルトでは "thumbnail" サイズ（通常 150×150 など）となるため、180×180 で表示するカスタムサイズを定義する
 */
add_image_size('custom-thumb', 180, 180, true);


/**
 * 動的なパンくずリストを生成する自作関数を定義
 */
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
                // 最初のカテゴリを使用（必要に応じて変更可能）
                $cat = $categories[0];
                // カテゴリ階層を取得して出力（セパレーターは </li><li> で区切る）
                echo '<li>' . get_category_parents( $cat, true, '</li><li>' ) . '</li>';
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


/**
 * MathJax（記事への数式埋め込み）
 */
function mytheme_enqueue_mathjax() {
    // MathJax の設定をインラインスクリプトとして出力（"before" を指定して MathJax ライブラリの前に出力）
    $mathjax_config = "
        window.MathJax = {
            tex: {
                inlineMath: [['\\\\(', '\\\\)']],
                displayMath: [['\\\\[', '\\\\]']]
            },
            chtml: {
                displayAlign: 'left'  // ディスプレイ数式を左寄せにする
            },
            options: {
                ignoreHtmlClass: 'tex2jax_ignore',
                processHtmlClass: 'tex2jax_process'
            }
        };
    ";
    wp_register_script( 'mathjax', 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js', array(), null, true );
    wp_add_inline_script( 'mathjax', $mathjax_config, 'before' );
    wp_enqueue_script( 'mathjax' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_mathjax' );


/**
 * WordPress の管理画面から編集できる「フッターメニュー」として動的に管理する自作関数を定義
 */
function mytheme_register_menus() {
    register_nav_menus( array(
        'footer' => __( 'Footer Menu', 'mytheme' ),
    ) );
}
add_action( 'after_setup_theme', 'mytheme_register_menus' );


/**
 * JavaScriptをエンキューする関数（header.phpから移行）
 */
function mytheme_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('mytheme-common', get_template_directory_uri() . '/js/hamburger-script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

/**
 * CSSとJavaScriptを最適化（高速化）
 * 1. CSSとJSの結合
 * 2. 非同期読み込み
 * 3. 不要なJSの削除
 * 4. CSSの遅延読み込み
 */
function optimize_image_loading() {
    // 遅延読み込み（Lazy Loading）をサポート
    add_theme_support('lazy-loading-images');
}
add_action('after_setup_theme', 'optimize_image_loading');

function optimize_assets() {
    // WordPressのjQueryを削除し、CDNから最新版を読み込む
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), null, true);
        wp_enqueue_script('jquery');
    }
    
    // CSSを遅延読み込みするためのコード
    function add_rel_preload($html, $handle, $href, $media) {
        if (!is_admin()) {
            $html = '<link rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" id="' . $handle . '" href="' . $href . '" type="text/css" media="' . $media . '" />';
            $html .= '<noscript><link rel="stylesheet" id="' . $handle . '" href="' . $href . '" type="text/css" media="' . $media . '" /></noscript>';
            return $html;
        }
        return $html;
    }
    add_filter('style_loader_tag', 'add_rel_preload', 10, 4);
    
    // JavaScriptを非同期で読み込む
    function add_async_attribute($tag, $handle) {
        // 管理画面のスクリプトには適用しない
        if (is_admin()) {
            return $tag;
        }
        
        // WordPressコアのスクリプトには適用しない
        $excluded_scripts = array('jquery');
        if (in_array($handle, $excluded_scripts)) {
            return $tag;
        }
        
        // asyncとdeferを追加
        return str_replace(' src', ' async defer src', $tag);
    }
    add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
    
    // 不要なCSSとJSを削除
    function remove_unnecessary_scripts() {
        if (!is_admin()) {
            // 絵文字関連のアセットを削除
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');
            
            // oEmbedを削除
            remove_action('wp_head', 'wp_oembed_add_discovery_links');
            remove_action('wp_head', 'wp_oembed_add_host_js');
            
            // RSSフィードリンクを削除
            remove_action('wp_head', 'feed_links', 2);
            remove_action('wp_head', 'feed_links_extra', 3);
            
            // RSD Linkを削除
            remove_action('wp_head', 'rsd_link');
            
            // wlwmanifestを削除
            remove_action('wp_head', 'wlwmanifest_link');
        }
    }
    add_action('init', 'remove_unnecessary_scripts');
}
add_action('wp_enqueue_scripts', 'optimize_assets');

/**
 * WebP画像フォーマットのサポートを追加する関数
 * WebP画像を使用することでページロード時間を大幅に削減する
 * この関数はJPG/PNG画像をアップロードする際に自動的にWebP版も生成する
 */
function add_webp_support() {
    // WebP MIMEタイプをWordPressに登録
    function webp_mime_type($mimes) {
        $mimes['webp'] = 'image/webp';
        return $mimes;
    }
    add_filter('mime_types', 'webp_mime_type');
    
    // WebP画像のアップロードを許可
    function webp_upload_check($checked, $file, $filename, $mimes) {
        if (!$checked['type']) {
            $check_filetype = wp_check_filetype($filename, $mimes);
            $ext = $check_filetype['ext'];
            $type = $check_filetype['type'];
            $proper_filename = $filename;
            
            if ($type && 0 === strpos($type, 'image/') && $ext !== 'webp') {
                $ext = $type = false;
            }
            
            $checked = compact('ext', 'type', 'proper_filename');
        }
        return $checked;
    }
    add_filter('wp_check_filetype_and_ext', 'webp_upload_check', 10, 4);
    
    // JPG/PNGがアップロードされた時にWebP版も生成
    function create_webp_on_upload($metadata, $attachment_id) {
        // 画像でない場合は何もしない
        if (!isset($metadata['file'])) {
            return $metadata;
        }
        
        $upload_dir = wp_upload_dir();
        $file = $upload_dir['basedir'] . '/' . $metadata['file'];
        $path_parts = pathinfo($file);
        
        // JPGかPNGの場合のみWebP生成
        $mime_type = get_post_mime_type($attachment_id);
        if ($mime_type == 'image/jpeg' || $mime_type == 'image/png') {
            // オリジナル画像のWebP版を生成
            $webp_file = $path_parts['dirname'] . '/' . $path_parts['filename'] . '.webp';
            
            // GDライブラリがあるか確認
            if (function_exists('imagewebp')) {
                if ($mime_type == 'image/jpeg') {
                    $image = imagecreatefromjpeg($file);
                } else {
                    $image = imagecreatefrompng($file);
                }
                
                if ($image) {
                    imagewebp($image, $webp_file, 80); // 品質80%でWebP生成
                    imagedestroy($image);
                }
            }
            
            // サムネイルのWebP版も生成
            if (isset($metadata['sizes']) && is_array($metadata['sizes'])) {
                foreach ($metadata['sizes'] as $size => $size_info) {
                    $size_file = $path_parts['dirname'] . '/' . $size_info['file'];
                    $size_path_parts = pathinfo($size_file);
                    $size_webp_file = $size_path_parts['dirname'] . '/' . $size_path_parts['filename'] . '.webp';
                    
                    if (function_exists('imagewebp')) {
                        if ($mime_type == 'image/jpeg') {
                            $image = imagecreatefromjpeg($size_file);
                        } else {
                            $image = imagecreatefrompng($size_file);
                        }
                        
                        if ($image) {
                            imagewebp($image, $size_webp_file, 80);
                            imagedestroy($image);
                        }
                    }
                }
            }
        }
        
        return $metadata;
    }
    add_filter('wp_generate_attachment_metadata', 'create_webp_on_upload', 10, 2);
    
    // HTML出力時にpicture要素を使ってWebP画像を優先表示
    function webp_picture_element($html, $post_id, $post_thumbnail_id, $size, $attr) {
        // 画像URLを取得
        $image_src = wp_get_attachment_image_src($post_thumbnail_id, $size);
        if (!$image_src) {
            return $html;
        }
        
        $image_url = $image_src[0];
        $webp_url = preg_replace('/\.(jpe?g|png)$/i', '.webp', $image_url);
        
        // WebP画像が存在するか確認
        $upload_dir = wp_upload_dir();
        $webp_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $webp_url);
        
        if (!file_exists($webp_path)) {
            return $html;
        }
        
        // picture要素を構築
        $width = $image_src[1];
        $height = $image_src[2];
        $alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
        $class = isset($attr['class']) ? $attr['class'] : '';
        
        $picture_html = '<picture>';
        $picture_html .= '<source srcset="' . $webp_url . '" type="image/webp">';
        $picture_html .= '<img src="' . $image_url . '" width="' . $width . '" height="' . $height . '" alt="' . esc_attr($alt) . '" class="' . esc_attr($class) . '">';
        $picture_html .= '</picture>';
        
        return $picture_html;
    }
    add_filter('post_thumbnail_html', 'webp_picture_element', 10, 5);
}
add_action('init', 'add_webp_support');
