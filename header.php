<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="description" content="HTMLの勉強の備忘録を記載する。">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/STAR-favicon180.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/STAR-favicon180.png">
    <script src="https://kit.fontawesome.com/45bdc85523.js" crossorigin="anonymous"></script>
    
    <!-- Google Fonts "Noto Sans JP" 使用のため -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

    <!-- トップページとそれ以外のページでtitle表示を切り替える -->
    <title><?php if( !is_home() ){ wp_title(' - ', true, 'right'); } ?><?php bloginfo('name'); ?></title>
    
    <!-- jqueryとjavascriptの読み出し（function.phpに移行済み） -->
    <?php 
    wp_head();
    ?>
</head>










<body>
<!-- ================================================================================================== *
*
* [○]header []nav []main []footer
*
* ================================================================================================== -->
<header>
<!--Layer1-->
    <div class="container header-container">
    <!--Layer2 (class属性を2つ付与)-->
        <div class="header-inner">
        <!--Layer3 (START CONTENTS)-->
            <!-- 1つのheader.phpに条件分岐を加えることで、トップページだけh1で囲み、その他のページではh1以外(例えば div)にする -->
            <!-- srcset属性により高解像度Displayではx2に画像切替 -->
		    <?php if ( is_front_page() ) : ?>
		    	<h1 class="header-logo">
			<?php else : ?>
		    	<div class="header-logo">
			<?php endif; ?>

		    <a href="<?php echo home_url(); ?>">
		        <img src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE_raleway_stroke03-1x.png" srcset="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE_raleway_stroke03-1x.png 1x, <?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE_raleway_stroke03-2x.png 2x" alt="STAR MAKER">
		    </a>

			<?php if ( is_front_page() ) : ?>
			    </h1>
			<?php else : ?>
		    	</div>
			<?php endif; ?>
			<!-- 条件分岐終了 -->
		
			<!-- ボタンを生成するタグ -->
            <button class="hamburger" id="mobile-menu" aria-label="メニューの開閉"></button>
            
            <!-- ここから検索フォーム -->
            <form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            	<input type="search" class="s" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="..." />
            	<button type="submit" aria-label="検索フォーム"><i class="fas fa-search" aria-hidden="true"></i></button>
      		</form>
      		<!-- 検索フォームここまで -->
        </div><!-- /.header-inner -->
    </div><!-- /.header-container -->
</header>










<!-- ================================================================================================== *
*
* []header [○]nav []main []footer
*
* ================================================================================================== -->
<nav>
<!--Layer1-->
    <div class="container nav-container">
    <!--Layer2 (class属性を2つ付与)-->
        <div class="nav-inner">
        <!--Layer3 (START CONTENTS)-->
            <div class="navbar">
            <?php 
            $args = array(
                'menu' => 'global-navigation', // 管理画面で作成したメニューの名前
                'container' => false, // <ul>タグを囲んでいる<div>タグを削除
                'menu_id'   => 'menu-global-navigation', // ここで <ul> に id を付与
            );
            wp_nav_menu($args);
            ?>
            </div>
        </div><!-- /.nav-inner -->
    </div><!-- /.nav-container -->

    <!-- グローバルナビゲーションをWordPressで取得する際に固有のid名が割り当てられるためWordPress側の設定に合わせてstyleを当てる -->
    <style>
    @media only screen and (min-width: 768px) {    
    #menu-global-navigation {
        display: flex !important;   /*詳細度に関係なくCSSを適用（hamburger-script.js動作のため）*/
        justify-content: flex-end;  /*navbarを右寄せにする*/
        margin: 0;
        padding: 0;
    }
    }
    </style>

</nav>

