document.addEventListener("DOMContentLoaded", function () {
    const body = document.querySelector('body');

    // popups
    function popupClose(popupActive) {
        popupActive.classList.remove('open');
        body.classList.remove('lock')
    }

    const popupOpenBtns = document.querySelectorAll('.popup-btn');
    const popups = document.querySelectorAll('.popup');
    const closePopupBtns = document.querySelectorAll('.close-popup');

    closePopupBtns.forEach(function (el) {
        el.addEventListener('click', function (e) {
            popupClose(e.target.closest('.popup'));
        });
    });

    popupOpenBtns.forEach(function (el) {
        el.addEventListener('click', function (e) {
            const path = e.currentTarget.dataset.path;
            const popupTarget = document.querySelector(`[data-popup="${path}"]`)

            popups.forEach(function (popup) {
                popupClose(popup);
                popup.addEventListener('click', function (e) {
                    if (!e.target.closest('.popup__content')) {
                        popupClose(e.target.closest('.popup'));
                    }
                });
            });

            popupTarget.classList.add('open');
            body.classList.add('lock');
        });
    });

    // search
    const timeout = 500;
    let timer;

    $('body').on('input', '.search__input', function () {
        let content = $('.cities-popup__list');
        let inputValue = $('.search__input').val();

        function residentBeforeAjax() {
            content.fadeOut(100);
        }

        clearTimeout(timer);

        timer = setTimeout(() => {
            $.ajax({
                url: 'ajax/search.php',
                type: "POST",
                dataType: "html",
                data: {
                    "INPUT_VALUE": inputValue,
                },
                before: residentBeforeAjax,
                success: function (data) {
                    $(content).html(data);
                    content.fadeIn();
                },
                error: function (data) {
                    $(content).html(data);
                    content.fadeIn();
                    console.log(data);
                }
            });
        }, timeout);

    });
});