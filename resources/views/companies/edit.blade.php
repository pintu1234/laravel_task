<form id='edit' action="" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
    <div class="box-body">
        <div id="status"></div>
        {{method_field('PATCH')}}
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Name </label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $companies->name }}"
                   placeholder="">
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Email </label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $companies->email }}"
                   placeholder="">
            <span id="error_email" class="has-error"></span>
        </div>
         <div class="form-group col-md-4 col-sm-12">
            <label for=""> Logo </label>
            <input type="file" class="form-control" id="logo" name="logo" value="{{ $companies->logo }}">
            <img src="{{ asset('storage/'.$companies->logo) }}" class="img-thumbnail"  style="height:120px;widht:100px" />
            <input type="hidden" name="hidden_image" value="{{ $companies->logo }}" />       
            <span id="error_logo" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12">
            <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- /.box-body -->
</form>


<script>
    $(document).ready(function () {
        $('#loader').hide();
        $('#edit').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                name: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'Please enter name'
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#edit")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'companies/' + '{{ $companies->id }}',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $("#submit").prop('disabled', true); // disable button
                    },
                    success: function (data) {
                        if(data.error){
                            $("#status").html(data.error).addClass("alert alert-danger");
                            $("#submit").prop('disabled', false);
                        }
                        else{
                            $("#status").html(data.html);
                            reload_table();
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button
                            $("html, body").animate({scrollTop: 0}, "slow");
                            $('#modalCompany').modal('hide'); // hide bootstrap modal
                        }
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });

</script>