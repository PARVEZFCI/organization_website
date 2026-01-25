
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

        / Activity Slider
        const slider = document.getElementById('activitySlider');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
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
        

        // Gallery image interaction
        const galleryImages = document.querySelectorAll('.gallery-img');
        galleryImages.forEach(img => {
            img.addEventListener('click', function() {
                // Create modal effect
                if (this.style.position === 'fixed') {
                    this.style.position = 'relative';
                    this.style.top = '';
                    this.style.left = '';
                    this.style.transform = '';
                    this.style.zIndex = '';
                    this.style.width = '';
                    this.style.height = '';
                    document.body.style.overflow = '';
                } else {
                    this.style.position = 'fixed';
                    this.style.top = '50%';
                    this.style.left = '50%';
                    this.style.transform = 'translate(-50%, -50%) scale(1.5)';
                    this.style.zIndex = '9999';
                    this.style.width = 'auto';
                    this.style.height = '80vh';
                    document.body.style.overflow = 'hidden';
                }
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