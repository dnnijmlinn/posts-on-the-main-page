document.addEventListener('DOMContentLoaded', function() {
    var loadMoreButton = document.getElementById('load-more-button');
    var currentPage = getCurrentPageNumber();

    loadMoreButton.setAttribute('data-paged', currentPage + 1);

    loadMoreButton.addEventListener('click', function() {
        var paged = parseInt(this.getAttribute('data-paged'));
        console.log('Загрузка постов со страницы: ' + paged);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', myAjax.url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById('post-content').innerHTML += response.data;
                    loadMoreButton.setAttribute('data-paged', paged + 1);

                    // Проверка, есть ли ещё посты для загрузки
                    if (response.data === '') {
                        loadMoreButton.style.display = 'none'; // Скрываем кнопку, если больше нет постов
                    }
                } else {
                    console.error('Ошибка загрузки постов: ' + response.data);
                    loadMoreButton.style.display = 'none'; // Скрываем кнопку при ошибке
                }
            } else {
                console.error('Ошибка запроса: ' + xhr.status);
                loadMoreButton.style.display = 'none'; // Скрываем кнопку при ошибке запроса
            }
        };

        xhr.onerror = function() {
            console.error('Ошибка соединения');
            loadMoreButton.style.display = 'none'; // Скрываем кнопку при ошибке соединения
        };

        xhr.send('action=load_more_posts&paged=' + paged);
    });
});

function getCurrentPageNumber() {
    var path = window.location.pathname;
    var pageMatch = path.match(/\/page\/(\d+)/);
    return pageMatch ? parseInt(pageMatch[1]) : 1;
}
