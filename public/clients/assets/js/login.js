
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
// Việt hóa thông báo kiểm tra dữ liệu của trình duyệt trên trang tài khoản.
const accountFieldLabels = {
    your_name: "tên đăng nhập hoặc email",
    your_pass: "mật khẩu",
    username_register: "tên đăng nhập",
    email_register: "email",
    password_register: "mật khẩu",
    re_pass: "mật khẩu xác nhận",
    "activation-email": "email đã đăng ký",
};

Object.entries(accountFieldLabels).forEach(function ([id, label]) {
    const input = document.getElementById(id);
    if (!input) return;

    input.addEventListener("invalid", function () {
        this.setCustomValidity("");

        if (this.validity.valueMissing) {
            this.setCustomValidity(`Vui lòng nhập ${label}.`);
        } else if (this.validity.typeMismatch && this.type === "email") {
            this.setCustomValidity("Địa chỉ email không hợp lệ.");
        }
    });

    input.addEventListener("input", function () {
        this.setCustomValidity("");
    });
});

// Gửi dữ liệu đăng nhập và đăng ký.
$("#login-form, #register-form").on("submit", function (e) {
    e.preventDefault();

    const $form = $(this);
    const isRegister = this.id === "register-form";
    const $button = $form.find(":submit");

    const formData = isRegister
        ? {
            username: $("#username_register").val().trim(),
            email: $("#email_register").val().trim(),
            password: $("#password_register").val(),
            password_confirmation: $("#re_pass").val(),
        }
        : {
            username: $("#your_name").val().trim(),
            password: $("#your_pass").val(),
        };

    formData._token = $form.find('input[name="_token"]').val();

    $button.prop("disabled", true);

    $.ajax({
        type: "POST",
        url: $form.attr("action"),
        data: formData,
        headers: {
            Accept: "application/json"
        },
        success: function (response) {
            if (!response.success) {
                toastr.error(response.message);
                return;
            }

            if (isRegister) {
                toastr.success(response.message);
                $form.trigger("reset");
            } else {
                window.location.href = response.redirectUrl;
            }
        },
        error: function (xhr) {
            const errors = xhr.responseJSON?.errors;
            const firstError = errors
                ? Object.values(errors).flat()[0]
                : null;

            toastr.error(
                xhr.status === 429
                    ? "Bạn thao tác quá nhiều lần. Vui lòng thử lại sau."
                    : firstError
                        || xhr.responseJSON?.message
                        || "Có lỗi xảy ra. Vui lòng thử lại."
            );
        },
        complete: function () {
            $button.prop("disabled", false);
        }
    });
});
