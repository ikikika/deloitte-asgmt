@extends('api_docs.layouts.app')

@section('content')

<section class="main-content" role="main">
    <h3 id="frequently-asked-questions">Frequently Asked Questions</h3>
    <p><strong>Q: Where is the source of the power stations data?</strong></p>
    <p>A: The power station data is obtained from <a href="https://github.com/OpenGridMap/transnet-models/blob/master/asia/malaysia-singapore-brunei/csv_nodes.csv">OpenGridMap's Github</a>.</p>
    <p><strong>Q: Where is the source of the charging stations data?</strong></p>
    <p>A: The charging station data is obtained from <a href="https://api.openchargemap.io/v3/poi/?output=json&countrycode=my&maxresults=10">OpenChargeMap's API</a>.</p>
</section>
@endsection
