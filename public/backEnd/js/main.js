(function ($) {
    if ($(".primary_select").length) {
        $(".primary_select").niceSelect();
    }
    if ($(".nice_Select").length) {
        $(".nice_Select").niceSelect();
    }
    if ($(".nice_Select3").length) {
        $(".nice_Select3").niceSelect();
    }

    var fileInput = document.getElementById("browseFile");
    if (fileInput) {
        fileInput.addEventListener("change", showFileName);

        function showFileName(event) {
            var fileInput = event.srcElement;
            var fileName = fileInput.files[0].name;
            document.getElementById("placeholderInput").placeholder = fileName;
        }
    }

    var fileInp = document.getElementById("browseFil");
    if (fileInp) {
        fileInp.addEventListener("change", showFileName);

        function showFileName(event) {
            var fileInp = event.srcElement;
            var fileName = fileInp.files[0].name;
            document.getElementById("placeholderIn").placeholder = fileName;
        }
    }

    if ($(".multipleSelect").length) {
        $(".multipleSelect").fastselect();
    }

    $(".input-effect input").each(function () {
        if ($(this).val().length > 0) {
            $(this).addClass("read-only-input");
        } else {
            $(this).removeClass("read-only-input");
        }

        $(this).on("keyup", function () {
            if ($(this).val().length > 0) {
                $(this).siblings(".invalid-feedback").fadeOut("slow");
            } else {
                $(this).siblings(".invalid-feedback").fadeIn("slow");
            }
        });
    });

    $(".input-effect textarea").each(function () {
        if ($(this).val().length > 0) {
            $(this).addClass("read-only-input");
        } else {
            $(this).removeClass("read-only-input");
        }
    });

    $(window).on("load", function () {
        $(".input-effect input, .input-effect textarea").focusout(function () {
            if ($(this).val() != "") {
                $(this).addClass("has-content");
            } else {
                $(this).removeClass("has-content");
            }
        });
    });

    // CK Editor
    if ($("#ckEditor").length) {
        CKEDITOR.replace("ckEditor", {
            skin: "moono",
            enterMode: CKEDITOR.ENTER_BR,
            shiftEnterMode: CKEDITOR.ENTER_P,
            toolbar: [
                {
                    name: "basicstyles",
                    groups: ["basicstyles"],
                    items: [
                        "Bold",
                        "Italic",
                        "Underline",
                        "-",
                        "TextColor",
                        "BGColor",
                    ],
                },
                { name: "styles", items: ["Format", "Font", "FontSize"] },
                { name: "scripts", items: ["Subscript", "Superscript"] },
                {
                    name: "justify",
                    groups: ["blocks", "align"],
                    items: [
                        "JustifyLeft",
                        "JustifyCenter",
                        "JustifyRight",
                        "JustifyBlock",
                    ],
                },
                {
                    name: "paragraph",
                    groups: ["list", "indent"],
                    items: [
                        "NumberedList",
                        "BulletedList",
                        "-",
                        "Outdent",
                        "Indent",
                    ],
                },
                { name: "links", items: ["Link", "Unlink"] },
                { name: "insert", items: ["Image"] },
                { name: "spell", items: ["jQuerySpellChecker"] },
                { name: "table", items: ["Table"] },
            ],
        });
    }

    //for check
    $(".radio_question").on("click", function (event) {
        $(this).siblings(".active").removeClass("active");
        $(this).addClass("active");
    });

    // data table responsive problem tab
    $(document).ready(function () {
        $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
            if ($.fn.dataTable) {
                $($.fn.dataTable.tables(true))
                    .DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            }
        });
    });

    $(document).on("submit", "form", function () {
        $(".prelaoder_wrapper").fadeOut("slow", function () {
            $(this).show();
        });
    });
    
    // Show file name
    $(".file_upload").on("change", function () {
        var file = $(this).val();
        var fileName = file.split("\\");
        fileName = fileName[fileName.length - 1];
        $(this)
            .closest(".primary_file_uploader")
            .find(".primary_input_field")
            .val(fileName);
    });
    ("use strict");

    $(document).ready(function() {
        $('.nav-tabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
})(jQuery);
