

$("img").on("error", function () {
    $(this).attr("src", "/img/no_image.jpg");
});


function escapeTags(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}