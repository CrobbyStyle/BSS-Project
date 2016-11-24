@extends('layout')

@section('otherDependencies')
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
@endsection

@section('content')
<script>
    $(function(){
        $("#tempSlider").slider({animate:"slow"}).slider("float").slider("pips",{first:"pip",last:"pip"});
        $("#humiSlider").slider({animate:"slow"}).slider("float").slider("pips",{first:"pip",last:"pip"});
        $("#noisSlider").slider({animate:"slow"}).slider("float").slider("pips",{first:"pip",last:"pip"});
        $("#voicSlider").slider({animate:"slow"}).slider("float").slider("pips",{first:"pip",last:"pip"});
    });
</script>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('/clock.ico') }}" style="max-width:50px; height:auto;">
        </div>
        <div class="content">
            <div class="title">Breaktime Sensing System - BSS</div>
        </div>
        <div class="controls">
            <div id="tempControl" style="padding-top: 3%">
                <div id="tempSlider"></div>
            </div>
            <div id="humiControl" style="padding-top: 3%">
                <div id="humiSlider"></div>
            </div>
            <div id="noisControl" style="padding-top: 3%">
                <div id="noisSlider"></div>
            </div>
            <div id="voicControl" style="padding-top: 3%">
                <div id="voicSlider"></div>
            </div>
        </div>
    </div>
@endsection