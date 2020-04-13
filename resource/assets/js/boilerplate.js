window.toastr.options = {}

window.growl = function (message, type) {
    types = ['info', 'error', 'warning', 'success'];

    if (typeof type === "undefined" || !types.includes(type)) {
        type = 'info';
    }
    window.toastr[type](message);
}

$('.sidebar-toggle').on('click', function (event) {
    event.preventDefault();
    if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        sessionStorage.setItem('sidebar-toggle-collapsed', '');
    } else {
        sessionStorage.setItem('sidebar-toggle-collapsed', '1');
    }
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body',
        delay: { "show": 500, "hide": 100 },
        html: true
    })
})

$('.logout').click(function (e) {
    e.preventDefault();
    if (bootbox.confirm($(this).attr('data-question'), function (e) {
        if (e === false) {
            return;
        }
        $('#logout-form').submit();
    })) {
    }
});

(function () {
    if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        var body = document.getElementsByTagName('body')[0];
        body.className = body.className + ' sidebar-collapse';
    }
})();