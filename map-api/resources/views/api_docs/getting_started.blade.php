@extends('api_docs.layouts.app')

@section('content')

<section class="main-content" role="main">
    <h3 id="getting-started">Getting Started</h3>

    <p>The current version of the API lives at <code class="highlighter-rouge">http://mapapi.jitooi.com/api</code>.</p>

    <p>This API can be accessed by: </p>

    <ul>
    <li>Directly inserting the API Endpoint into a browser's address bar.</li>
    <li>HTTP client software such as Postman.</li>
    </ul>

    <h4 id="versions">Versions</h4>

    <table>
        <thead>
            <tr>
                <th>Version</th>
                <th>Date</th>
                <th>Changes</th>
            </tr>
        </thead>
    <tbody>
        <tr>
            <td><code class="highlighter-rouge">version 1</code></td>
            <td>2019-06-01</td>
            <td>Initial deployment</td>
        </tr>
    </tbody>
    </table>

    <h4 id="endpoints">Endpoints</h4>

    <table>
        <thead>
            <tr>
                <th>Endpoint</th>
                <th>What it does</th>
            </tr>
        </thead>
    <tbody>
        <tr>
            <td><code class="highlighter-rouge">/charging_station/all</code></td>
            <td>Returns an array of all charging stations</td>
        </tr>
        <tr>
            <td><code class="highlighter-rouge">/charging_station/{id}</code></td>
            <td>Returns an object of one charging station based on unique identifier.</td>
        </tr>
        <tr>
            <td><code class="highlighter-rouge">/power_station/all</code></td>
            <td>Returns an array of all power stations</td>
        </tr>
    </tbody>
    </table>


    </section>
@endsection
