/**
 * Gospel Ambition Theme JavaScript
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {

        // Mobile menu toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const hamburgerMenu = document.querySelector('.hamburger-menu');

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                this.classList.toggle('open');
                if (hamburgerMenu) {
                    hamburgerMenu.dataset.state = hamburgerMenu.dataset.state === 'open' ? 'closed' : 'open';
                }
            });
        }

        // Mobile sub-menu toggle
        const menuItemsWithChildren = document.querySelectorAll('.main-navigation .menu-item-has-children > a');
        menuItemsWithChildren.forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    this.parentElement.classList.toggle('mobile-open');
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const isClickInsideNav = e.target.closest('.main-navigation');
            const isClickOnToggle = e.target.closest('.mobile-menu-toggle');

            if (!isClickInsideNav && !isClickOnToggle) {
                if (mobileMenuToggle) {
                    mobileMenuToggle.classList.remove('active');
                }
                if (hamburgerMenu) {
                    hamburgerMenu.classList.remove('mobile-active');
                }
                const openMenuItems = document.querySelectorAll('.menu-item-has-children.mobile-open');
                openMenuItems.forEach(function(item) {
                    item.classList.remove('mobile-open');
                });
            }
        });

        // Smooth scrolling for anchor links
        const anchorLinks = document.querySelectorAll('a[href*="#"]:not([href="#"])');
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && href.indexOf('#') !== -1) {
                    const hash = href.substring(href.indexOf('#'));
                    const pathname = location.pathname.replace(/^\//, '');
                    const linkPathname = this.pathname.replace(/^\//, '');

                    if (pathname === linkPathname && location.hostname === this.hostname) {
                        let target = document.querySelector(hash);
                        if (!target) {
                            target = document.querySelector('[name="' + hash.slice(1) + '"]');
                        }

                        if (target) {
                            e.preventDefault();
                            const targetTop = target.getBoundingClientRect().top + window.scrollY - 80;

                            window.scrollTo({
                                top: targetTop,
                                behavior: 'smooth'
                            });
                        }
                    }
                }
            });
        });

        // Animate elements on scroll
        function animateOnScroll() {
            const postCards = document.querySelectorAll('.post-card');
            postCards.forEach(function(card) {
                const rect = card.getBoundingClientRect();
                const elementTop = rect.top + window.scrollY;
                const elementBottom = elementTop + card.offsetHeight;
                const viewportTop = window.scrollY;
                const viewportBottom = viewportTop + window.innerHeight;

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    card.classList.add('animate-in');
                }
            });
        }

        // Run animation on scroll and page load
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('resize', animateOnScroll);
        animateOnScroll();

        // style changes
        const highlightFirstAndLast = document.querySelectorAll('.highlight-first.highlight-last');
        highlightFirstAndLast.forEach(function(item) {
            const words = item.textContent.split(' ');
            const firstWord = words[0];
            const lastWord = words[words.length - 1];
            const restWords = words.slice(1, words.length - 1);
            const newInnerHTML = [
                `<span class="color-primary">${firstWord}</span>`,
                ...restWords,
                `<span class="color-primary">${lastWord}</span>`,
            ]
            item.innerHTML = newInnerHTML.join(' ');
        });
        const highlightFirst = document.querySelectorAll('.highlight-first:not(.highlight-last)');
        highlightFirst.forEach(function(item) {
            const words = item.textContent.split(' ');
            const firstWord = words[0];
            const restWords = words.slice(1);
            const newInnerHTML = [
                `<span class="color-primary">${firstWord}</span>`,
                ...restWords,
            ]
            item.innerHTML = newInnerHTML.join(' ');
        });
        const highlightLast = document.querySelectorAll('.highlight-last:not(.highlight-first)');
        highlightLast.forEach(function(item) {
            const words = item.textContent.split(' ');
            const lastWord = words[words.length - 1];
            const restWords = words.slice(0, words.length - 1);
            const newInnerHTML = [
                ...restWords,
                `<span class="color-primary">${lastWord}</span>`,
            ]
            item.innerHTML = newInnerHTML.join(' ');
        });
        function initSlideshow(slideshow) {
            // Fade in
            slideshow.classList.add("in");

            // Auto scroll slideshow
            setInterval(() => {
                const firstImage = [...slideshow.children].reduce((prev, current) => (Number(prev.style.order) < Number(current.style.order)) ? prev : current);

                // Move the first image back in queue when it's out of view
                if (firstImage.width < slideshow.scrollLeft) {
                    slideshow.scrollLeft = slideshow.scrollLeft - firstImage.width;
                    firstImage.style.order = slideshow.children.length;
                    for (const image of [...slideshow.children]) {
                        if (image != firstImage) image.style.order = image.style.order-1;
                    }
                } else {
                    slideshow.scrollLeft += 1;
                }
            }, 20);
        }
        (async () => {
            // Using a for..of loop in case you want more slideshows on page.
            for (const reel of [...document.querySelectorAll(".reel[data-reel-mode='auto-scroll']")]) {
                const images = reel.querySelectorAll('img');
                for (const image of [...images]) {
                    await new Promise(resolve => {
                        if (image.complete) resolve();
                        else image.onload = resolve;
                    });
                }
                let index = 0;
                for (const child of [...reel.children]) {
                    child.style.order = index;
                    index++;
                }

                initSlideshow(reel);
            }
        })();
    });
})();
