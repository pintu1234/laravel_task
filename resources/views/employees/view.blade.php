<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
            <tr>
                <td class="subject"> Name</td>
                <td> :</td>
                <td> {{ $employees->first_name }} </td>
            </tr>
            <tr>
                <td class="subject"> Last Name </td>
                <td> :</td>
                <td> {{ $employees->last_name }} </td>
            </tr>
            <tr>
                <td class="subject"> Email </td>
                <td> :</td>
                <td> {{ $employees->email }} </td>
            </tr>
            <tr>
                <td class="subject"> Phone </td>
                <td> :</td>
                <td> {{ $employees->phone }} </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>