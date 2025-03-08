jQuery(function($) {
  // ハンバーガーアイコンをクリックすると、.navbar をスライドトグルする
  $('#mobile-menu').on('click', function(e) {
    e.preventDefault();
    $('.navbar').slideToggle();
  });

  // ウィンドウ幅が767px以下の場合、親メニューの子メニューがある項目のリンククリックで active クラスを切替える
  if ($(window).width() <= 767) {
    $('#menu-global-navigation li.menu-item-has-children > a').on('click', function(e) {
      e.preventDefault();
      $(this).parent('li').toggleClass('active');
    });
  }
});
