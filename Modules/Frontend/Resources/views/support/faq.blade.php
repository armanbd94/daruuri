@extends('frontend.master')

@section('title')
{{$page_title}}
@endsection

@push('style')
<style>
    a:hover,
    a:focus {
        text-decoration: none;
        outline: none;
    }

    #accordion .panel {
        border: none;
        border-radius: 0;
        box-shadow: none;
        margin: 0 0 10px;
        overflow: hidden;
        position: relative;
    }

    #accordion .panel-heading {
        padding: 0;
        border: none;
        border-radius: 0;
        margin-bottom: 10px;
        z-index: 1;
        position: relative;
    }

    #accordion .panel-heading:before,
    #accordion .panel-heading:after {
        content: "";
        width: 50%;
        height: 20%;
        box-shadow: 0 15px 5px rgba(0, 0, 0, 0.4);
        position: absolute;
        bottom: 15px;
        left: 10px;
        transform: rotate(-3deg);
        z-index: -1;
    }

    #accordion .panel-heading:after {
        left: auto;
        right: 10px;
        transform: rotate(3deg);
    }

    #accordion .panel-title a {
        display: block;
        padding: 15px 70px 15px 70px;
        margin: 0;
        background: #fff;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        color: #1bacd6;
        border-radius: 0;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        position: relative;
    }

    #accordion .panel-title a:before,
    #accordion .panel-title a.collapsed:before {
        content: "\f106";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        width: 55px;
        height: 100%;
        text-align: center;
        line-height: 50px;
        border-left: 2px solid #1bacd6;
        position: absolute;
        top: 0;
        right: 0;
    }

    #accordion .panel-title a.collapsed:before {
        content: "\f107";
    }

    #accordion .panel-title a .icon {
        display: inline-block;
        width: 55px;
        height: 100%;
        border-right: 2px solid #1bacd6;
        font-size: 20px;
        color: rgba(0, 0, 0, 0.7);
        line-height: 50px;
        text-align: center;
        position: absolute;
        top: 0;
        left: 0;
    }

    #accordion .panel-body {
        padding: 10px 20px;
        margin: 0 0 20px;
        border-bottom: 3px solid #1bacd6;
        border-top: none;
        background: #fff;
        font-size: 15px;
        color: #333;
        line-height: 27px;
    }
</style>
@endpush

@section('content')
<div class="main-content">

    <!-- Section: Banner -->
    @include('frontend::banner.banner')

    <!-- Section: Service -->
    <section>
        <div class="container pb-70">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @if ($faqs->count())
                                @foreach ($faqs as $key => $value)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading{{$key+1}}">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapse{{$key+1}}" aria-expanded="false" aria-controls="collapse{{$key+1}}">
                                                <i class="icon fas fa-question-circle"></i>
                                                {{$value->question}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{$key+1}}" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="heading{{$key+1}}">
                                        <div class="panel-body">
                                            <p>{{$value->answer}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
