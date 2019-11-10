// view
$("#view").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'overView.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });

});
/* --------------------------------------- */
// valide
$("#valid , #valid1").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');
    $.ajax({
        url: 'valide.php',
        method: 'post',
        success: function (data) {

            $("#fetch").fadeIn(500).html(data);

        }
    });

});
/* --------------------------------------- */
// Import
$("#import").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'import.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });
});
/* --------------------------------------- */
// consulting
$("#consulting").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'consulting.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });
});
/* --------------------------------------- */
// history
$("#history , #history1").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'logging_activity.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });
});
/* --------------------------------------- */
// adding
$("#adding").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'adding.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });
});
/* --------------------------------------- */
// updating
$("#updating").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'updating.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });
});
/* --------------------------------------- */
// updating
$("#deleting").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'deleting.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });
});
/* --------------------------------------- */
// revenue
$("#revenue").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'revenue.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });
});
/* --------------------------------------- */
// popular
$("#pop").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');

    $.ajax({
        url: 'popular.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);

        }
    });
});
/* --------------------------------------- */
// setting
$("#setting").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');
    $.ajax({
        url: 'setting.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);
        }
    });
});
/* --------------------------------------- */
// view
$("#setting").click(function () {
    $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');
    $.ajax({
        url: 'setting.php',
        method: 'post',
        success: function (data) {
            $("#fetch").fadeIn(500).html(data);
        }
    });
});
