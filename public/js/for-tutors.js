/**
 * For Tutors Page — Premium Interactions
 * Tutzy EdTech SaaS
 */

(function () {
    'use strict';

    /* ────────────────────────────────────────────────────
       1. SCROLL REVEAL (IntersectionObserver)
    ──────────────────────────────────────────────────── */
    const revealEls = document.querySelectorAll('.ft-reveal, .ft-step');

    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12 }
    );

    revealEls.forEach((el) => revealObserver.observe(el));

    /* ────────────────────────────────────────────────────
       2. STEP CONNECTOR PATH ANIMATION
    ──────────────────────────────────────────────────── */
    const connectorPath = document.getElementById('ft-connector-path');
    const stepsSection = document.getElementById('ft-steps');

    if (connectorPath && stepsSection) {
        const stepObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // Animate path from left to right
                        let offset = 740;
                        const interval = setInterval(() => {
                            offset -= 12;
                            if (offset <= 0) {
                                offset = 0;
                                clearInterval(interval);
                            }
                            connectorPath.style.strokeDashoffset = offset;
                        }, 16);
                        stepObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.3 }
        );
        stepObserver.observe(stepsSection);
    }

    /* ────────────────────────────────────────────────────
       3. HERO WORKSPACE PARALLAX on mouse move
    ──────────────────────────────────────────────────── */
    const workspace = document.getElementById('ft-workspace');
    const heroRight = document.getElementById('ft-hero-right');

    if (workspace && heroRight) {
        let rafId = null;

        heroRight.addEventListener('mousemove', (e) => {
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(() => {
                const rect = heroRight.getBoundingClientRect();
                const cx = rect.left + rect.width / 2;
                const cy = rect.top + rect.height / 2;
                const dx = (e.clientX - cx) / rect.width;
                const dy = (e.clientY - cy) / rect.height;

                // Subtle parallax tilt on workspace
                workspace.style.transform = `perspective(1000px) rotateY(${dx * 5}deg) rotateX(${-dy * 4}deg)`;
                workspace.style.transition = 'transform 0.05s linear';

                // Different speeds for each float card
                const cards = workspace.querySelectorAll('.ft-float-card');
                cards.forEach((card, i) => {
                    const depth = (i % 3 + 1) * 4;
                    card.style.transform = `translate(${dx * depth}px, ${dy * depth}px)`;
                    card.style.transition = 'transform 0.08s linear';
                });
            });
        });

        heroRight.addEventListener('mouseleave', () => {
            if (rafId) cancelAnimationFrame(rafId);
            workspace.style.transform = '';
            workspace.style.transition = 'transform 0.6s cubic-bezier(0.22, 1, 0.36, 1)';
            workspace.querySelectorAll('.ft-float-card').forEach((card) => {
                card.style.transform = '';
                card.style.transition = 'transform 0.6s cubic-bezier(0.22, 1, 0.36, 1)';
            });
        });
    }

    /* ────────────────────────────────────────────────────
       4. MAGNETIC BUTTONS
    ──────────────────────────────────────────────────── */
    document.querySelectorAll('.ft-btn--primary, .ft-btn--glow').forEach((btn) => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            const pull = 0.18;
            btn.style.transform = `translate(${x * pull}px, ${y * pull}px)`;
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = '';
            btn.style.transition = 'transform 0.4s cubic-bezier(0.22, 1, 0.36, 1)';
        });
        btn.addEventListener('mouseenter', () => {
            btn.style.transition = 'transform 0.1s linear';
        });
    });

    /* ────────────────────────────────────────────────────
       5. ANIMATED COUNTER for hero stats
    ──────────────────────────────────────────────────── */
    function animateCounter(el, target, prefix = '', suffix = '', duration = 1600) {
        const start = performance.now();
        const startVal = 0;

        function update(now) {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            // Ease out cubic
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(startVal + (target - startVal) * eased);
            el.textContent = prefix + current.toLocaleString() + suffix;
            if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    // Observe hero stats
    const statsContainer = document.querySelector('.ft-hero__stats');
    if (statsContainer) {
        const statsObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const vals = entry.target.querySelectorAll('.ft-hero__stat-val');
                        // ₹2,30,000 | 100K+ | 4.9★
                        if (vals[0]) animateEarnings(vals[0], 230000, '₹', '');
                        statsObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.5 }
        );
        statsObserver.observe(statsContainer);
    }

    function animateEarnings(el, target, prefix, suffix) {
        const start = performance.now();
        const duration = 1800;
        function update(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const val = Math.round(target * eased);
            el.textContent = prefix + val.toLocaleString('en-IN') + suffix;
            if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    /* ────────────────────────────────────────────────────
       6. LIVE EARNINGS COUNTER (simulates real-time)
    ──────────────────────────────────────────────────── */
    const earningsVal = document.querySelector('.ft-float-card--earnings .ft-float-card__value');
    if (earningsVal) {
        let base = 270000;
        // Small random increments
        setInterval(() => {
            const increment = Math.floor(Math.random() * 1200) + 400;
            base += increment;
            // Animate to new value
            earningsVal.style.transition = 'color 0.3s';
            earningsVal.style.color = '#65a30d';
            earningsVal.textContent = '₹' + base.toLocaleString('en-IN');
            setTimeout(() => {
                earningsVal.style.color = '';
            }, 300);
        }, 4200);
    }

    /* ────────────────────────────────────────────────────
       7. FAQ ACCORDION
    ──────────────────────────────────────────────────── */
    const faqItems = document.querySelectorAll('.ft-faq-item');

    faqItems.forEach((item) => {
        const trigger = item.querySelector('.ft-faq-trigger');
        const body = item.querySelector('.ft-faq-body');

        if (!trigger || !body) return;

        trigger.addEventListener('click', () => {
            const isOpen = trigger.getAttribute('aria-expanded') === 'true';

            // Close all
            faqItems.forEach((other) => {
                const otherTrigger = other.querySelector('.ft-faq-trigger');
                const otherBody = other.querySelector('.ft-faq-body');
                if (otherTrigger && otherBody) {
                    otherTrigger.setAttribute('aria-expanded', 'false');
                    otherBody.classList.remove('is-open');
                    other.classList.remove('is-open');
                }
            });

            // Open clicked if was closed
            if (!isOpen) {
                trigger.setAttribute('aria-expanded', 'true');
                body.classList.add('is-open');
                item.classList.add('is-open');
            }
        });
    });

    /* ────────────────────────────────────────────────────
       8. PROGRESS ARC ANIMATION on scroll into view
    ──────────────────────────────────────────────────── */
    const arcFill = document.querySelector('.ft-arc-fill');
    if (arcFill) {
        const arcObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // 85% of 2πr (r=30) → circumference ~188.5
                        const circumference = 2 * Math.PI * 30;
                        const targetOffset = circumference * (1 - 0.85);
                        arcFill.style.transition = 'stroke-dashoffset 1.8s cubic-bezier(0.22, 1, 0.36, 1)';
                        arcFill.setAttribute('stroke-dashoffset', targetOffset);
                        arcObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.3 }
        );
        arcObserver.observe(arcFill.closest('.ft-float-card--progress'));
    }

    /* ────────────────────────────────────────────────────
       9. CURSOR REACTIVE HIGHLIGHT for hero right panel
    ──────────────────────────────────────────────────── */
    const heroSection = document.getElementById('ft-hero');
    if (heroSection) {
        const highlight = document.createElement('div');
        highlight.style.cssText = `
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(163,230,53,0.06) 0%, transparent 70%);
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 0;
            transition: left 0.15s ease, top 0.15s ease;
        `;
        heroSection.style.position = 'relative';
        heroSection.appendChild(highlight);

        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
            highlight.style.left = (e.clientX - rect.left) + 'px';
            highlight.style.top = (e.clientY - rect.top) + 'px';
        });
    }

    /* ────────────────────────────────────────────────────
       10. BENEFIT CARDS – Depth hover effect
    ──────────────────────────────────────────────────── */
    document.querySelectorAll('.ft-benefit-card').forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            card.style.transform = `translateY(-6px) perspective(600px) rotateX(${-y * 6}deg) rotateY(${x * 6}deg)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.style.transition = 'transform 0.5s cubic-bezier(0.22, 1, 0.36, 1)';
        });
        card.addEventListener('mouseenter', () => {
            card.style.transition = 'transform 0.1s linear';
        });
    });

    /* ────────────────────────────────────────────────────
       11. HERO LEFT STAGGER entrance animation
    ──────────────────────────────────────────────────── */
    const heroLeft = document.getElementById('ft-hero-left');
    if (heroLeft) {
        const children = heroLeft.querySelectorAll(
            '.ft-hero__eyebrow, .ft-hero__heading, .ft-hero__sub, .ft-hero__actions, .ft-hero__stats, .ft-hero__trust'
        );
        children.forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = `opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1) ${i * 0.1}s, transform 0.7s cubic-bezier(0.22, 1, 0.36, 1) ${i * 0.1}s`;
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100);
        });
    }

    /* ────────────────────────────────────────────────────
       12. WORKSPACE right panel entrance
    ──────────────────────────────────────────────────── */
    const heroRightEl = document.getElementById('ft-hero-right');
    if (heroRightEl) {
        heroRightEl.style.opacity = '0';
        heroRightEl.style.transform = 'translateX(40px)';
        heroRightEl.style.transition = 'opacity 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.4s, transform 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.4s';
        setTimeout(() => {
            heroRightEl.style.opacity = '1';
            heroRightEl.style.transform = 'translateX(0)';
        }, 100);
    }

    /* ────────────────────────────────────────────────────
       13. RATING CARD — periodic new review animation
    ──────────────────────────────────────────────────── */
    const ratingCard = document.getElementById('ft-card-rating');
    const reviews = [
        { text: '"Best math tutor I\'ve ever had"', name: 'Ananya' },
        { text: '"Incredible patience and clarity"', name: 'James' },
        { text: '"My exam score went up 40%"', name: 'Meera' },
        { text: '"Worth every penny!"', name: 'David' },
    ];
    let reviewIdx = 0;

    if (ratingCard) {
        const quoteEl = ratingCard.querySelector('.ft-rating-quote');
        setInterval(() => {
            reviewIdx = (reviewIdx + 1) % reviews.length;
            if (quoteEl) {
                quoteEl.style.opacity = '0';
                quoteEl.style.transform = 'translateY(8px)';
                quoteEl.style.transition = 'opacity 0.3s, transform 0.3s';
                setTimeout(() => {
                    quoteEl.textContent = reviews[reviewIdx].text;
                    quoteEl.style.opacity = '1';
                    quoteEl.style.transform = 'translateY(0)';
                }, 300);
            }
        }, 3500);
    }

    /* ────────────────────────────────────────────────────
       14. SMOOTH SCROLL for anchor links
    ──────────────────────────────────────────────────── */
    document.querySelectorAll('a[href^="#ft-"]').forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const navHeight = document.getElementById('main-navbar')?.offsetHeight || 64;
                const top = target.getBoundingClientRect().top + window.scrollY - navHeight - 20;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    /* ────────────────────────────────────────────────────
       15. MINI CHART bars — animate on load
    ──────────────────────────────────────────────────── */
    const miniChartBars = document.querySelectorAll('.ft-mini-chart__bar');
    miniChartBars.forEach((bar, i) => {
        const finalHeight = bar.style.height;
        bar.style.height = '0%';
        setTimeout(() => {
            bar.style.transition = `height 0.6s cubic-bezier(0.22, 1, 0.36, 1) ${i * 0.08}s`;
            bar.style.height = finalHeight;
        }, 800);
    });

})();
