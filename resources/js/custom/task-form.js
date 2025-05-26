$(document).ready(function () {
    $(".select2").select2({
        placeholder: "Search or select",
        allowClear: true,
    });

    // FREELANCER AJAX
    $("#freelancerForm").on("submit", function (e) {
        e.preventDefault();

        // Clear all previous error texts
        $(".error-text").text("");

        $.ajax({
            url: "/freelancers", // Your actual route
            method: "POST",
            data: $(this).serialize(),
            success: function (freelancer) {
                // On success, reset the form and close modal
                $("#freelancerForm")[0].reset();
                $("#addFreelancerModal").modal("hide");

                // Optionally update assigned_to select, if applicable
                $("#assigned_to")
                    .append(
                        new Option(freelancer.name, freelancer.id, true, true)
                    )
                    .trigger("change");

                // You can show a success Toastr or just leave silent
                toastr.success("Freelancer added successfully!");
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Laravel validation error object
                    let errors = xhr.responseJSON.errors;

                    // Loop through errors and display each below the matching input
                    $.each(errors, function (key, messages) {
                        // Key = field name, messages = array of errors
                        $("#error-" + key).text(messages[0]); // Show first error message below input
                    });
                } else {
                    toastr.error(
                        "An unexpected error occurred. Please try again."
                    );
                }
            },
        });
    });

    // Client form AJAX
    $("#clientForm").submit(function (e) {
        e.preventDefault();
        clearErrors("#clientForm");

        $.ajax({
            url: "/clients",
            method: "POST",
            data: $(this).serialize(),
            success: function (client) {
                toastr.success("Client added successfully!");
                $("#addClientModal").modal("hide");
                $("#clientForm")[0].reset();

                // Add new client to the select and make it selected
                $("#clientSelect") // <-- replace with your actual client select ID or class
                    .append(new Option(client.name, client.id, true, true))
                    .trigger("change");
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    showErrors("#clientForm", xhr.responseJSON.errors);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            },
        });
    });

    // Fiverr form AJAX
    $("#fiverrForm").submit(function (e) {
        e.preventDefault();
        clearErrors("#fiverrForm");

        $.ajax({
            url: "/fiverr-accounts",
            method: "POST",
            data: $(this).serialize(),
            success: function (fiverr) {
                toastr.success("Fiverr Account added successfully!");
                $("#addFiverrModal").modal("hide");
                $("#fiverrForm")[0].reset();

                // Add new Fiverr account to the select and make it selected
                $("#fiverrSelect") // <-- replace with your actual Fiverr select ID or class
                    .append(new Option(fiverr.username, fiverr.id, true, true))
                    .trigger("change");
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    showErrors("#fiverrForm", xhr.responseJSON.errors);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            },
        });
    });

    // Helper to clear old error messages and highlights
    function clearErrors(formSelector) {
        $(`${formSelector} .error-text`).text("");
        $(`${formSelector} input, ${formSelector} select`).removeClass(
            "is-invalid"
        );
    }

    // Helper to show validation errors below fields
    function showErrors(formSelector, errors) {
        $.each(errors, function (key, messages) {
            $(`${formSelector} #error-${key}`).text(messages[0]);
            $(`${formSelector} [name="${key}"]`).addClass("is-invalid");
        });
    }
});
