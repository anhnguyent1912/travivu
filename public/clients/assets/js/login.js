
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
//ktra 
$("#login-form").on("submit", function (e) {
        e.preventDefault();
        var userName = $("#your_name").val().trim();
        var password = $("#your_pass").val().trim();

        // Đặt lại nội dung thông báo lỗi và ẩn chúng
        $("#validate_username").hide().text("");
        $("#validate_password").hide().text("");

        var isValid = true;

        // Kiểm tra độ dài mật khẩu
        if (password.length < 6) {
            isValid = false;
            $("#validate_password")
                .show()
                .text("Mật khẩu phải có ít nhất 6 ký tự.");
        }

        // Kiểm tra tên đăng nhập và mật khẩu không chứa ký tự đặc biệt
        
        if (sqlInjectionPattern.test(userName)) {
            isValid = false;
            $("#validate_username")
                .show()
                .text("Tên đăng nhập không được chứa ký tự đặc biệt.");
        }

        if (sqlInjectionPattern.test(password)) {
            isValid = false;
            $("#validate_password")
                .show()
                .text("Mật khẩu không được chứa ký tự đặc biệt.");
        }

        if (isValid) {
            var formData = {
                username: userName,
                password: password,
                _token: $('input[name="_token"]').val(),
            };
            console.log(formData, $(this).attr("action"));

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                success: function (response) {
                    if (response.success) {
                        window.location.href = "/";
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    toastr.error("Có lỗi xảy ra. Vui lòng thử lại sau.");
                },
            });
        }
    });

    //  signup
    $("#register-form").on("submit", function (e) {
        e.preventDefault();
        $(".loader").show();
        $("#register-form").addClass("hidden-content");

        // Lấy giá trị của các trường nhập liệu
        var userName = $("#username_register").val().trim();
        var email = $("#email_register").val().trim();
        var password = $("#password_register").val().trim();
        var rePass = $("#re_pass").val().trim();

        // Đặt lại nội dung thông báo lỗi và ẩn chúng
        $("#validate_username_regis").hide().text("");
        $("#validate_email_regis").hide().text("");
        $("#validate_password_regis").hide().text("");
        $("#validate_repass").hide().text("");

        // Kiểm tra lỗi
        var isValid = true;

        // Kiểm tra tên đăng nhập không chứa ký tự
        var sqlInjectionPattern = /['"\\=;]/;
        if (sqlInjectionPattern.test(userName)) {
            isValid = false;
            $("#validate_username_regis")
                .show()
                .text("Tên tài khoản không được chứa ký tự đặc biệt.");
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            $("#validate_email_regis").show().text("Email không hợp lệ.");
        }

        if (password.length < 6) {
            isValid = false;
            $("#validate_password_regis")
                .show()
                .text("Mật khẩu phải có ít nhất 6 ký tự.");
        }

        if (sqlInjectionPattern.test(password)) {
            isValid = false;
            $("#validate_password_regis")
                .show()
                .text("Mật khẩu không được chứa ký tự đặc biệt.");
        }

        // Kiểm tra nhập lại mật khẩu
        if (password !== rePass) {
            isValid = false;
            $("#validate_repass").show().text("Mật khẩu nhập lại không khớp.");
        }

        if (isValid) {
            $("#register-form").addClass("hidden-content");
            var formData = {
                username_regis: userName,
                email: email,
                password_regis: password,
                _token: $('input[name="_token"]').val(),
            };
            console.log(formData, $(this).attr("action"));

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                success: function (response) {
                    console.log("Phản hồi đăng ký:", response);
                    if (response.success) {
                        console.log("Đăng ký thành công");
                        toastr.success(response.message, { timeOut: 5000 });
                    } else {
                        toastr.error(response.message);
                    }
                    $("#register-form")
                        .removeClass("hidden-content")
                        .trigger("reset");
                    $(".loader").hide();
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("Đăng ký thất bại:", xhr.responseJSON || xhr.responseText);
                    toastr.error("Có lỗi xảy ra. Vui lòng thử lại sau.");
                    $("#register-form").removeClass("hidden-content");
                    $(".loader").hide();
                },
            });
        } else {
            $(".loader").hide();
        }
    });