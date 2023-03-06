$(document).ready(function () {

  // variable declaration
  var usersTable;
  var usersDataArray = [];
  // datatable initialization
  $('#users-list-datatable').DataTable({
    "responsive": true,
      // "pageLength": 50,
        
     processing: false,
     serverSide: true,
     ajax: "{{route('admin.user')}}",
     //------------------------------------------------------
       
     //----------------------------------------
     columns: [
            {data: 'id', name: 'id'},

            {data: 'name', name: 'name'},

            {data: 'email', name: 'email'},
            
            {data: 'mobile', name: 'mobile'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
      //   "order": [[ 0, "dsc" ]]
  });

});