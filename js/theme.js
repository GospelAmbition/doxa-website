/**
 * Gospel Ambition Theme JavaScript
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {

        // Mobile menu toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mainNavigation = document.querySelector('.main-navigation');

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                this.classList.toggle('active');
                if (mainNavigation) {
                    mainNavigation.classList.toggle('mobile-active');
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
                if (mainNavigation) {
                    mainNavigation.classList.remove('mobile-active');
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

    });
})();
