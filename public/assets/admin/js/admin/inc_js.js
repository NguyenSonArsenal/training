$(document).ready(function () {
    $('.btn_destroy').click(function (e) {
        if (!confirm('Bạn có chắc chắn muốn xóa danh mục này không'))
        {
            e.preventDefault();
        }
    });

    // Set and count length characters input text or taextrea
    function setLength(field, fieldname, needle) {
        $('#'+ needle).html($(field + '[name="' + fieldname + '"]').val().length);

        $(field + '[name="' + fieldname + '"]').on('keyup', function(){
            $('#' + needle).html(this.value.length);
        });
    }

});
