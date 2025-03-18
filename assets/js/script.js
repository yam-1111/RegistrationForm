$(document).ready(function () {


    // validate age
    const dateOfBirthInput = $("#dateofBirth");
    const dobError = $("#dobError");

    // Get today's date
    const today = new Date();

    // Calculate min and max dates
    const minDate = new Date(today.getFullYear() - 150, today.getMonth(), today.getDate()); // 100 years ago
    const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());  // 18 years ago

    // Set min and max attributes for input
    dateOfBirthInput.attr("min", minDate.toISOString().split("T")[0]);
    dateOfBirthInput.attr("max", maxDate.toISOString().split("T")[0]);

    // toggle error 
    dateOfBirthInput.on("change", function () {
        const selectedDate = new Date($(this).val());

        if (selectedDate < minDate || selectedDate > maxDate) {
            dobError.removeClass("d-none"); 
            $(this).addClass("is-invalid"); 
            $(this).val(""); 
        } else {
            dobError.addClass("d-none"); 
            $(this).removeClass("is-invalid"); 
        }
    });

    // Load countries
    $.getJSON("./assets/js/countries.json", function (data) {
        $.each(data, function (key, value) {
            $('#country-select').append('<option value="' + key.code + '">' + value.name + '</option>');
        });
    })

    // toggle passwords 
    $("#togglePassword").click(function () {
        let passwordField = $("#createPassword");
        let icon = $(this);
        togglePasswordVisibility(passwordField, icon);
    });

    $("#toggleConfirmPassword").click(function () {
        let confirmPasswordField = $("#confirmPassword");
        let icon = $(this);
        togglePasswordVisibility(confirmPasswordField, icon);
    });

    function togglePasswordVisibility(field, icon) {
        if (field.attr("type") === "password") {
            field.attr("type", "text");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            field.attr("type", "password");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        }
    }

    // create password
    $("#createPassword").keyup(function () {
        let password = $(this).val();
        let minLength = password.length >= 8;
        let numAndSpecialChar = /^(?=.*[0-9])(?=.*[\W_]).{8,}$/.test(password);

        // Toggle icon based on validation
        if (password === "") {
            $("#password_minlength i, #password_numchar i").removeClass("fa-circle-check fa-circle-xmark text-success text-danger")
                .addClass("fa-circle-xmark text-muted");
        } else {
            $("#password_minlength i").removeClass("fa-circle-check fa-circle-xmark text-success text-danger text-muted")
                .addClass(minLength ? "fa-circle-check text-success" : "fa-circle-xmark text-danger");

            $("#password_numchar i").removeClass("fa-circle-check fa-circle-xmark text-success text-danger text-muted")
                .addClass(numAndSpecialChar ? "fa-circle-check text-success" : "fa-circle-xmark text-danger");
        }
    });

    // confirm password
    $("#confirmPassword").keyup(function () {
        let password = $("#createPassword").val();
        let confirmPassword = $(this).val();

        if (password === confirmPassword && password.length > 0) {
            $(this).removeClass("is-invalid").addClass("is-valid");
        } else {
            $(this).removeClass("is-valid").addClass("is-invalid");
        }
    });


    // submit form
    $('form').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            icon: "success",
            title: "Registration Successful!",
            text: "Thank you for registering!",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "index.html";
            }
        })
    })

    


})