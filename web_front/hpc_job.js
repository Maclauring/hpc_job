function initializeTabs() {
  $('ul.menu li:first').addClass('tabActive').show();
  $('#container > div').hide();
  $('#job-count').show();

  $("ul.menu").on("click", "li", function() {
    $('ul.menu li').removeClass('tabActive');
    $(this).addClass('tabActive');
    $('#container > div').hide();

    // Fade in the correct DIV.
    var activeTab = $($(this).find('a').attr('href')).fadeIn();
    return false;
  });
}


document.addEventListener('DOMContentLoaded', function(){
    initializeTabs();
});