@extends('api_docs.layouts.app')

@section('content')

<section class="main-content" role="main">
    <h3>Field reference for API data</h3>

    <p>The fields below are required in the API.</p>

    <h5>API Fields</h5>

    <table id="city-pairs-fields" class="field-table">
        <colgroup>
            <col span="1" style="width: 36%;">
            <col span="1" style="width: 36%;">
            <col span="1" style="width: 18%;">

        </colgroup>
    <thead>
        <tr>
            <th>Field name</th>
            <th>Description</th>
            <th>Data type</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <code>ID</code>
            </td>
            <td>Unique identifier.</td>
            <td>integer</td>
        </tr>
    </tbody>
    </table>
</section>
@endsection
