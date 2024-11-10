document.addEventListener('DOMContentLoaded', function () {
    var navbar = document.querySelector('.navbar');
    var lastScrollTop = 0;

    function checkScroll() {
        var scrollTop = window.scrollY;

        if (scrollTop > lastScrollTop && scrollTop > 50) {
            navbar.classList.add('hidden');
        } else {
            navbar.classList.remove('hidden');
        }

        if (scrollTop > 50) {
            navbar.classList.add('solid');
            navbar.classList.remove('transparent');
        } else {
            navbar.classList.remove('solid');
            navbar.classList.add('transparent');
        }

        lastScrollTop = scrollTop;
    }

    window.addEventListener('scroll', checkScroll);
    checkScroll();
});

