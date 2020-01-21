$(document).ready(function() {
    $('#movie__file-input').on('change', function(){
        $('#movie__upload-wrapper').css('display', 'none');
        $('#movie__properties').css('display', 'block');

        var url = $(this).data('url');

        var movie = this.files[0];
        var movieId = $(this).data('movie-id');
        var movieName = movie.name.split('.').slice(0, 1).join('.');
        $('#movie__name').val(movieName);

        var formData = new FormData();

        formData.append('movie_id', movieId);
        formData.append('name', movieName);
        formData.append('movie', movie);

        $.ajax({
            url: url,
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            success: function(movie) {

            },

            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt){
                    if(evt.lengthComputable){
                        var percentComplete = Math.round(evt.loaded / evt.total * 100) + "%";
                        $('#movie__upload-progress').css('width', percentComplete).html(percentComplete)
                    }
                }, false);
                return xhr;
            },
        });
    });
});
