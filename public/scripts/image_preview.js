$("#newImage").change(function() {
    filename = this.files[0].name;
    console.log(filename);
    $(".custom-file-label").html(filename);

    readURL(this);

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
});

$("input[type=reset]").click(function(){
    $(".custom-file-label").html("Choose file...");
    $('#imagePreview').attr('src', '');
});