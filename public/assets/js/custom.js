/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */
//delete button
"use strict";

function datatableCallback() {
//jQuery in this context is  used asfunction  access to the jQuery library methods and functionalities
    // Function to handle delete confirmation for elements with data-delete-confirm attribute
    jQuery("[data-delete-confirm]").each(function () {
        // Bind click event to each element
        jQuery(this).on("click", function () {
            // Show the delete confirmation modal
            jQuery("#deleteModal").modal("show");

            // Get the delete URL from the element's data attribute
            //ai url mastr blde de ashs...form r vitre kje lgbo
            const url = jQuery(this).data("delete-confirm");

            // Select necessary elements within the delete modal
            const deleteModelForm = jQuery("#deleteModelForm");
            const deleteModalInput = jQuery("#deleteModalInput");
            const deleteModalButton = jQuery("#deleteModalButton");
            const deleteModalMessage = jQuery("#deleteModalMessage");

            // Set the form action to the delete URL
            deleteModelForm.attr("action", url);

            // Focus on the confirmation input field after a delay
            setTimeout(function () {
                deleteModalInput.focus();
            }, 500);//0.5 sec,,500 milisec//cursor input field e dekhey

            // Event listener for input changes in the confirmation input field
            deleteModalInput.on("input", function () {
                // Display a message if the input is empty
                if (deleteModalInput.val() === "") {
                    deleteModalMessage.text("CONFIRM DELETE");
                } else {
                    deleteModalMessage.text("");//input fld clr
                }
            });//if emty

            // Event listener for the delete button click
            //if not emtpy
            deleteModalButton.on("click", function () {
                // Check if the input matches the confirmation text
                if (deleteModalInput.val() === "CONFIRM DELETE") {
                    deleteModalMessage.text(""); // Clear any previous messages
                    deleteModalInput.val(""); // Clear the input field
                    deleteModelForm.submit(); // Submit the form for deletion
                } else {
                    deleteModalMessage.text("CONFIRM DELETE"); // Display error message
                }
            });
        });
    });
}

$(document).ready(function(){
    // Select the alert and set a timeout function
    setTimeout(function () {
        $('.alert').fadeOut('slow', function() {
            $(this).alert('close');
        })

    }, 10000);
});

