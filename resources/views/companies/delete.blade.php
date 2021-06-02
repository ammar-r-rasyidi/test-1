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

 <div class="modal fade" id="companies-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-center">Delete This Data Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>Are You Sure Want to Delete This Data Record ?</p>
      </div>
      <div class="modal-footer clearfix">
        <button type="button" class="btn btn-danger rounded float-left" data-dismiss="modal" data-background-color="grey">close</button>
        <form id="needs-validation" class="form-delete float-right" novalidate>
          {!! csrf_field() !!}
          {{ method_field('DELETE') }}
          <button id="delete_submit" type="submit" class="btn btn-block btn-danger rounded">delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

