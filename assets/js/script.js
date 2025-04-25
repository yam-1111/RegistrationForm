$(document).ready(function () {


    // validate age
    const dateOfBirthInput = $("#dateofBirth");
    const dobError = $("#dobError");

    // Get today's date
    const today = new Date();

    // Calculate min and max dates
    const minDate = new Date(today.getFullYear() - 150, today.getMonth(), today.getDate()); // 100 years ago
    const maxDate = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate());  // 5 years ago

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

    // submit form
    $('form').on('submit', function (e) {
        e.preventDefault();

        const form = document.getElementById('registerForm');
        const formData = new FormData(form);

        fetch('process_register.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Registration Successful!",
                        text: "Redirecting to welcome page...",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "welcome.php";
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Registration Failed",
                        html: data.errors.map(e => `<p>${e}</p>`).join('')
                    });
                }
            })
            .catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops!",
                    text: "Something went wrong. Please try again."
                });
                console.error(err);
            });
    });


    // show profile picture preview
    $("#profilePicture").change(function (e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function (event) {
            $("#profilePicturePreview").attr("src", event.target.result);
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    });



})