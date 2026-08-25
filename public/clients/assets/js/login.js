
    document.addEventListener("DOMContentLoaded", function() {
        const signInForm = document.querySelector('.sign-in');
        const signUpForm = document.querySelector('.signup');
        const btnToSignUp = document.querySelector('.sign-in .signup-image-link');
        const btnToSignIn = document.querySelector('.signup .signup-image-link');

        // Ẩn form đăng ký mặc định
        if (signUpForm) signUpForm.style.display = 'none';
        if (btnToSignUp) {
            btnToSignUp.addEventListener('click', function(e) {
                e.preventDefault();
                signInForm.style.display = 'none';
                signUpForm.style.display = 'block';
            });
        }
        if (btnToSignIn) {
            btnToSignIn.addEventListener('click', function(e) {
                e.preventDefault(); 
                signUpForm.style.display = 'none';
                signInForm.style.display = 'block';
            });
        }
    });
    // user
    document.addEventListener('DOMContentLoaded', function() {
        const userDropdown = document.querySelector('#userDropdown');

        if (!userDropdown) {
            return;
        }

        const dropdownMenu = userDropdown.parentElement.querySelector('.dropdown-menu');

        if (!dropdownMenu) {
            return;
        }

        const dropdownLinks = dropdownMenu.querySelectorAll('a[href]');

        dropdownLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                window.location.href = link.href;
            });
        });

        userDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            dropdownMenu.classList.toggle('show');
            userDropdown.setAttribute(
                'aria-expanded',
                dropdownMenu.classList.contains('show') ? 'true' : 'false'
            );
        });

        document.addEventListener('click', function(e) {
            if (!userDropdown.parentElement.contains(e.target)) {
                dropdownMenu.classList.remove('show');
                userDropdown.setAttribute('aria-expanded', 'false');
            }
        });
    });