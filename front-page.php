<?php get_header(); ?>

<!-- ================================================================================================== *
* []header []nav [○]main []footer
* ================================================================================================== -->
<!--mainは親要素を<section>として<div class="container">の子要素に設置する（sidebar等を同じ深さに設置するため）-->
<section class="main">
<!--Layer1-->



<!-- ================================================================================================== *
* [○]main：catchcopy-BOX
* ================================================================================================== -->
    <div class="container home-main-catchcopy">
    <!--Layer2 (class属性を2つ付与)-->
        <div class="catchcopy-inner">
        <!--Layer3 (START CONTENTS)-->
            <p class="home-p">
            このサイトでは、日々の仕事や人生の考えごと、ハードウェア開発の備忘録、革靴・メガネといった暮らしの道具、<br>
            そして学生時代から趣味にしているミステリ小説の感想をゆるくまとめています。</p>

            <p class="home-p">
            サイトはHTMLとCSSを一から手作りしてみたので、制作の解説記事も気が向いたら読んでみてください。</p>
        </div><!-- /.catchcopy-inner -->
    </div><!-- /.home-main-catchcopy -->



<!-- ================================================================================================== *
* [○]main：contentbox-BOX
* ================================================================================================== -->
    <div class="home-main-contentbox">
    <!--Layer2 (コンテンツエリアの幅いっぱいにBOXを広げるため、例外的にclass="container"を付与しない)-->
        <div class="contentbox-inner">
        <!--Layer3 (START CONTENTS)-->
            <ul class="home-contentbox">

                <!-- 1st-BOX -->
				<li class="tile-cover-animation">
				    <a href="<?php echo esc_url( get_permalink(806) ); ?>">
				    	<!-- デスクトップ用画像 -->
				    	<img class="img-desktop" src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-Thinking_logo_icon-stroke12.png" alt="Thinking">
				    	<!-- モバイル用画像 -->
				    	<img class="img-mobile" src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-Thinking_logo_icon-stroke12_mobile.png" alt="Thinking">
				    </a>
			        <a href="<?php echo esc_url( get_permalink(806) ); ?>">
				    <dl>
				        <dt><b>Thinking</b></dt>
				        <dd>日々の仕事や人生の考えごとに関する思索の記事をリストアップしています。</dd>
				    </dl>
				    </a>
				</li>
                
                <!-- 2nd-BOX -->
                <li class="tile-cover-animation">
                    <a href="<?php echo esc_url( get_permalink(808) ); ?>">
                    	<!-- デスクトップ用画像 -->
                    	<img class="img-desktop" src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-Tech_logo_icon-stroke12.png" alt="Tech">
                    	<!-- モバイル用画像 -->
                    	<img class="img-mobile" src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-Tech_logo_icon-stroke12_mobile.png" alt="Tech">
                    </a>
                    <a href="<?php echo esc_url( get_permalink(808) ); ?>">
                    <dl>
                        <dt><b>Tech</b></dt>
                        <dd>4bit-CPU制作をはじめとしたハードウェア開発の記事をリストアップしています。ガジェット系の記事やサイトの解説記事もこちらからどうぞ。</dd>
                    </dl>
                    </a>
                </li>

                <!-- 3rd-BOX -->
                <li class="tile-cover-animation">
                    <a href="<?php echo esc_url( get_permalink(810) ); ?>">
                    	<!-- デスクトップ用画像 -->
                    	<img class="img-desktop" src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-Items_logo_icon-stroke12.png" alt="Items">
                    	<!-- モバイル用画像 -->
                    	<img class="img-mobile" src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-Items_logo_icon-stroke12_mobile.png" alt="Items">
                    </a>
                    <a href="<?php echo esc_url( get_permalink(810) ); ?>">
                    <dl>
                        <dt><b>Items</b></dt>
                        <dd>革靴・メガネや万年筆といったと暮らしの道具についての購入記事をリストアップしています。</dd>
                        <dd>グローブトロッターなど上質な高級品に関する記事が中心です。</dd>
                    </dl>
                    </a>
                </li>
                
                <!-- 4th-BOX -->
                <li class="tile-cover-animation">
                    <a href="<?php echo esc_url( get_permalink(812) ); ?>">
                    	<!-- デスクトップ用画像 -->
                    	<img class="img-desktop" src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-Reviews_logo_icon-stroke12.png" alt="Reviews">
                    	<!-- モバイル用画像 -->
                    	<img class="img-mobile" src="<?php echo get_template_directory_uri(); ?>/images/KANNAMINOTE-Reviews_logo_icon-stroke12_mobile.png" alt="Reviews">
                    </a>
                    <a href="<?php echo esc_url( get_permalink(812) ); ?>">
                    <dl>
                        <dt><b>Reviews</b></dt>
                        <dd>ミステリ小説や映画の感想記事をリストアップしています。</dd>
                        <dd>過去ブログから移行準備中です。</dd>
                    </dl>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    


<!-- ================================================================================================== *
* [○]main：description-BOX
* ================================================================================================== -->
    <div class="container home-main-description">
    <!--Layer2 (class属性を2つ付与)-->
        <main>
        <!--Layer3 (START CONTENTS)-->            
            <h1 class="post-title">最新の記事</h1>

			<!-- 記事一覧 -->
            <section class="newsBlock">
				<?php get_template_part('loop', 'main'); ?>
            </section><!-- /.newsBlock -->
            
            <!-- 連絡先エリア -->
			    <div class="container home-main-contact">
		        <!--Layer2 (class属性を2つ付与)-->
			        <div class="contact-inner">
		    	        <!--Layer3 (START CONTENTS)-->
		        	    <p class="contact-p">
		        	    	<a href="<?php echo esc_url( get_permalink(469) ); ?>" target="_blank">CONTACT</a>
		        	    </p>
		        	</div><!-- /.contact-inner -->
		    	</div><!-- /.home-main-contact -->
        </main><!-- main -->

		<!-- サイドバーエリア -->
        <aside class="sidebar">
        <?php get_sidebar('author'); ?>
        <?php get_sidebar('categories'); ?>
        <?php get_sidebar('archives'); ?>
        </aside><!-- aside -->
        
    </div><!-- /.container -->
</section>

<?php get_footer(); ?>