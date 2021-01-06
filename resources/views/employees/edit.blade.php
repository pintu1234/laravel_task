<form id='edit' action="" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
    <div class="box-body">
        <div id="status"></div>
         {{method_field('PATCH')}}
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> First Name </label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employees->first_name }}"
                   placeholder="">
            <span id="error_first_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Last Name </label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employees->last_name }}"
                   placeholder="">
            <span id="error_last_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Company </label>
            <select class="form-control" id="company" name="company">
                <option value="">--Select--</option>
                <?php
                foreach ($companies as $companies){?>
                <option value="{{$companies->id}}" <?php if($employees->company==$companies->id){echo "selected";}?>>{{$companies->name}}</option>
                <?php } ?>
            </select>
            <span id="error_company" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Email </label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $employees->email }}"
                   placeholder="">
            <span id="error_email" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Phone </label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $employees->phone }}"
                   placeholder="">
            <span id="error_phone" class="has-error"></span>
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
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                company: {
                    required: true
                },
                phone: {
                    required: true,
                    minlength:10,
                    maxlength:10,
                    number: true
                },
                email: {
                    required: true,
                    email: true
                },
            },
            // Messages for form validation
            messages: {
                first_name: {
                    required: 'please enter first name'
                },
                last_name: {
                    required: 'please enter last name'
                },
                company: {
                    required: 'please select company'
                },
                phone: {
                    required: 'please enter phone'
                },
                email: {
                    required: 'please enter email',
                    email: 'invalide  email format',
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#edit")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'employees/' + '{{ $companies->id }}',
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
                            $('#modalemployee').modal('hide'); // hide bootstrap modal
                        }
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });

</script>