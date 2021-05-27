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
	  <form id="needs-validation" class="form-store" action="{{url('dashboard/employees/add-employees')}}">
	    {!! csrf_field() !!}

      <div class="form-group">
        <label>First Name</label>
        <input id="create_first_name" type="text" name="first_name" class="form-control" placeholder="Input First Name">
      </div>

      <div class="form-group">
        <label>Last Name</label>
        <input id="create_last_name" type="text" name="last_name" class="form-control" placeholder="Input Last Name">
      </div>

      <div class="form-group">
        <label>Company</label>
        <select class="form-control select2-companies" name="company_id" style="width: 100%;">
          <option value="" selected="" disabled="">Select Company</option>
        </select>
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input id="create_phone" type="text" name="phone" class="form-control" placeholder="Input Phone">
      </div>


			<div class="form-group">
        <label>Email</label>
        <input id="create_email" type="email" name="email" class="form-control" placeholder="Input Email">
      </div>

	    <div class="form-group text-right">
	      <button id="create_submit" type="submit" class="btn btn-info rounded">Simpan</button>
	    </div>
	  </form>
	</div>
</div>