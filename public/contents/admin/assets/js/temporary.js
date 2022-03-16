$(function(){
    $('#form').on('submit', function(e){
        e.preventDefault();
        var form = this;
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(form).find('span.error-text').text('');
            },
            success:function(data){
                if(data.code == 0){
                    $.each(data.error, function(prefix,val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                }else{
                    $(form)[0].reset();
                    // alert(data.msg);
                    fetchAllProducts();
                }
            }
        });
    });
    //Reset input file
    $('input[type="file"][name="product_image"]').val('');
    //Image preview
    $('input[type="file"][name="product_image"]').on('change', function(){
        var img_path = $(this)[0].value;
        var img_holder = $('.img-holder');
        var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
        if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
             if(typeof(FileReader) != 'undefined'){
                  img_holder.empty();
                  var reader = new FileReader();
                  reader.onload = function(e){
                      $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                  }
                  img_holder.show();
                  reader.readAsDataURL($(this)[0].files[0]);
             }else{
                 $(img_holder).html('This browser does not support FileReader');
             }
        }else{
            $(img_holder).empty();
        }
    });
    //Fetch all products
    fetchAllProducts();
    function fetchAllProducts(){
        $.get('{{route("fetch.products")}}',{}, function(data){
             $('#AllProducts').html(data.result);
        },'json');
    }

})
