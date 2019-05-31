@extends('api_docs.layouts.app')

@section('content')

<section class="main-content" role="main">
    <h3 id="overview">Overview</h3>

    <p>This data provided by the API described in this documentation are: </p>
    <ul>
        <li>Locations of charging stations in Malaysia and information (location and type) of their nearest power grid sub-transformer. </li>
        <li>Locations of all power grid sub-transformer in Malaysia.</li>
    </ul>

    <h5 id="using-the-api">Using the API</h5>
    <p>This API documentation is organised into four major areas.</p>

    <ul>
        <li><a href="{{ route('getting_started') }}">Getting started</a> introduces you to the operations offered by the API.</li>
        <li><a href="{{ route('api_calls') }}">API calls</a> gives you a hands-on experience of those operations with an interactive console.</li>
        <li><a href="{{ route('field_reference') }}">Field reference</a> lists and describes the type of information provided by the API.</li>
        <li><a href="{{ route('faq') }}">Frequently Asked Questions (FAQ)</a> Here are answers to some frequently asked questions.</li>
        <li><a href="{{ route('contact') }}">Contact Us</a> If you need support or need to get in touch, this is the place to look.</li>
    </ul>

</section>
@endsection
