@extends('frontend.master')

@section('title')
    {{$page_title}}
@endsection

@push('style')
<style>
    .widget ul li {
        line-height: 1.5 !important;
    }
    .product-card{
        position: relative;
        width: 90%;
        height: 220px;
        background: #fff;
        margin: 30px 5%;
        padding: 20px 0;
        border: 2px solid #00c1eb;
        transition: 0.3s ease-in-out;
        
    }
    .product-card:hover{
        height: 340px;
    }
    .product-card .img-box{
        position: relative;
        width: 70%;
        height: 220px;
        top: -50px;
        margin: 0 auto;
        z-index: 1;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        background: #fff;
    }
    .product-card .img-box img{
        width: 100%;
        height: 100%;
    }
    .product-card .content{
        position: relative;
        margin-top: -120px;
        padding: 10px 15px;
        text-align: center;
        visibility: hidden;
        opacity: 0;
        transition: 0.3s ease-in-out
    }
    .product-card:hover .content{
        visibility: visible;
        opacity: 1;
        margin-top: -60px;
        transition-delay: 0.3s;
    }
    .product-card .content h4{
        font-size: 15px;
    }
</style>
@endpush

@section('content')
<div class="main-content">

    <!-- Section: Banner -->
    @include('frontend::banner.banner')


    <section>
        <div class="container pb-60">
            <div class="section-content">
                <div class="row">
                    <div class="col-lg-3 sidebar-area sidebar-right">
                        <div class=" split-nav-menu clearfix widget widget_search">
                            <form  method="post" class="search-form">
                                <input type="search" class="form-control search-field" placeholder="Search.." name="phone" id="phone">
                                <button type="button" class="search-submit"  style="cursor: pointer;"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_categories">
                            <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Brands</h4>
                            <ul>
                                @if ($brands->count())
                                    @foreach ($brands as $brand)
                                    <li class="">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input brand_id" onchange="" name="brand_id" value="{{$brand->id}}" id="{{$brand->id.'_brand'}}">
                                            <label class="custom-control-label {{$brand->id.'_brand_text'}}" for="{{$brand->id.'_brand'}}" >{{$brand->brand_name}}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9" id="product_section">
                        <div class="widget widget_categories">
                            <h4 style="font-size: 1.5rem !important;" class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Products</h4>
                        </div>
                        <div class="row" id="product-list">
                            
                        </div>
                        <input type="hidden" name="hidden_page" class="form-control" id="hidden_page" value="1" />
                        <div id="product_loading" class="row" style="height: 100vh;background: white;">
                            <div class="col-md-12  text-center py-5">
                                <img src="svg/table-loading.svg" alt="Loading.."/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('script')
<script>
$(document).ready(function(){
    let _changeInterval = null;
    load_products();
    $(document).on('click', ".search-submit", function () {
        let phone = $(".search-form #phone").val();
        load_products('',phone,'','');
    });
    $(document).on('keydown', "#phone", function () {
        clearInterval(_changeInterval)
        _changeInterval = setInterval(function() {
            clearInterval(_changeInterval);
            $(".brand_id").prop('checked', false);
        }, 1000);
    });

    $(document).on('change', ".brand_id", function () {

        $(".search-form #phone").val('');
        //Getting status before unchecking all
        var status = $(this).prop("checked");

        $(".brand_id").prop('checked', false);
        $(this).prop('checked', true);

        //false means checkbox was checked and became unchecked on change event, so let it stay unchecked
        if (status === false) {
            $(this).prop('checked', false);
            load_products();
        }else{
            let brand_id = $(this).val();
            let brand_text = $("."+brand_id+"_brand_text").text();
            load_products('','',brand_id,brand_text);
        }
    });

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        $('li').removeClass('active');
        $(this).parent().addClass('active');
        let phone = $(".search-form #phone").val();
        let brand_id = $('.brand_id:checked').val();
        let brand_text = $("."+brand_id+"_brand_text").text();
        load_products(page, phone,brand_id,brand_text);
        if(window.innerWidth < 768){
            $('html,body #product_section').animate({
                scrollTop:500
            });
        }else{
            $('html,body #product_section').animate({
                scrollTop:350
            });
        }
        
    });

    function load_products(page='',phone='',brand_id='',brand_text=''){
        let category="{{$category}}";
        if(category){
            $.ajax({
                url: "{{route('product.list')}}",
                type: "POST",
                data:{category:category,page:page,phone:phone,brand_id:brand_id,brand_text:brand_text,_token:"{{csrf_token()}}"},
                dataType: "JSON",
                beforeSend: function () {
                    $('#product-list').html('');
                    $('#product_loading').show();
                },
                complete: function () {
                    $('#product_loading').hide();
                },
                success: function (data) {
                    
                    $('#product-list').html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    }
});
</script>
@endpush
