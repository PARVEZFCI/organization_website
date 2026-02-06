
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navbarHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                    }
                }
            });
        });

        // Active navigation link on scroll
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Activity Slider (guarded if elements exist)
        const slider = document.getElementById('activitySlider');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        if (slider && prevBtn && nextBtn) {
            let scrollAmount = 0;
            const slideDistance = 370; // card width + gap

            nextBtn.addEventListener('click', () => {
                scrollAmount += slideDistance;
                if (scrollAmount > slider.scrollWidth - slider.clientWidth) {
                    scrollAmount = 0; // Loop back to start
                }
                slider.scrollTo({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });

            prevBtn.addEventListener('click', () => {
                scrollAmount -= slideDistance;
                if (scrollAmount < 0) {
                    scrollAmount = slider.scrollWidth - slider.clientWidth; // Loop to end
                }
                slider.scrollTo({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });

            // Auto slide every 5 seconds
            setInterval(() => {
                nextBtn.click();
            }, 5000);

            // Update scroll amount on manual scroll
            slider.addEventListener('scroll', () => {
                scrollAmount = slider.scrollLeft;
            });
        }
        

        // Gallery image interaction: lightbox with immediate next/prev navigation
        const galleryImages = Array.from(document.querySelectorAll('.gallery-img'));
        let currentIndex = -1;
        let lightbox = null;

        function createLightbox() {
            lightbox = document.createElement('div');
            lightbox.className = 'lightbox-overlay';
            lightbox.style.cssText = 'position:fixed;inset:0;z-index:99999;display:none;background:rgba(0,0,0,0.95);';
            lightbox.innerHTML = `
                <div class="lightbox-backdrop" style="position:absolute;inset:0;"></div>
                <div class="lightbox-content" role="dialog" aria-modal="true" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                    <button class="lightbox-prev" aria-label="Previous" style="position:absolute;left:20px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.1);border:2px solid rgba(255,255,255,0.3);color:white;font-size:2.5rem;width:60px;height:60px;border-radius:50%;cursor:pointer;transition:all 0.3s ease;z-index:100002;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(10px);">&#10094;</button>
                    <img class="lightbox-img" src="" alt="Gallery image" style="max-width:95vw;max-height:95vh;object-fit:contain;display:block;transition:opacity 0.3s ease;">
                    <button class="lightbox-next" aria-label="Next" style="position:absolute;right:20px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.1);border:2px solid rgba(255,255,255,0.3);color:white;font-size:2.5rem;width:60px;height:60px;border-radius:50%;cursor:pointer;transition:all 0.3s ease;z-index:100002;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(10px);">&#10095;</button>
                    <button class="lightbox-close" aria-label="Close" style="position:absolute;top:20px;right:30px;background:rgba(255,255,255,0.1);border:2px solid rgba(255,255,255,0.3);color:white;font-size:2.5rem;width:50px;height:50px;border-radius:50%;cursor:pointer;transition:all 0.3s ease;z-index:100002;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(10px);">&times;</button>
                    <div class="lightbox-counter" style="position:absolute;bottom:30px;left:50%;transform:translateX(-50%);color:white;font-size:1.1rem;background:rgba(0,0,0,0.5);padding:8px 20px;border-radius:20px;backdrop-filter:blur(10px);"></div>
                </div>
            `;

            // inject minimal keyboard/interaction handlers
            document.body.appendChild(lightbox);
            
            const prevBtn = lightbox.querySelector('.lightbox-prev');
            const nextBtn = lightbox.querySelector('.lightbox-next');
            const closeBtn = lightbox.querySelector('.lightbox-close');
            
            // Add hover effects
            [prevBtn, nextBtn, closeBtn].forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.background = 'rgba(255,255,255,0.25)';
                    this.style.borderColor = 'rgba(255,255,255,0.6)';
                    this.style.transform = this === prevBtn || this === nextBtn ? 'translateY(-50%) scale(1.1)' : 'scale(1.1)';
                });
                btn.addEventListener('mouseleave', function() {
                    this.style.background = 'rgba(255,255,255,0.1)';
                    this.style.borderColor = 'rgba(255,255,255,0.3)';
                    this.style.transform = this === prevBtn || this === nextBtn ? 'translateY(-50%) scale(1)' : 'scale(1)';
                });
            });
            
            lightbox.querySelector('.lightbox-backdrop').addEventListener('click', closeLightbox);
            closeBtn.addEventListener('click', closeLightbox);
            prevBtn.addEventListener('click', showPrev);
            nextBtn.addEventListener('click', showNext);

            // ensure keyboard navigation works
            document.addEventListener('keydown', (e) => {
                if (!lightbox || lightbox.style.display === 'none') return;
                if (e.key === 'ArrowRight') showNext();
                if (e.key === 'ArrowLeft') showPrev();
                if (e.key === 'Escape') closeLightbox();
            });
        }

        function openLightbox(index) {
            if (!lightbox) createLightbox();
            currentIndex = index;
            const imgEl = lightbox.querySelector('.lightbox-img');
            const counterEl = lightbox.querySelector('.lightbox-counter');
            
            // Fade out image before changing
            imgEl.style.opacity = '0';
            setTimeout(() => {
                imgEl.src = galleryImages[currentIndex].src;
                imgEl.style.opacity = '1';
            }, 150);
            
            // Update counter
            counterEl.textContent = `${currentIndex + 1} / ${galleryImages.length}`;
            
            lightbox.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            if (!lightbox) return;
            lightbox.style.display = 'none';
            document.body.style.overflow = '';
        }

        function showPrev() {
            if (galleryImages.length === 0) return;
            currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
            const imgEl = lightbox.querySelector('.lightbox-img');
            const counterEl = lightbox.querySelector('.lightbox-counter');
            
            imgEl.style.opacity = '0';
            setTimeout(() => {
                imgEl.src = galleryImages[currentIndex].src;
                imgEl.style.opacity = '1';
                counterEl.textContent = `${currentIndex + 1} / ${galleryImages.length}`;
            }, 150);
        }

        function showNext() {
            if (galleryImages.length === 0) return;
            currentIndex = (currentIndex + 1) % galleryImages.length;
            const imgEl = lightbox.querySelector('.lightbox-img');
            const counterEl = lightbox.querySelector('.lightbox-counter');
            
            imgEl.style.opacity = '0';
            setTimeout(() => {
                imgEl.src = galleryImages[currentIndex].src;
                imgEl.style.opacity = '1';
                counterEl.textContent = `${currentIndex + 1} / ${galleryImages.length}`;
            }, 150);
        }

        galleryImages.forEach((img, idx) => {
            img.style.cursor = 'zoom-in';
            img.addEventListener('click', () => openLightbox(idx));
        });

        // Open lightbox when clicking the overlay zoom icon
        const galleryZooms = Array.from(document.querySelectorAll('.gallery-zoom'));
        galleryZooms.forEach(zoom => {
            zoom.style.cursor = 'pointer';
            zoom.addEventListener('click', (e) => {
                e.preventDefault();
                // find the related image inside the same gallery-item
                const item = zoom.closest('.gallery-item');
                if (!item) return;
                const imgEl = item.querySelector('.gallery-img');
                if (!imgEl) return;
                const idx = galleryImages.indexOf(imgEl);
                if (idx === -1) return;
                openLightbox(idx);
            });
        });

        // Intersection Observer for animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Animate cards on scroll
        document.querySelectorAll('.service-card, .activity-card, .event-card, .office-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });

        // Form validation for newsletter
        const newsletterForm = document.querySelector('.input-group');
        const newsletterInput = newsletterForm.querySelector('input');
        const newsletterBtn = newsletterForm.querySelector('button');

        newsletterBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const email = newsletterInput.value.trim();
            
            if (email === '') {
                alert('Please enter your email address');
                newsletterInput.focus();
                return;
            }
            
            if (!isValidEmail(email)) {
                alert('Please enter a valid email address');
                newsletterInput.focus();
                return;
            }
            
            // Success message
            newsletterBtn.textContent = 'Subscribed!';
            newsletterBtn.style.background = '#10b981';
            newsletterInput.value = '';
            
            setTimeout(() => {
                newsletterBtn.textContent = 'Subscribe';
                newsletterBtn.style.background = '#fbbf24';
            }, 3000);
        });

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Navbar background on scroll
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                navbar.style.boxShadow = '0 5px 20px rgba(0,0,0,0.2)';
            } else {
                navbar.style.boxShadow = '0 2px 15px rgba(0,0,0,0.1)';
            }
        });

        // Counter animation for statistics (if you want to add stats section)
        function animateCounter(element, target, duration) {
            let start = 0;
            const increment = target / (duration / 16);
            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(start);
                }
            }, 16);
        }

        // Mobile menu close on outside click
        document.addEventListener('click', (e) => {
            const navbar = document.querySelector('.navbar');
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (!navbar.contains(e.target) && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });

        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Scroll to top button (optional)
        const scrollTopBtn = document.createElement('button');
        scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        scrollTopBtn.className = 'scroll-top-btn';
        scrollTopBtn.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: #059669;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        `;
        
        document.body.appendChild(scrollTopBtn);

        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                scrollTopBtn.style.display = 'block';
            } else {
                scrollTopBtn.style.display = 'none';
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        scrollTopBtn.addEventListener('mouseenter', () => {
            scrollTopBtn.style.transform = 'translateY(-5px)';
            scrollTopBtn.style.boxShadow = '0 10px 25px rgba(0,0,0,0.3)';
        });

        scrollTopBtn.addEventListener('mouseleave', () => {
            scrollTopBtn.style.transform = 'translateY(0)';
            scrollTopBtn.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
        });