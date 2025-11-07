@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("logo",$data->image)
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@stop
@section("container")
    @php
        $name=$data->name;
        $bannerImage=asset('front/images/breadcrumb.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    @endphp
      @include("front.layouts.banner")
      @php
        $guestyapi=$main_data['guestyapi'];
        $start_date=$main_data["start_date"];
        $end_date=$main_data["end_date"];
        $adults=$main_data["adults"];
        $child=$main_data["child"];
        $total_guests=$adults+$child;
        if(isset($guestyapi['data']['rates']['ratePlans'])){
            if(isset($guestyapi['data']['rates']['ratePlans'][0])){
                if(isset($guestyapi['data']['rates']['ratePlans'][0]['money'])){
                    if(isset($guestyapi['data']['rates']['ratePlans'][0]['money']['money'])){
                        $moneyData=$guestyapi['data']['rates']['ratePlans'][0]['money']['money'];
                        $rate_api_id=$guestyapi['data']['rates']['ratePlans'][0]['money']['_id'];
                        $gross_amount=$moneyData['fareAccommodation'];
                        $sub_total=$moneyData['subTotalPrice'];
                        $total_amount=$moneyData['hostPayout'];
                        $taxes=$moneyData['totalTaxes'];
                        $before_total_fees=$moneyData['invoiceItems'];
                        $quote_id=$guestyapi['data']['_id'];
                    }else{
                        @endphp <script>window.location = "{{ url($property->seo_url) }}";</script> @php
                    }
                }else{
                    @endphp <script>window.location = "{{ url($property->seo_url) }}";</script> @php
                }
            }else{
                @endphp <script>window.location = "{{ url($property->seo_url) }}";</script> @php
            }
        }else{
            @endphp <script>window.location = "{{ url($property->seo_url) }}";</script> @php
        }
        $total_guests=$main_data["adults"]+$main_data["childs"];
        $gross_amount=$gross_amount;
        $tax=0;
        $now = strtotime($start_date); 
        $your_date = strtotime($end_date);
        $datediff =  $your_date-$now;
        $day= ceil($datediff / (60 * 60 * 24));
        $total_night=$day;
        $after_total_fees=[];
        $pet_fee=0;
        $total_pets=0;
        $amount_data=[];
        $total_payment=$total_amount;
        $after_total_fees=[];
        $define_tax=0;
    @endphp
   <section class="get-quote-sec">
       <div class="container">
           <div class="row">
              <div class="col-md-12 text-center">
                  <h2>{{$property->title ?? ''}} : Booking Quote</h2>
              </div>
            </div>
            <div class="table-box">
            <div class="quote desk">
            <div class="head-area">
                <div class="row">
                <div class="col-2 col-md-2 col-sm-12 check-in">
                    <h6>Check In</h6>
                </div>
                <div class="col-2 col-md-2 col-sm-12 check-out">
                    <h6>Check Out</h6>
                </div>
                <div class="col-3 col-md-3 col-sm-12 guest">
                    <h6>Total Guests</h6>
                </div>
                <div class="col-2 col-md-2 col-sm-12 nights">
                    <h6>Total Nights</h6>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <h6> Amount</h6>
                </div>
                </div>
            </div>
            <div class="body-area">
                <div class="row">
                <div class="col-2 col-md-2 col-sm-12 check-in">
                    <p>{{date('F jS, Y',strtotime($start_date))}}</p>
                </div>
                <div class="col-2 col-md-2 col-sm-12 check-out">
                    <p>{{date('F jS, Y',strtotime($end_date))}}</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 guest">
                    <p>{{$total_guests}} Guests   ({{ $adults }} Adults , {{ $child }} Child)</p>
                </div>
                <div class="col-2 col-md-2 col-sm-12 nights">
                    <p>{{$day}}</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    
                </div>
                </div>
            </div>
            @foreach($before_total_fees as $c)
                <div class="taxes">
                    <div class="row">
                    <div class="col-9 col-md-9 col-sm-12 tax">
                        <p>{{str_replace("_"," ",$c['title']) }}</p>
                    </div>
                    <div class="col-3 col-md-3 col-sm-12 amt">
                        <p>{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($c['amount'],2)}}</p>
                    </div>
                    </div>
                </div>
            @endforeach
            @php    $apply_button_name="Apply";$apply=0;$error=0; @endphp
            <div class="coupon ">
                <div class="row">
                    <div class="col-9 coupon-field" id="coupon-form" >
                        <div class="coupon-head"><strong>Do you have coupon code?</strong></div>
                        @if(Request::get("coupon"))
                           <form method="get" action="{{ url('get-quote') }}" style="display:inline-block;">
                                @foreach(Request::except(["coupon"]) as $key=>$c_gaurav)
                                    <input type="hidden" name="{{  $key }}" value="{{ $c_gaurav }}" />
                                @endforeach
                                <input type="text" disabled name="coupon" style="height:35px;" value="{{Request::get('coupon')}}" placeholder="Enter Coupon Code" />
                                <button type="submit"  class="btn btn-danger main-btn" > <i class="fa fa-times"></i> Remove</button>
                            </form>
                        @else
                            <form method="get" action="{{ url('get-quote') }}" style="display:inline-block;">
                                <input type="text" name="coupon" style="height:35px;" value="{{Request::get('coupon')}}" placeholder="Enter Coupon Code" />
                                <button type="submit" {{ $apply==1?'disabled':'' }} class="btn btn-success main-btn {{ $apply==1?'d-none':'' }}" >{{ $apply_button_name }}</button>
                                @if($apply==0)
                                    @foreach(Request::except(["coupon"]) as $key=>$c_gaurav)
                                        <input type="hidden" name="{{  $key }}" value="{{ $c_gaurav }}" />
                                    @endforeach
                                @endif
                            </form>
                        @endif
                        @if($apply==1)
                            @if($error==1)
                                <div class="text-danger">Invalid Coupon</div>
                            @endif
                            @if($apply==1)
                            <div class="text-success">Coupon code applied successfully</div>
                            @endif
                        @endif 
                    </div>
                    <div class="col-3 coupon-currency">
                        @if($apply==1) {!! ModelHelper::getDataFromSetting('payment_currency') !!} {{number_format($discount,2)}} @endif
                    </div>
                </div>
            </div>
            <div class="total" style="display:none;">
                <div class="row">
                <div class="col-9 col-md-9 col-sm-12 tl">
                    <p>Total Taxes</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($taxes,2)}}</p>
                </div>
                </div>
            </div>
            <div class="total">
                <div class="row">
                <div class="col-9 col-md-9 col-sm-12 tl">
                    <p>Total</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($total_amount,2)}}</p>
                </div>
                </div>
            </div>
        </div>
        <div class="quote mob">
            <div class="check-in">
                <div class="row">
                    <div class="col-9 col-md-9 col-sm-12 g-amt">
                    <p>Check In</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{{date('F jS, Y',strtotime($start_date))}}</p>
                </div>
                </div>
            </div>
            <div class="check-out">
                <div class="row">
                    <div class="col-9 col-md-9 col-sm-12 g-amt">
                    <p>Check Out</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{{date('F jS, Y',strtotime($end_date))}}</p>
                </div>
                </div>
            </div>
            <div class="guest">
                <div class="row">
                    <div class="col-9 col-md-9 col-sm-12 g-amt">
                    <p>Total Guests</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{{$total_guests}} Guests   ({{ $adults }} Adults , {{ $child }} Child)</p>
                </div>
                </div>
            </div>
            <div class="nights">
                <div class="row">
                    <div class="col-9 col-md-9 col-sm-12 g-amt">
                    <p>Total Nights</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{{$day}}</p>
                </div>
                </div>
            </div>
            <div class="amt">
                <div class="row">
                    <div class="col-9 col-md-9 col-sm-12 g-amt">
                    <p>Amount</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p></p>
                </div>
                </div>
            </div>
             @foreach($before_total_fees as $c)
                        <div class="taxes">
                <div class="row">
                <div class="col-9 col-md-9 col-sm-12 tax">
                    <p>{{str_replace("_"," ",$c['title']) }}</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($c['amount'],2)}}</p>
                </div>
                </div>
            </div>
             @endforeach
            <div class="total">
                <div class="row">
                <div class="col-9 col-md-9 col-sm-12 tl">
                    <p>Sub Total</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($sub_total,2)}}</p>
                </div>
                </div>
            </div>
            <div class="total" style="display:none;">
                <div class="row">
                <div class="col-9 col-md-9 col-sm-12 tl">
                    <p>Total Taxes</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($taxes,2)}}</p>
                </div>
                </div>
            </div>
            <div class="total">
                <div class="row">
                <div class="col-9 col-md-9 col-sm-12 tl">
                    <p>Total</p>
                </div>
                <div class="col-3 col-md-3 col-sm-12 amt">
                    <p>{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($total_amount,2)}}</p>
                </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(["url"=>"save-booking-data","class"=>"","id"=>"paymentFrm"]) !!}
        <input type="hidden" name="discount" value="{{ 0 }}" />
        <input type="hidden" name="discount_coupon" value="{{ Request::get('coupon') }}" />
        <input type="hidden" name="total_pets" value="{{ 0 }}">
        <input type="hidden" name="pet_fee" value="{{ 0 }}">
        <input type="hidden" name="guest_fee" value="{{ 0 }}">
        <input type="hidden" name="rest_guests" value="{{ 0 }}">
        <input type="hidden" name="single_guest_fee" value="{{ 0 }}">
        <input type="hidden" name="total_payment" value="{{ $total_payment }}">
        <input type="hidden" name="amount_data" value="{{ json_encode($amount_data) }}">
        <input type="hidden" name="property_id" value="{{ $property->id }}">
        <input type="hidden" name="checkin" value="{{ $start_date }}" >
        <input type="hidden" name="checkout" value="{{ $end_date }}" >
        <input type="hidden" name="total_guests" value="{{ $total_guests }}" >
        <input type="hidden" name="adults" value="{{ $adults }}" >
        <input type="hidden" name="child" value="{{ $child }}" >
        <input type="hidden" name="gross_amount" value="{{ $gross_amount }}" >
        <input type="hidden" name="total_night" value="{{ $day }}" >
        <input type="hidden" name="sub_amount" value="{{ $sub_total }}" >
        <input type="hidden" name="total_amount" value="{{ $total_amount }}" >
        <input type="hidden" name="after_total_fees" value="{{ json_encode($after_total_fees) }}">
        <input type="hidden" name="before_total_fees" value="{{ json_encode($before_total_fees) }}">
        <input type="hidden" name="request_id" value="{{ uniqid() }}" >
        <input type="hidden" name="tax" value="{{ $taxes }}" >
        <input type="hidden" name="define_tax" value="{{ 0 }}" >
        <input type="hidden" name="rate_api_id" value="{{ $rate_api_id }}">
        <input type="hidden" name="stripe_intent_data_id" value="" id="stripe_intent_data_id">
        <input type="hidden" name="stripe_main_payment_method" value="" id="stripe_main_payment_method">
        <input type="hidden" name="quote_id" value="{{ $quote_id }}" >
        <div class="row ">
            <div class="col-md-12">
                 <div class="row payment">
                    <div class="col-md-6">
                        <div class="form-group">
                            
                           <label>First Name <span class="text-danger">*</span></label>
                            {!! Form::text("firstname",null,["class"=>"form-control","required","placeholder"=>"Enter First Name","id"=>"first_name"])!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                           <label>Last Name <span class="text-danger">*</span></label>
                            {!! Form::text("lastname",null,["class"=>"form-control","required","placeholder"=>"Enter Last Name","id"=>"last_name"])!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                           <label>Email ID <span class="text-danger">*</span></label>
                            {!! Form::email("email",null,["class"=>"form-control","required","placeholder"=>"Enter email","id"=>"email"])!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                           <label>Mobile Number <span class="text-danger">*</span></label>
                            {!! Form::number("mobile",null,["class"=>"form-control","placeholder"=>"Enter mobile","required"])!!}
                        </div>
                    </div>
                    @php
                     $all_data= GuestyApi::getAdditionalFeeData($property->_id);
                    if(isset($all_data['data'])){
                        if(isset($all_data['data']['isPetsAllowed'])){
                            if($all_data['data']['isPetsAllowed']==true){
                                    @endphp
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::label("Pet") !!}
                                                {!! Form::selectRange("total_pets",0,2,null,["class"=>"form-control","placeholder"=>"Choose Pet"])!!}
                                            </div>
                                        </div>
                                    @php
                            }      
                        }
                    }
                    @endphp
                </div>
                <div class="row text-center mt-4 bttn">
                    <div class="">
                        <div class="form-group">
                            <button type="submit" id="submitBtn"  class=" btn-success main-btn" name="operation" value="send-quote">
                             <div class="spinner hidden" id="spinner"></div> <span id="buttonText">Book Now</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       {!! Form::close() !!}
       </div>
   </section>
@stop
<style>
    section.get-quote-sec form .col-md-12 {
    padding: 0px;
}
form#save-booking-data {
    margin-top: var(--m30);
}
input.form-control, textarea, select{
    border: 1px solid var(--black-color) !important;
    border-radius: 0px !important;
    margin-bottom: var(--m20);
}
label{
    margin-bottom: var(--m8);
    color: var(--para-color);
}

.quote div{
    padding:0px;
}
.quote {
    border: 1px solid var(--secondary-color);
    padding: 0px;
}
.head-area {
    background: var(--secondary-color);
}
.quote .col-2, .quote .col-3, .quote .col-9 {
    padding: var(--p8);
    border-right: 1px solid var(--secondary-color);
    border-top: 1px solid var(--secondary-color);
}
.quote .col-2:last-child, .quote .col-3:last-child, .quote .col-9:last-child {
    border-right: 0px solid var(--other-color);
}
.quote .head-area .col-2, .quote .head-area  .col-3{
    border-top: 0px solid var(--other-color);
}
.quote .head-area .col-2, .quote .head-area  .col-3{
    border-right: 1px solid var(--white-color);
}
.quote .head-area .col-2:last-child, .quote .head-area  .col-3:last-child{
    border-right: 0px solid var(--white-color);
}
.quote .head-area  .amt h6, .quote .amt p{
    text-align: right;
}
.head-area h6 {
    font-size: var(--f16);
    line-height: 1.3;
    font-weight: 600;
    color: var(--white-color);
    margin-bottom: 0;
    text-align: center;
    text-transform: uppercase;
    font-family: var(--primary-font);
}

.quote .col-2 p, .quote .col-3 p, .quote .col-9 p{
    margin-bottom: 0px;
}
.quote .col-9 p{
    font-weight:700;
}

/*Stripe payment css*/
h3.quote-head {
    text-align: center;
    margin-bottom: var(--m10);
    font-size: var(--f25);
}

.pro-detail .head-area {
    background: var(--secondary-color);
    padding: var(--p8);
}
.pro-detail {
    border: 1px solid var(--other-color);
    padding: 0px;
    margin-bottom: var(--m30);
}

.pro-detail .col-2, .pro-detail .col-3, .pro-detail .col-9 {
    padding: var(--p8);
    border-right: 1px solid var(--other-color);
    border-top: 1px solid var(--other-color);
}
.pro-detail .col-9{
    border-right: 0px solid var(--other-color);
}
.pro-detail p{
    margin-bottom:0px;
}
.pro-detail .col-3 p{
    font-weight:bold;
}

.row.card-detail {
    padding: 0px;
    margin-top: var(--m30);
}
.row.card-detail .col-md-12{
   padding: 0px; 
}
.row.card-detail h3{
    padding:0px;
}
.row.card-detail .form-group {
    padding: 0px;
    border: 0px solid;
}
.row.card-detail .col-md-4 {
    flex: 0 0 auto;
    width: 32.66%;
}
.row.card-detail .form-row.row {
    gap: 0 1%;
}
.row.card-detail .row.mt-4 {
    margin-top: 0px !important;
    text-align: center;
}
.row.card-detail .row.mt-4 .col-xs-12 {
    padding: 0px;
}
.row.card-detail .row.mt-4 label{
    display:none;
}
.payment{
   justify-content: space-between;
   padding-top: var(--p20);
}
.payment .col-md-6{
    width:49%;
    padding:0;
}

.quote.mob {
    display: none;
}

div#paymentElement {
    border: 1px solid var(--black-color);
    padding: 6px 12px;
}
button#submitBtn {
    background: var(--secondary-color);
    
}
.coupon button.main-btn{
    padding: var(--p6) var(--p20);
    border-radius: 0px;
}
.coupon input{
    border-radius: 0px;
    font-size: 14px;
    padding: 0 8px;
    border: 1px solid var(--black-color);
}
@media (max-width: 980px){
    section.get-quote-sec h2 {
    font-size: var(--f32);
    }
    .col-md-12.text-center {
    padding: 0px;
    }
    .row.card-detail h3{
    font-size: var(--f28);
}

}
@media (max-width: 540px){
    .quote.mob{
        display:block;
        border-top: 0px solid;
    }
    .quote.desk{
        display:none;
    }
    section.get-quote-sec h2 {
    font-size: var(--f28);
}
.quote.mob .head-area .col-6.col-md-6.col-sm-12 {
    border-right: 1px solid var(--white-color);
}
.quote.mob .col-9 {
    flex: 0 0 auto;
    width: 60%;
}
.quote .col-9 p{
    text-align:left;
}
.quote.mob .col-3 {
    flex: 0 0 auto;
    width: 40%;
}
.quote.mob p{
    font-size: var(--f15);
    line-height: 1.5;
}
.row.card-detail h3{
    font-size: var(--f26);
}
h3.quote-head{
    font-size: var(--f22);
}
.pro-detail p {
    margin-bottom: 0px;
    font-size: var(--f15);
    line-height: 1.5;
}
.row.card-detail .col-md-4 {
    flex: 0 0 auto;
    width: 100%;
}
section.payment h4{
    padding: 0px !important;
}
section.payment p {
    padding: 0px !important;
    word-wrap: break-word;
}
.pro-detail .col-3.col-md-3.col-sm-12.pdl {
    width: 40%;
}
.pro-detail .col-9.col-md-9.col-sm-12.amt {
    width: 60%;
}
}
@media (max-width: 360px){
    
}
</style>
@section("css")
    @parent
    <link rel="stylesheet" href="{{ asset('front')}}/css/get-quote.css" />
    <link rel="stylesheet" href="{{ asset('front')}}/css/get-quote-responsive.css" />
@stop 
@section("js")
    @parent
    <script src="{{ asset('front')}}/js/get-quote.js" ></script>
    <script>
    $(document).on("change","#is_coupon",function(){
        if($(this).prop("checked")==true){
            $("#coupon-form").show();
        }else{
            $("#coupon-form").hide();
        }
    });
    $(function(){
        @if(Request::get("coupon"))
            $("#is_coupon").prop("checked","true");
            $("#coupon-form").show();
        @endif
    });
</script>
@stop