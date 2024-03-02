<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Insurance </title>
</head>

<body>
    <h3 style="color: brown;">Crop Insurance Application Form</h3>

    <div>
        <table>
            <form action="submitdetails" method="post">
                @csrf
                <tr>
                    <td><b> Season: </b></td>
                    <td>
                        <select name="season" id="season" required>
                            <option value="" hidden>-select-</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b> Crop Name:</b></td>
                    <td>
                        <select name="crop" id="crop" required>
                            <option value="" hidden>-select-</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><b>Farmer Name:</b> </td>
                    <td> <input type="text" name="farmer" id="farmer" required></td>
                </tr>
                <tr>
                    <td><b> Aadhaar no :</b> </td>
                    <td><input type="number" name="aadhar" id="aadhar" required></td>
                </tr>
                <tr>
                    <td><b> Father Name:</b> </td>
                    <td> <input type="text" name="father" id="father" required></td>
                </tr>
                <tr>
                    <td><b>Complete Address:</b> </td>
                    <td><textarea name="address" id="address" required></textarea>

                </tr>
                <tr>
                    <td><b> Farmer Category: </b></td>
                    <td>
                        <input type="radio" name="category" value="small">Small
                        <input type="radio" name="category" value="medium"> Medium
                        <input type="radio" name="category" value="large"> Large
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" value="Submit"> <input type="reset" id="clear" value="Clear">
                    </td>
                </tr>
            </form>
        </table>
    </div>
    <p style="color: red; background-color:yellow; width:300px ">{{isset($message)?$message:''}}</p>
    @php
    $i=1;
    @endphp
    <div>

        <table border="1px" style="border-collapse: collapse; text-align:center">
            <tr>
                <th>SL#</th>
                <th>Season</th>
                <th>Crop</th>
                <th>Aadhar</th>
                <th>Farmer</th>
                <th>Father</th>
                <th>Address</th>
                <th>FarmerCategory</th>
            </tr>
            @foreach($result as $row)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$row->sname}}</td>
                <td>{{$row->cname}}</td>
                <td>{{$row->aadhar}}</td>
                <td>{{$row->farmername}}</td>
                <td>{{$row->fathername}}</td>
                <td>{{$row->address}}</td>
                <td>{{$row->category}}</td>
            </tr>
            @endforeach
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: "getseason",
                type: "get",
                dataType: "JSON",
                data: {},
                success: function(res) {
                    json_text = JSON.stringify(res);
                    obj = JSON.parse(json_text);
                    obj.forEach(element => {
                        $('#season').append('<option value="' + element.sid + '">' + element.sname + '</option>');
                    });
                }
            })


            $('#season').change(function() {
                var season = $("#season").val();
                op = '';
                $.ajax({
                    url: "getcrop",
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        season: season
                    },
                    success: function(res) {
                        json_text = JSON.stringify(res);
                        obj = JSON.parse(json_text);
                        obj.forEach(element => {
                            op += ('<option value="' + element.cid + '">' + element.cname + '</option>');
                        });
                        $('#crop').html(op);
                    }
                })
            });

            $('#farmer').blur(function() {
                var farmerName = $(this).val();
                if (farmerName.length > 50 || /[^a-zA-Z\s]/.test(farmerName)) {
                    alert('Not more than 50 characters.Only alphabets allowed..!!');
                    $(this).val('');
                }
            });

            $('#father').blur(function() {
                var father = $(this).val();
                if (father.length > 12 || /[^a-zA-Z\s]/.test(father)) {
                    alert('Not more than 12 characters. Only alphabets allowed..!!');
                    $(this).val('');
                }
            });

            $('#address').blur(function() {
                var address = $(this).val();
                if (address.length > 250 || /[^a-zA-Z0-9\s]/.test(address)) {
                    alert('Not more than 250 characters..!!');
                    $(this).val('');
                }
            });

            $('#aadhar').blur(function() {
                var aadhar = $(this).val();
                if (aadhar.length > 12) {
                    alert('Aadhar should be of 12 digits..!!');
                    $(this).val('');
                }
            });


            $('#clear').click(function() {
                $('#crop').html('<option value="0" hidden>-select-</option>');
            })

        });
    </script>
</body>

</html>