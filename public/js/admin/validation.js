function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                if ($("#email").length) {
                    var email = $("#email").val();
                    if(email == '') {
                        $(".validate-email").html("Email is required");
                        event.preventDefault();
                        event.stopPropagation();  
                    } else if (!validateEmail(email)) { 
                        $(".validate-email").html("Enter a vaild email");
                        event.preventDefault();
                        event.stopPropagation();              
                    } else {
                        // $("#validate").removeClass("error");
                    }
                }

                if (($("#profile_pic").val()) && ($("#profile_pic").length)) {
                    const fileSize = ($('#profile_pic')[0].files[0].size / 1024 / 1024).toFixed(2);
                    if (fileSize > 1) {
                        $('#profile_pic').addClass('is-invalid'); 
                        event.preventDefault();
                        event.stopPropagation();  
                    } else $('#profile_pic').removeClass('is-invalid');
                }


                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$('#profile_pic').on('change', function() {
    if ($(this).val()) {
        const size =  (this.files[0].size / 1024 / 1024).toFixed(2); 

        if (size > 1) { 
           $(this).addClass('is-invalid');
        } else $(this).removeClass('is-invalid');

    } else $(this).removeClass('is-invalid');
 
});
 