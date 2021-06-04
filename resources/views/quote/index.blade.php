<!--
/*!
* Copyright 2019
* Authors : ammar rizal rasyidi
* Authors Email : (ammar.r.rasyidi@gmail.com)
* Licensed under Personal Use License

* The content owner grants the buyer a non-exclusive, perpetual, personal use
* license to view, download, display, and copy the content, subject to the
* following restrictions:

* The content is licensed for personal use only, not commercial use. The
* content may not be used in any way whatsoever in which you charge money,
* collect fees, or receive any form of remuneration. The content may not be
* resold, relicensed, sub-licensed, rented, leased, or used in advertising.

* Title and ownership, and all rights now and in the future, of and for the
* content remain exclusively with the content owner.

* There are no warranties, express or implied. The content is provided 'as
* is.'

* Neither the content owner, payment processing service, nor hosting service
* will be liable for any third party claims or incidental, consequential, or
* other damages arising out of this license or the buyer's use of the content. */
 -->

@extends('templates.layouts.backend')

@push('regular_css')
  <style type="text/css">
    table{
      table-layout: fixed;
      word-wrap:break-word;
    }
    .nav.nav-tabs .btn.active {
      background-color: #16B5FD !important;
    }
  </style>

@endpush

@push('regular_js')

  <script type="text/javascript">
  $.fn.dataTable.ext.errMode = 'none';
  $(document).ready(function(){

    /*datatable initialization*/

      var table = $('#quotes').DataTable({
          responsive: false,
          processing: true,
          serverSide: true,
          lengthMenu: [[50], [50]],
          searching: false,
          ajax: {
            url: "{{url('dashboard/quotes')}}",
            type: "POST",
          },
          columnDefs: [          

            { 
              targets: 0,
              class: 'text-center align-top',
              searchable: false,
              orderable: false,
              data: 'DT_RowIndex',
              width: 30
            },

            { class: 'align-top', targets: '_all'},
            { targets: 1, data: 'quotes' },
          ],

          order: [[ 1, 'asc' ]]
      });
      // table.on( 'order.dt search.dt', function () {
      //     table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
      //         cell.innerHTML = i+1;
      //     } );
      // } ).draw();

      // $(window).resize(function() {
      //   table.cell( 0, 0 ).draw();
      // });

      $(document).on("click", ".refresh-quote", function() {

        table.ajax.url("{{url('dashboard/quotes')}}").load();

      });
      
    /*end of datatable initialization*/
  });  
</script>
@endpush

@section('content')
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6">
        <h4 class="mt-3"><b>Quotes</b></h4>
      </div>
    </div>
  </div>
  <div class="card-body tab-content mt-1">
    <div class="tab-pane fade show active" id="quotes-index" role="tabpanel" aria-labelledby="quotes-create-tab">
      <div class="col-12 mt-5">
          <button class="btn btn-info refresh-quote mb-5">Refresh Quotes</button>
         <table style="width: 100%" id="quotes" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
          <thead class="text-info">
            <tr>
              <th scope="col">No.</th>
              <th scope='col'><div  style="width: 500px">Quotes</div></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  @include('templates.partials.loading')
</div>  

@endsection
