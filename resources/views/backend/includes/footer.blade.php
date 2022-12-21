<footer class="app-footer">
    <div>
        <strong>@lang('labels.general.copyright') &copy; {{ date('Y') }}.            
        </strong> @lang('strings.backend.general.all_rights_reserved')
    </div>

    <div class="ml-auto"></div>
</footer>

<!---*********************code edit by durgesh*********************-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script>
//preview image after the change
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#edit_categ_file_name").change(function() {
  readURL(this);
});

$("#edit_tour_banner_image").change(function() {
  readURL(this);
});

$("#tours_edit").change(function() {
  readURL(this);
});

</script>

<script>
//ckeditor on div id
CKEDITOR.replace( 'edit_description' );
CKEDITOR.replace( 'tour_description' );
CKEDITOR.replace( 'review' );
CKEDITOR.replace( 'page_description' );
CKEDITOR.replace( 'description' );
</script>


<script>
//for get the country id
 function getcountry(countryId, inc){
	 if(countryId)
        {
            $.ajax({
              url :"<?= url('admin/destination/getstate'); ?>/" + countryId,
              type: "GET",
              dataType: "json",
              success:function(data){
                   $('select[name="state"]').empty();
                   $('select[name="state"]').append('<option value=""> -- Select State Name -- </option>');
                   $.each(data, function (key, value) {
                   $('select[name="state"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
               }
           });
        }
	   else {
           alert('Please Select Country');
       }
 }

//for get the state id
 function getstate(stateId, inc){
	 if(stateId)
        {
            $.ajax({
              url :"<?= url('admin/destination/getcity'); ?>/" + stateId,
              type: "GET",
              dataType: "json",
              success:function(data){
				 // alert(data);
                $('select[name="city"]').empty();
                   $('select[name="city"]').append('<option value=""> -- Select City Name -- </option>');
                   $.each(data, function (key, value) {
                   $('select[name="city"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
               }
           });
        }
	   else {
           alert('Please Select State');
       }
 };

$('#cost').keypress(function(event) {
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    event.preventDefault();
  }
 
});

//select travel category type for show and hide div
//$('#categ_file_id').hide();
//$('#categ_content_id').hide();

//for add
 function selectFile(content_value){
	 //alert(obj)
	 //var content_value = obj.val();
	 //alert(content_value);
	 //if(content_value == 'icon'){
		//$('#categ_file_id').hide();
		//$('#categ_content_id').show();

	// }
	// else if(content_value == 'image'){
	//	$('#categ_content_id').hide();
	//	$('#categ_file_id').show();
	// }
	// else{
	//	$('#categ_file_id').hide();
     //   $('#categ_content_id').hide();
	// }
 }

</script>

<script>
//for delete the multiple image one by one after click on cross button
  function deleteimg(id){
	    if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
              url :"<?= url('admin/tour/imgdelete/&ids='); ?>" +id,
              method : 'GET',
              data:{ids:id},
              success:function(data){
                $('#remove_div'+id).remove();
               }
           });
        }
	   else {
         return false;
       }
  }
  
//for delete the multiple image one by one after click on cross button
  function deletetourimg(id){
       if(confirm("Are you sure you want to delete this?"))
       {
	       $.ajax({
	          url :"<?= url('admin/tours/imgdelete/&ids='); ?>" +id,
	          method : 'GET',
	          data:{ids:id},
	          success:function(data){
		      $('#remove_div'+id).remove();
	         }
          });
        }
       else {
            return false;
        }
    }
  
//for limit the multiple image on edit tour report page
function file_limit_check(){
  var fileUpload = $("#multiple_image");
  var count_img = parseInt(fileUpload.get(0).files.length);
	if (count_img > 6){
	  $('.validation').css('display','block');
	}
   else{
	 $('.validation').css('display','none');
	}
}
</script>

<!---*********************code edit by durgesh*********************-->