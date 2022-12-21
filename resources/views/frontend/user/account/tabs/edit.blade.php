{{ html()->modelForm($user_data, 'POST', route('frontend.user.profile.update'))->class('form-horizontal')->id('myform')->attribute('enctype', 'multipart/form-data')->open() }}
    @method('PATCH')

@if(Auth::user()->role_type =='traveler')
    @include('frontend.traveler.account.edit')
@endif
@if(Auth::user()->role_type =='travel_maker')
 @include('frontend.travelmaker.account.edit')
@endif
@if(Auth::user()->role_type =='travel_blogger')
 @include('frontend.travelblogger.account.edit')
@endif
@if(Auth::user()->role_type =='travel_agency')
 @include('frontend.travelpro.account.edit')
@endif.
    @if ($logged_in_user->canChangeEmail())
        <div class="row">
            <div class="col">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
                </div>

                <div class="form-group">
                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    @endif
   
  
{{ html()->closeModelForm() }}

<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crop Image</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="image_demo"></div>
                        <input type="hidden" data-id="" id="preview-container-id" />
                        <input type="hidden" data-id="" id="image_container" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success crop_image" type="button">Crop</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@push('after-styles')
    {!! script('js/frontend/jquery.min.js') !!}
    <link rel="stylesheet" href="{{ url('css/croppie.css')}}" />
    <style type="text/css">
        .modal-dialog {
            max-width: 80%;
            margin: 1.75rem auto;
        }
        .modal-body{overflow: scroll;}
    </style>
@endpush  

@push('after-scripts')

<script type="text/javascript">
    function gcd (a, b) {
        return (b == 0) ? a : gcd (b, a%b);
    }
</script>

<script>
    $(function() {
        var avatar_location = $("#avatar_location");

        if ($('input[name=avatar_type]:checked').val() === 'storage') {
            avatar_location.show();
        } else {
            avatar_location.hide();
        }

        $('input[name=avatar_type]').change(function() {
            if ($(this).val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }
        });
    });
</script>
@endpush




@push('after-scripts')

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#search_data').tokenfield({
                    autocomplete :{
                        source: [<?php echo '"' .implode( '", "', $countries ). '"' ?>],
                        delay: 100
                    }
                });

                $('#search').click(function(){
                    $('#country_name').text($('#search_data').val());
                });

                $('#search_data1').tokenfield({
                    autocomplete :{
                        source: [<?php echo '"' .implode( '", "', $countries ). '"' ?>],
                        delay: 100
                    }
                });

                $('#search').click(function(){
                    $('#country_name1').text($('#search_data1').val());
                });
            });
        </script>


        <script src="{{ url('js/croppie.js')}}"></script>
        <script type="text/javascript">
            var $image_crop = '';
            var cOldImg = $('#cover_image_container').attr('src');
            var pOldImg = $('#profile_image_container').attr('src');
            var logoOldImg = $('#userdetail_agency_logo_container').attr('src');
            $(document).ready(function(){
                $('.to_crop').on('change', function(){
                    inputId = $(this).attr('id');

                    $that = this;
                    var isErr = true;
                    $("#image_demo").html('');
                    var desired_height = $(this).data('height');
                    var desired_width = $(this).data('width');
                    var dimensions = $(this).data('dimension');
                    var container_id = $(this).data('id');
                    var image_container = $(this).data('container');
                    /*var modal_width = $("#uploadimageModal").width();
                    var aspect_ratio = gcd(desired_width, desired_height);
                    var aspect_width = desired_width/aspect_ratio;
                    var aspect_height = desired_height/aspect_ratio;
                    var modal_ratio = modal_width / aspect_width;
                    var new_width = (modal_ratio-5)*aspect_width;
                    var new_height = (desired_height/desired_width)*new_width;*/
                    var _URL = window.URL || window.webkitURL;
                    var file, img;
                    if ((file = this.files[0])) {
                        img = new Image();
                        img.onload = function() {
                           // alert(this.width+"--"+this.height);
                            if (desired_width <= this.width && desired_height <= this.height) {
                               isErr = false;
                               $('#coverErr').html('');
                               $('#profileErr').html('');
                               $('#logoErr').html('');
                               if(dimensions == 'cover'){
                                    $image_crop = $('#image_demo').croppie({
                                        enableExif: true,
                                        viewport: {
                                            width:desired_width,
                                            height:desired_height,
                                            type:'square' //circle
                                        },
                                        boundary:{
                                            width:(desired_width+50),
                                            height:(desired_height + 50)
                                        }
                                    });
                                }
                                else if(dimensions == 'profile'){
                                   $image_crop = $('#image_demo').croppie({
                                        enableExif: true,
                                        viewport: {
                                            width:desired_width,
                                            height:desired_height,
                                            type:'square' //circle
                                        },
                                        boundary:{
                                            width:(desired_width+50),
                                            height:(desired_height + 50)
                                        }
                                    }); 
                                }

                                // else if(dimensions == 'userdetail_agency_logo'){
                                //    $image_crop = $('#image_demo').croppie({
                                //         enableExif: true,
                                //         viewport: {
                                //             width:desired_width,
                                //             height:desired_height,
                                //             type:'square' //circle
                                //         },
                                //         boundary:{
                                //             width:(desired_width+50),
                                //             height:(desired_height + 50)
                                //         }
                                //     }); 
                                // }

                               
                            } else {
                                msg="Image resolution should be minimum "+desired_width+'x'+desired_height;
                                if(inputId == 'cover' && cOldImg){
                                    $('#cover_image_container').attr('src',cOldImg);
                                }
                                else if(inputId == 'profile' && pOldImg){
                                    $('#profile_image_container').attr('src',pOldImg);
                                }
                                 else if(inputId == 'userdetail_agency_logo' && logoOldImg){
                                    $('#userdetail_agency_logo_container').attr('src',logoOldImg);
                                } 
                                if(inputId == 'cover'){
                                     $('#coverErr').html(msg);
                                    $('#cover').val('');
                                }else if(inputId == 'profile'){
                                    $('#profile').val('');
                                     $('#profileErr').html(msg);
                                }
                                else if(inputId == 'userdetail_agency_logo'){
                                    $('#userdetail_agency_logo').val('');
                                     $('#logoErr').html(msg);
                                }
                               // alert(msg);

                               // $('#image_demo').croppie('destroy');
                                //$('#uploadimageModal').modal('hide');

                                return;
                            }
                        };
                        img.src = _URL.createObjectURL(file);
                    }

                    setTimeout(function(){
                        if(typeof $image_crop !== 'string' && isErr === false){
                            var reader = new FileReader();
                            reader.onload = function (event) {
                                $image_crop.croppie('bind', {
                                    url: event.target.result
                                }).then(function(){
                                    console.log('jQuery bind complete');
                                });
                            }

                            reader.readAsDataURL($that.files[0]);
                            $("#preview-container-id").val(container_id);
                            $("#image_container").val(image_container);
                            $('#uploadimageModal').modal('show');
                        }
                    },500);
                });

                $('.crop_image').click(function(event){
                    $image_crop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function(response){
                        $.ajax({
                            url:"{{ route('frontend.crop_image') }}",
                            type: "POST",
                            data:{"image": response, '_token': '{{ csrf_token() }}'},
                            success:function(data)
                            {
                                var response = JSON.parse(data); 
                                if(response.status == 200){
                                    $("#"+$("#preview-container-id").val()).val(response.image);
                                    $('#uploadimageModal').modal('hide');
                                    $('#'+$("#image_container").val()).attr('src', response.image_url);
                                }
                            }
                        });
                    });
                });
            });



            /*function submitFormCourse(input,width,height) 
            {
                var msg='';
                var selectedInput  = input;
                var imgclean = $(input);
                var imgname  = $(input).val();  
                var size  =  input.files[0].size;
                var ext =  imgname.substr( (imgname.lastIndexOf('.') +1) );
                 
                
                if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG')
                {
                    if(size>3000000)
                    {
                        imgclean.replaceWith( imgclean = imgclean.clone( true ) );//Its for reset the value of file type
                        msg='Sorry File size exceeding from 3 MB';
                    }
                    
                }else{
                    imgclean.replaceWith( imgclean = imgclean.clone( true ) );
                    msg='This filetype is currently not supported';
                }

                return msg; 
            }*/
    
</script>
@endpush