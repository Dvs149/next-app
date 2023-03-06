@extends('admin.layout.admin_layout')
@section('style')
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/dropify/css/dropify.min.css')}}">
    
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/magnific-popup/magnific-popup.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/custom/custom.css')}}">
    <!-- END: Custom CSS-->
    
@endsection
@section('main')
    <!-- BEGIN: Page Main-->
    
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <!-- users list start -->
                    <section class="users-list-wrapper section">
                        <div class="users-list-filter">
                            <div class="card-panel">
                                <div class="card-content">
                                        <h4 class="card-title">Edit User Feedback</h4>
                                        @if(session()->has('message'))
                                            <h5 class="card-title right">{{ session()->get('message') }}</h5>
                                        @endif
                                        <form id="formValidate" method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col s4 input-field">
                                                    <input id="name" name="name" type="text" class="validate" value="{{$feedback_details->name}}" >
                                                    <label for="name" class="active">Name</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="email" name="email" type="text" class="validate" value="{{$feedback_details->email}}" >
                                                    <label for="email" class="active">Email</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="mobile" name="mobile" type="text" class="validate" value="{{$feedback_details->mobile}}" >
                                                    <label for="mobile" class="active">Mobile</label>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </section>
                    <!-- users list ends -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->
@endsection
    
@section('script')
<!-- BEGIN VENDOR JS-->
    <script src="{{asset('app-assets/js/vendors.min.js')}}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('app-assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/sweetalert/sweetalert.min.js')}}"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('app-assets/js/plugins.js')}}"></script>
    <script src="{{asset('app-assets/js/search.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/user-edit-validation.js')}}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <script>
        
        $(document).ready(function () {
           

                $('body').on('click', '.btn-warning-cancel', function (e) {
                    var get_url = $(this).data("url");
                    var id = $(this).data("id");
                    var token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover photo from gallery!",
                            icon: 'warning',
                            dangerMode: true,
                            buttons: {
                                cancel: 'No, Please!',
                                delete: 'Yes, Delete It'
                            }
                        }).then(function (willDelete) {
                            
                            if (willDelete) {
                                $.ajax({
                                    type: "DELETE",
                                    url: get_url,
                                    data: {"_token": "{{ csrf_token() }}","id": id },
                                    success: function (data) {
                                        $('#'+data).remove();
                                        swal("Poof! Your user has been deleted!", {
                                            icon: "success",
                                        });
                                        
                                    },
                                    error: function (data) {
                                          swal({
                                                title: 'Error',
                                                icon: 'error'
                                            })
                                        // console.log('Error:', data);
                                    }
                                });
                                
                            } else {
                                
                            }
                        });
                });

                $('.popup-gallery').magnificPopup({
                    delegate: 'pop',
                    type: 'image',
                    closeOnContentClick: true,
                    fixedContentPos: true,
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile mfp-no-margins mfp-with-zoom',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        verticalFit: true,
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                        titleSrc: function(item) {
                        return item.el.attr('title') + '<small></small>';
                        },
                        zoom: {
                        enabled: true,
                        duration: 300 // don't foget to change the duration also in CSS
                        }
                    }
                });

            $('body').on('change', '.soc_med_order', function (e) {
                var order_given_value = [];
                var order_value = ["0","1","2","3","4","5","6","7","8","9","10"];
                social_order_check();
                // get value for which social media order is given
                $( ".order_given" ).each(function() {
                    order_given_value.push(this.value);
                });

                arr = order_value.filter(item => !order_given_value.includes(item))
                
                //remove selected option which is allready selected
                $(".order_not_given").each(function(){
                    $(".order_not_given option").remove();
                    $.each(arr, function( index, value ) {
                        $(".order_not_given").append(`<option value="${value}">${value!=0?value:'Hide'}</option>`);
                    });
                });

                
                // get required option in the already seleceted
                $(".order_given").each(function(){
                    var current_given_value = this.value;
                    var current_given_id = this.id;
                    var current_select_option =[];
                    
                    $.each(order_given_value, function( index, value ) {
                        if(value!=current_given_value){
                            $('#'+current_given_id+" option[value='"+value+"']").remove();
                        }
                    });
                    
                    $("#"+current_given_id+" option").each(function()
                    {
                        current_select_option.push(this.value);
                    });

                    var result = mergeTwo(current_select_option, arr);
                    
                    $("#"+current_given_id+" option").remove();
                    $.each(result, function( index, value ) {
                        $('#'+current_given_id).append(`<option value="${value}">${value!=0?value:'Hide'}</option>`);
                    });
                    $('#'+current_given_id).val(current_given_value);

                });

                
                $("select.soc_med_order").formSelect();

            
        });
        

        


    });
    </script>
@endsection