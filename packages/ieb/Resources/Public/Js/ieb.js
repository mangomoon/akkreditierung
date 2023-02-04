$(document).ready(function() {

    $('.janein').click(function() {

        if ($(this).hasClass("ja")) {
            var wert = 1;
        } else {
            var wert = 2;
        }


        // alert(wert);

        if (!$(this).hasClass("checked")) {

            $(this).addClass("checked");

            $(this).parent().$('.janein.ckecked').removeClass("checked");


            // 1. set IDBCursorWithValue
            // 2. andere knopf checked
            // 3. dieser unchecked
            // 4. div zeigen
        }

    });


});