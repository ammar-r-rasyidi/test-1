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
 
<div class="row justify-content-center">
	<div class="col-md-6">
	  <h5 class="text-left mt-4 mb-4"><b>Add New</b></h5>
	  <form id="needs-validation" class="form-store" action="{{url('dashboard/companies/add-companies')}}">
	    {!! csrf_field() !!}

			<div class="form-group">
        <label>Text</label>
        <input id="create_name" type="text" name="name" class="form-control" placeholder="Input Name">
      </div>

			<div class="form-group">
        <label>Email</label>
        <input id="create_email" type="email" name="email" class="form-control" placeholder="Input Email">
      </div>

			<div class="form-group">
        <label>Website</label>
				<div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">http://</span>
          </div>
          <input id="create_website" type="text" name="website" class="form-control" placeholder="Input Website">
        </div>
      </div>

      <div class="form-group">
        <div class="custom-file-container" data-upload-id="create_logo">
            <label>Upload Logo <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a></label>
            <label class="custom-file-container__custom-file">
                <input type="file" class="custom-file-container__custom-file__custom-file-input" id="customFile" name="logo" accept="image/*" aria-label="Choose File">
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span class="custom-file-container__custom-file__custom-file-control"></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
        </div>
      </div>
      
	    <div class="form-group text-right">
	      <button id="create_submit" type="submit" class="btn btn-info rounded">Simpan</button>
	    </div>
	  </form>
	</div>
</div>