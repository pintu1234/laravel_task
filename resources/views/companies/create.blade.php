<form id='create' action="" enctype="multipart/form-data" method="post"
      accept-charset="utf-8">
    <div class="box-body">
        <div id="status"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Name </label>
            <input type="text" class="form-control" id="name" name="name" value=""
                   placeholder="">
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Email </label>
            <input type="text" class="form-control" id="email" name="email" value=""
                   placeholder="">
            <span id="error_email" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Logo </label>
            <input type="file" class="form-control" id="logo" name="logo" value=""
                   placeholder="">
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
        $('#create').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'please enter name'
                },
                email: {
                    required: 'please enter email',
                    email: 'invalide  email format',
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#create")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'companies',
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
                        console.log(data.error);
                        if(data.error){
                            $("#status").show();
                            $("#status").html(data.error).addClass("alert alert-danger");
                            $("#submit").prop('disabled', false);
                        }
                        else{
                        $("#status").html(data.success).addClass("alert alert-success");;
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