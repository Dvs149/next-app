@extends('admin.layout.admin_layout')
@section('style')
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/page-users.css')}}">
    <!-- END: Page Level CSS-->
@endsection
@section('main')
    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    
                    <!-- users list start -->
                    <section class="users-list-wrapper section">
                        
                        <div class="users-list-table">
                            <div class="card">
                                <div class="card-content">
                                    <!-- datatable start -->
                                    <div class="responsive-table">
                                        <table id="users-list-datatable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>

                                                    <th>Name</th>
                                                    <th>Message</th>
                                                    <th>Type</th>
                                                    <th>Rate</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            
                                        </table>
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- users list ends -->
                </div>
                <div class="content-overlay"></div>
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
    <script src="{{asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/sweetalert/sweetalert.min.js')}}"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('app-assets/js/plugins.js')}}"></script>
    <script src="{{asset('app-assets/js/search.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.js')}}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="{{asset('app-assets/js/custom/user-list.js')}}"></script> --}}
    <!-- END PAGE LEVEL JS-->
    <script>
        $(document).ready(function () {

                $('.modal').modal();

                $('body').on('click', '.btn-warning-cancel', function (e) {
                    var get_url = $(this).data("url");
                    var id = $(this).data("id");
                    var token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this user!",
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
                                        swal("Poof! Your user has been deleted!", {
                                            icon: "success",
                                        });
                                        var d_Table = $('#users-list-datatable').dataTable(); 
                                        d_Table.api().ajax.reload();
                                    },
                                    error: function (data) {
                                       swal({
                                                title: 'Error',
                                                icon: 'error'
                                            }) // console.log('Error:', data);
                                    }
                                });
                                
                            } else {
                                
                            }
                        });
                });
                // variable declaration
                var usersTable;
                var usersDataArray = [];
                // datatable initialization
                $('#users-list-datatable').DataTable({
                    // "responsive": true,
                    rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                    // "pageLength": 50,
                        
                    processing: false,
                    serverSide: true,
                    ajax: "{{url()->current()}}",
                    //------------------------------------------------------
                    
                    //----------------------------------------
                    columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                            {data: 'user.name', name: 'user.name'},

                            {data: 'feedback_message', name: 'feedback_message'},
                            
                            {data: 'type', name: 'type'},

                            {data: 'rate', name: 'rate'},

                            {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
                    //   "order": [[ 0, "dsc" ]]
                });
  

        });
    </script>
@endsection