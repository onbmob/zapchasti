
$(document).ready(function(){
    //  ON CLICK menu (adaptive)
    $(document).on('keyup', '#search_article_main', function (e) {
        if($(this).val().length > 0) $('#search_phrase_main').val('');
        if(e.keyCode == 13){
            startMainSearch();
        }
    });

    $(document).on('keyup', '#search_phrase_main', function (e) {
        if($(this).val().length > 0) $('#search_article_main').val('');
        if(e.keyCode == 13){
            startMainSearch();
        }
    });

    $(document).on('click', '#start_main_search', function () {
        showConsoleLog('start_main_search');
        startMainSearch();
    });

});

//=======================================================================================
//=======================================================================================
//=======================================================================================

function changeStaticPage() {
     //-----Меняем url----------
     var url = $('#changeStaticPage').val();
     window.history.pushState(null, null, url);
     window.addEventListener("popstate", function(e) {//Нажатие кнопки НАЗАД
     history.go(-1); //На предыдущую страницу
     }, false);
}

function showConsoleLog(text) {
    console.log(text);
}

//=======================================================================================
function startMainSearch() {
    var search_article_main = $('#search_article_main');
    if(search_article_main.val().length > 2) {
        document.location.href = "/index.php?r=search/default/get-articles-search&article=" + $('#search_article_main').val() + "";
    } else if($('#search_phrase_main').val().length > 2){//по фразе пока не ищем

    }
}

