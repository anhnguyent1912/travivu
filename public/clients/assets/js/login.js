
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
