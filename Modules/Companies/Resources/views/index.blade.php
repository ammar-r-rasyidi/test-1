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

@extends('templates::layouts.backend')

@push('regular_css')
  <link href="{{ asset('select2-js/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet">
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

  <script src="{{ asset('select2-js/js/select2.min.js') }}"></script>
  <script src="{{ asset('file-upload/file-upload-with-preview.min.js') }}"></script>
  <script type="text/javascript">
  $(document).ready(function(){

    /*js initialization*/      

      var upload_update = new FileUploadWithPreview('create_logo', {
          showDeleteButtonOnImages: false,
          clearButton: false,
          text: {
              chooseFile: 'Choose Logo',
              browse: 'Choose File',
          },
      });

      var upload_update = new FileUploadWithPreview('update_logo', {
          showDeleteButtonOnImages: false,
          clearButton: false,
          text: {
              chooseFile: 'Choose Logo',
              browse: 'Choose File',
          },
      });


    /*end of js initialization*/

    /*datatable initialization*/

      var table = $('#companies').DataTable({
          responsive: false,
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{url('dashboard/companies')}}",
            type: "POST"
          },
          columnDefs: [          
            {
              class: 'text-center align-top',
              searchable: false,
              orderable: false,
              data: null,
              targets: [-1],
              width: 100
            },
            { 
              targets: 0,
              class: 'text-center align-top',
              searchable: false,
              orderable: false,
              data: 'DT_RowIndex',
              width: 30
            },

            { class: 'align-top', targets: '_all'},
            { targets: 1, data: 'name' },
            { targets: 2, data: 'email' },
            { targets: 3, data: 'logo' },
            { targets: 4, data: 'website' },
            {
              targets: 5,
              render: function(data, type, full, meta){

                var update_button = "";
                var remove_button = "";

                update_button = `<button class='dropdown-item companies-update' data-id='`+full.id+`'>Edit</button>`;
                remove_button = `<button class='dropdown-item companies-delete' data-id='`+full.id+`' data-toggle='modal' data-target='#companies-delete'>Delete</button>`;

                return `<div class='dropdown show dropdown-icon-only d-inline'><a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class="fas fa-cog"></i></a><div class='dropdown-menu dropdown-menu-right'>`+update_button+remove_button+`</div></div>`;
              },
            }
          ],

          order: [[ 1, 'asc' ]]
      });
      table.on( 'order.dt search.dt', function () {
          table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
          } );
      } ).draw();

      $(window).resize(function() {
        table.cell( 0, 0 ).draw();
        table.fixedColumns().update();
      });
    /*end of datatable initialization*/

    /*tabs actions button*/

      $('#mytab #companies-index-tab').on('click', function (e) {
        e.preventDefault();
            setTimeout(
              function(){ 
                table.ajax.url("{{url('dashboard/companies')}}").load();
            }, 200);
      });
    /*end tabs actions button*/

    /*action button in table*/
      $(document).on('click', '.companies-update', function(e){ 
        e.preventDefault();
        e.stopPropagation();

        var form    = $('.form-update');
        var $this   = $(this);
        var companies = $this.data('id');
        var url = "{{url('dashboard/companies/update-companies')}}"+"/"+companies;

        form[0].reset();
        form.removeClass('was-validated');
        $('input').removeClass('not-empty');
        $('input').removeClass('is-invalid');

        $.ajax({
          url: "{{url('dashboard/companies/update-companies')}}"+"/"+companies,
          type: "GET",
          cache: false,
          beforeSend: function() {
            $('.loading').css('display', 'block');
          },
          success: function(data) {

            $('.loading').css('display', 'none');
            form.attr('action', url);

            $.each(data.companies, function(index, value){
              if(index == 'logo'){
                var upload_update = new FileUploadWithPreview('update_logo', {
                    showDeleteButtonOnImages: false,
                    clearButton: false,
                    text: {
                        chooseFile: 'Pilih Foto Slider',
                        browse: 'Pilih File',
                    },
                    presetFiles: [
                      "{{asset('storage')}}"+"/"+value,
                    ],
                });

              }else{
                form.find('#update_'+index).val(value).trigger('change');
              }
            });


            $('#mytab a:last').tab('show');

          },
        });
      });
      $(document).on('click', '.companies-delete', function(e){ 
        e.preventDefault();
        e.stopPropagation();

        var $this = $(this);
        var form_delete    = $('.form-delete');
        var companies = $this.data('id');
        var url = "{{url('dashboard/companies/delete-companies')}}"+"/"+companies;

            form_delete.attr('action', url);
      });
    /*end of action button in table*/

    /*form action*/
      $(document).on('submit','.form-store', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var form = $(this);
        var formData = new FormData(this);
        var type    = 'alert-success';
        var message = 'Data Telah Berhasil Disimpan.';

        $.ajax({
          url: form.attr('action'),
          type: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function() {
            $('#create_submit').text("Menyimpan");
            $('.loading').css('display', 'block');
          },
          error: function(data) {
            $('.loading').css('display', 'none');
            if(data.responseJSON.code == 422) {
              $('#create_submit').text("Simpan");
              $.each(data.responseJSON.errors_message, function(index, value){
                form.find('#create_'+index).addClass('is-invalid');
                form.find('#create_'+index).parent().find('.invalid-feedback').text(value);
              });
            }
          },
          success: function(data) {
            $('.loading').css('display', 'none');

            if(data.code == 200){
              $('#create_submit').text("Simpan");
              $("[data-toggle^='tab']").removeClass('active');
              $("#companies-index-tab").addClass('active');
              $(".tab-pane").removeClass('show active');
              $("#companies-index").addClass('show active');
              form[0].reset();
              form.removeClass('was-validated');
              $('input').removeClass('not-empty');
              table.ajax.url("{{url('dashboard/companies')}}").load();
              $(this).notify_status(type, message);
            }
          },
        });
      });
      $(document).on('submit','.form-update', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var form = $(this);
        var formData = new FormData($(this)[0]);
        var type    = 'alert-success';
        var message = 'Data Telah Berhasil Diperbarui';

        $.ajax({
          url: form.attr('action'),
          data: formData,
          type: "POST",
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function() {
            $('.loading').css('display', 'block');
            $('#update_submit').text("Memperbarui");
          },
          error: function(data) {
            $('.loading').css('display', 'none');
            if(data.responseJSON.code == 422) {
              $('#update_submit').text("Simpan");
              $.each(data.responseJSON.errors_message, function(index, value){
                form.find('#update_'+index).addClass('is-invalid');
                form.find('#update_'+index).parent().find('.invalid-feedback').text(value);
              });
            }
          },
          success: function(data) {
            $('.loading').css('display', 'none');
            if(data.code == 200){
              $('#update_submit').text("Perbarui");
              $("[data-toggle^='tab']").removeClass('active');
              $("#companies-index-tab").addClass('active');
              $(".tab-pane").removeClass('show active');
              $("#companies-index").addClass('show active');
              form[0].reset();
              form.removeClass('was-validated');
              $('input').removeClass('not-empty');
              table.ajax.url("{{url('dashboard/companies')}}").load();
              $(this).notify_status(type, message);
            }
          },
        });
      });
      $(document).on('submit','.form-delete', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var form     = $(this);
        var formData = form.serialize();
        var type     = 'alert-success';
        var message  = 'Data Telah Berhasil Dihapus.';      

        $.ajax({
          url: form.attr('action'),
          type: "POST",
          data: formData,
          cache: false,
          beforeSend: function() {
            $('#delete_submit').text("Menghapus");
          },
          success: function(data) {
            $('#companies-delete').modal('hide');
            $('#delete_submit').text("Hapus");
            table.ajax.url("{{url('dashboard/companies')}}").load();
            $(this).notify_status(type, message);
          },
        });
      });
    /*end of form action*/

  });  
</script>
@endpush

@section('content')
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6">
        <h4 class="mt-3"><b>Companies</b></h4>
      </div>
      <div class="col-lg-6 my-2">
        <div style="display:block; border-bottom: unset;" id="mytab" class="nav nav-tabs text-right">
          <button id="companies-index-tab" class="btn btn-secondary active rounded active mr-2" data-toggle="tab" href="#companies-index" role="tab" aria-controls="companies-index" aria-selected="true" type="button" data-color="white">
              List Data
          </button>
          <button id="companies-create-tab" class="btn btn-secondary rounded" data-toggle="tab" href="#companies-create" role="tab" aria-controls="companies-create" aria-selected="false" type="button" data-color="white">
              Add New
          </button>
          <a style="display: none;" id="companies-update-tab" class="btn btn-secondary btn-icon-only rounded-circle float-right" data-toggle="tab" href="#companies-update" role="tab" aria-controls="companies-update" aria-selected="false"></a>
        </div>        
      </div> 
    </div>   
  </div>
  <div class="card-body tab-content mt-1">
    <div class="tab-pane fade show active" id="companies-index" role="tabpanel" aria-labelledby="companies-create-tab">
      <div class="col-12 mt-5">
         <table style="width: 100%" id="companies" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
          <thead class="text-info">
            <tr>
              <th scope="col">No.</th>
              <th scope='col'>Name</th>
              <th scope='col'>Email</th>
              <th scope='col'>Logo</th>
              <th scope='col'>Website</th>
              <th class="text-center"><div style="width: 110px !important">Actions</div></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="companies-create" role="tabpanel" aria-labelledby="companies-index-tab">
      @include('companies::create')
    </div>

    <div class="tab-pane fade" id="companies-update" role="tabpanel" aria-labelledby="companies-update-tab">
      @include('companies::update')
    </div>

  </div>
  @include('templates::partials.loading')
</div>  

@include('companies::delete')

@endsection
