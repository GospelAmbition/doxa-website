/**
 * Gospel Ambition Theme JavaScript
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {

        // Mobile menu toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const hamburgerMenu = document.querySelector('.hamburger-menu');
        const hamburgerMenuOverlay = document.querySelector('.hamburger-menu-overlay');

        if (mobileMenuToggle) {
            const toggleMenu = function() {
                if (hamburgerMenu) {
                    hamburgerMenu.dataset.state = hamburgerMenu.dataset.state === 'open' ? 'closed' : 'open';
                    mobileMenuToggle.classList.toggle('open');
                    hamburgerMenuOverlay.dataset.state = hamburgerMenuOverlay.dataset.state === 'open' ? 'closed' : 'open';
                }
            }
            mobileMenuToggle.addEventListener('click', toggleMenu);
            hamburgerMenuOverlay.addEventListener('click', toggleMenu);
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

        const highlights = document.querySelectorAll('.highlight');
        highlights.forEach(function(item) {
            const words = item.textContent.split(' ');
            const highlightIndex = item.dataset.highlightIndex ? parseInt(item.dataset.highlightIndex) -1 : -1;
            const highlightLast = item.dataset.highlightLast === "" ? true : false;
            const highlightColor = item.dataset.highlightColor ? item.dataset.highlightColor : 'primary';
            const newInnerHTML = words.reduce((acc, word, index) => {
                if (highlightIndex > -1 && index === highlightIndex) {
                    acc.push(`<span class="color-${highlightColor}">${word}</span>`);
                    return acc;
                }
                if (highlightLast && index === words.length - 1) {
                    acc.push(`<span class="color-${highlightColor}">${word}</span>`);
                    return acc;
                }
                acc.push(word)
                return acc;
            }, []);
            item.innerHTML = newInnerHTML.join(' ');
        });

        // Auto scrolling slideshow
        // credit to https://codepen.io/knekk/pen/ZEQMjgb?editors=0010 for the original code
        function initSlideshow(reel) {
            // Fade in
            reel.classList.add("in");

            // Auto scroll slideshow
            setInterval(() => {
                const firstImage = [...reel.children].reduce((prev, current) => (Number(prev.style.order) < Number(current.style.order)) ? prev : current);

                // Move the first image back in queue when it's out of view
                if (firstImage.offsetWidth < reel.scrollLeft) {
                    reel.scrollLeft = reel.scrollLeft - firstImage.offsetWidth;
                    firstImage.style.order = reel.children.length;
                    for (const image of [...reel.children]) {
                        if (image != firstImage) image.style.order = image.style.order-1;
                    }
                } else {
                    reel.scrollLeft += 1;
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

        // Video modal toggle
        const videoModalButton = document.querySelector('.video-modal-button');
        const videoModal = document.querySelector('.video-modal');
        const videoModalOverlay = document.querySelector('.video-modal-overlay');

        if (videoModalButton) {
            videoModalButton.addEventListener('click', function() {
                videoModal.dataset.state = videoModal.dataset.state === 'open' ? 'closed' : 'open';
                videoModalOverlay.dataset.state = videoModalOverlay.dataset.state === 'open' ? 'closed' : 'open';
            });

            videoModalOverlay.addEventListener('click', function() {
                videoModal.dataset.state = 'closed';
                videoModalOverlay.dataset.state = 'closed';
            });
        }
    });
})();
