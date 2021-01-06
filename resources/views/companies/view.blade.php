<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
            <tr>
                <td class="subject"> Name</td>
                <td> :</td>
                <td> {{ $companies->name }} </td>
            </tr>
            <tr>
                <td class="subject"> Email </td>
                <td> :</td>
                <td> {{ $companies->email }} </td>
            </tr>
            <tr>
                <td class="subject"> Logo </td>
                <td> :</td>
                <td> <img src="{{ asset('storage/'.$companies->logo) }}" class="img-thumbnail"  style="height:120px;widht:100px" /> </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>