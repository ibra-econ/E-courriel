(function ($) {
    "use strict";

    /*-------------------------------------
	Background image
	-------------------------------------*/
    $("[data-bg-image]").each(function () {
        var img = $(this).data("bg-image");
        $(this).css({
            backgroundImage: "url(" + img + ")",
        });
    });

    /*-------------------------------------
    After Load All Content Add a Class
    -------------------------------------*/
    window.onload = addNewClass();

    function addNewClass() {
        $(".fxt-template-animation")
            .imagesLoaded()
            .done(function (instance) {
                $(".fxt-template-animation").addClass("loaded");
            });
    }

    /*-------------------------------------
    Toggle Class
    -------------------------------------*/
    $(".toggle-password").on("click", function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });


    /*-------------------------------------
    Vegas Slider
    -------------------------------------*/
    if ($.fn.vegas !== undefined && $("#vegas-slide").length) {
        var target_slider = $("#vegas-slide"),
            vegas_options = target_slider.data("vegas-options");
        if (typeof vegas_options === "object") {
            target_slider.vegas(vegas_options);
        }
    }

    /*-------------------------------------
    OTP Form (Focusing on next input)
    -------------------------------------*/
    $("#otp-form .otp-input").keyup(function () {
        if (this.value.length == this.maxLength) {
            $(this).next(".otp-input").focus();
        }
    });

    /*-------------------------------------
	Social Animation
	-------------------------------------*/
    $("#fxt-login-option >ul >li").hover(function () {
        $("#fxt-login-option >ul >li").removeClass("active");
        $(this).addClass("active");
    });

    /*-------------------------------------
    Preloader
    -------------------------------------*/
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 1);
    };
    spinner();

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });


})(jQuery);
