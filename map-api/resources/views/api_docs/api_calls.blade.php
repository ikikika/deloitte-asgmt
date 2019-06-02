@extends('api_docs.layouts.app')

@section('pre-script')

@endsection

@section('content')
<section class="main-content" role="main">
    <h3 id='api_calls'>API calls</h3>
    <p>Explore the API responses here. </p>
    <p>Need a little help? Read our <a href="{{ route('getting_started') }}">Getting Started</a> to learn about using the API.</p>

    <table style="width:100%;">
        <thead>
            <tr>
                <th style="width:50px;background-color:#0072CE;color:#fff;">GET</th>
                <th>/charging_point/all</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <h4>Implementation Notes</h4>
                    <p>This endpoint returns an array of all charging stations</p>
                    <h4>Response Class (Status 200)</h4>
                    <p id="json1"></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%;">
        <thead>
            <tr>
                <th style="width:50px;background-color:#0072CE;color:#fff;">GET</th>
                <th>/charging_point/{id}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <h4>Implementation Notes</h4>
                    <p>This endpoint returns one charging point by ID</p>
                    <h4>Response Class (Status 200)</h4>
                    <p>Charging station with ID exist</p>
                    <p>/charging_point/1</p>
                    <p id="json2"></p>
                    <h4>Response Class (Status 400)</h4>
                    <p>Charging station with ID does not exist</p>
                    <p>/charging_point/100</p>
                    <p id="json3"></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%;">
        <thead>
            <tr>
                <th style="width:50px;background-color:#0072CE;color:#fff;">GET</th>
                <th>/power_station/all</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <h4>Implementation Notes</h4>
                    <p>This endpoint returns an array of all power stations</p>
                    <h4>Response Class (Status 200)</h4>
                    <p id="json4"></p>
                </td>
            </tr>
        </tbody>
    </table>


</section>
@endsection

@section('after-script')
<script>
    const json1 = {
                    "success": true,
                    "data": [
                                {
                                    "id": 1,
                                    "name": "IKEA Tebrau",
                                    "longitude": "103.7979128",
                                    "latitude": "1.5525572",
                                    "nearest_ps_id": 217,
                                    "nearest_ps_type": "Substation",
                                    "nearest_ps_long": "103.7783176",
                                    "nearest_ps_lat": "1.5461260",
                                    "created_at": null,
                                    "updated_at": null,
                                },
                                "...",
                                {
                                    "id": 21,
                                    "name": "SILK",
                                    "longitude": "101.7192632",
                                    "latitude": "3.0286372",
                                    "nearest_ps_id": 17,
                                    "nearest_ps_type": "Plant",
                                    "nearest_ps_long": "101.7338029",
                                    "nearest_ps_lat": "3.0139605",
                                    "created_at": null,
                                    "updated_at": null,
                                }
                            ]
                    };

        document.getElementById("json1").innerHTML = "<pre>"+JSON.stringify(json1,undefined, 2) +"</pre>"

        const json2 = {"success":true,"data":[{
                                    "id": 1,
                                    "name": "IKEA Tebrau",
                                    "longitude": "103.7979128",
                                    "latitude": "1.5525572",
                                    "nearest_ps_id": 217,
                                    "nearest_ps_type": "Substation",
                                    "nearest_ps_long": "103.7783176",
                                    "nearest_ps_lat": "1.5461260",
                                    "created_at": null,
                                    "updated_at": null,
                                }]};
        document.getElementById("json2").innerHTML = "<pre>"+JSON.stringify(json2,undefined, 2) +"</pre>";

        const json3 = {"success":false,"message":"Charging station with id 100 not found"};
        document.getElementById("json3").innerHTML = "<pre>"+JSON.stringify(json3,undefined, 2) +"</pre>";

        const json4 = {"success":true,"data":[{"id":1,"name":"Substation","longitude":"101.6828513","latitude":"3.0968722","created_at":null,"updated_at":null},{"id":2,"name":"Substation","longitude":"101.6663622","latitude":"3.0770530","created_at":null,"updated_at":null},{"id":3,"name":"Substation","longitude":"101.7075362","latitude":"3.0987255","created_at":null,"updated_at":null}]};
        document.getElementById("json4").innerHTML = "<pre>"+JSON.stringify(json4,undefined, 2) +"</pre>";
</script>
@endsection
