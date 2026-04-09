@extends('template.layout2.base')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/forms/icheck/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/forms/icheck/icheck.css')}}">
<script src="{{url('assets/js/forms/icheck/icheck.min.js')}}"></script>
	<script src="https://cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
	<div class="nk-content-body">
	    <div class="components-preview wide-md mx-auto">
	      <div class="nk-block nk-block-lg">
	        <div class="nk-block-head">
	          <div class="nk-block-head-content">
	            <h4 class="nk-block-title"><?php echo $jdl?></h4>
	          </div>
	        </div>
	        <div class="card card-preview">
	        	<div class="card-inner">
	        		<form id="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	        			@csrf
	        			<div class="col-md-12">
							<div class="row">
								<div class="form-group col-6">
									<label class="form-label" for="type">Content Type</label>
									<div class="form-control-wrap">
										<div class="i-checks" style="margin: 5px;">
											<input type="radio" name="content_type" id="news" value="news" checked>
											<label for="news"> News</label> &nbsp;&nbsp;
											<input type="radio" name="content_type" id="promo" value="promo">
											<label for="promo"> Promo</label>
										</div>
									</div>
								</div>
								<div class="form-group col-6">
									<label class="form-label" for="type">Status</label>
									<div class="form-control-wrap">
										<div class="i-checks" style="margin: 5px;">
											<input type="radio" name="status" id="status-1" value="1" checked>
											<label for="status-1"> Active</label> &nbsp;&nbsp;
											<input type="radio" name="status" id="status-0" value="0">
											<label for="status-0"> Non-active</label>
										</div>
									</div>
								</div>
							</div>
							
	        				<div class="form-group">
	        					<label for="news_title" class="col-xs-2 form-label">Title</label>
	        					<div class="col-xs-8">
	        						<input type="text" class="form-control" name="news_title" id="news_title" placeholder="Title" maxlength="160" onkeyup="hitungLength()">
	        						<!-- <p style="color: red">(Max character = 255)</p> -->
	        						<p align="right"><span id="news_length">0</span>/160</p>
	        					</div>
	        				</div>
	        				<div class="form-group">
	        					<label for="news_descs" class="col-xs-2 form-label">Content</label>
	        					<div class="col-xs-8">
	        						<textarea class="form-control" name="news_descs" id="news_descs" placeholder="Place content newsfeed here" cols="30" rows="15" class="ckeditor"></textarea>
	        					</div>
	        				</div>
	        				<div class="form-group row" hidden>
	        					<div class="col-6">
	        						<label class="form-label">Start Period</label>
	        						<div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text" id="start_date" name="start_date" class="form-control date-picker" data-date-format="dd/mm/yyyy" value="<?php $mydate=date("d/m/Y");echo "$mydate";?>" >
                                    </div>
	        					</div>
	        					<div class="col-6">
	        						<label class="form-label">End Period</label>
	        						<div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text" id="end_date" name="end_date" class="form-control date-picker" data-date-format="dd/mm/yyyy" value="<?php $mydate=date("d/m/Y");echo "$mydate";?>" >
                                    </div>
	        					</div>
	        				</div>
	        				<div class="form-group row">
								<div class="col-6">
									<div class="form-group">
										<label class="form-label" for="type">Attachment Type</label>
										<div class="form-control-wrap">
											<div class="i-checks" style="margin: 5px;">
												<input type="radio" name="attach_type" id="type-P" value="P" checked>
												<label for="type-P"> Picture</label> &nbsp;&nbsp;
												<input type="radio" name="attach_type" id="type-Y" value="Y">
												<label for="type-Y"> Youtube</label>
											</div>
										</div>
									</div>
								</div>
	        					
	        					<div class="col-6">
									<div id="picture">
										<label for="upload" class="form-label">Upload Picture</label>
										<div class="form-control-wrap">
											<p ><img src="{{  url('images/PlProject/no_image.png') }}" id="picturebox" class="img-responsive" width="50%"></p>
											<div class="custom-file">
												
												<input type="file" id="userfile" name="userfile" class="custom-file-input" accept="image/*" >
												<label class="custom-file-label" for="userfile" id="pictname">Choose File</label>
												<p style="color: red">(* Only JPG, JPEG, PNG, GIF allowed)</p>
											</div>
										</div>
									</div>
									<div id="youtube">
										<label for="upload" class="form-label">Youtube Link</label>
										<div class="form-control-wrap">
											<div class="custom-file">
												<input type="text" id="youtubelink" name="youtubelink" class="form-control">
											</div>
										</div>
									</div>
	        					</div>
	        				</div>
	        				<div class="form-group" hidden>
	        					<div class="col-xs-4">
	        						<img src="" id="picturebox" class="img-responsive">
	        						<input type="text" class="form-control" name="picturepath" id="picturepath" value="" readonly><input type="text" class="form-control" name="picturename" id="picturename" readonly>
	        					</div>
				            </div>
	        			</div>
	        			<div style="text-align:right;margin-right: 50px;margin-top: 20px">
	        				<button type="button" id="btnSave" class="btn btn-primary">Save</button>
		                    <button type="button" class="btn btn-secondary" id="btnBack">Back</button>
		                </div>
	        		</form>
		        </div>
	        </div><!-- .card-preview -->
	      </div><!-- nk-block -->
	    </div>
	</div>

	<script type="text/javascript">
		function hitungLength()
		{
			var news = document.getElementById('news_title').value.length;
			document.getElementById('news_length').innerHTML = news;
		}
	
		$(document).ready(function(){
			var editor = CKEDITOR.instances['ckeditor'];
			if (editor) { editor.destroy(true); }
			CKEDITOR.replace('news_descs');
			//menampilkan data
    		loaddata();
			$('.i-checks').iCheck({
				radioClass: 'iradio_square-blue',
				checkboxClass: 'icheckbox_flat-blue'
			});
			//ckeditor
			

			//button back
			$('#btnBack').click(function()
			{
				window.location.href="{{url('news')}}";
		    });
			// console.log($('input[type=radio][name=attach_type]').val())
			
			$('input[type=radio][name=attach_type]').on('ifChanged', function() {
				if (this.value == 'Y') {
					$("#youtube").show()
					$("#picture").hide()
					$("#picture").val('')
				}
				else if (this.value == 'P') {
					$("#youtube").hide()
					$("#youtubelink").val('')
					$("#picture").show()
				}
			});
			$("#youtube").hide()
			$("#picture").show()
			
			$('#end_date').change(function(){
				$(this).valid();
			});
	
		    $("#userfile").on('change', function ()
		    {
	            $.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });
				// console.log(this.files);
				// console.log($("#picture").get(0).files);
	            $.ajax({
	            	url : "{{url('news/savepic')}}",
	            	type:"POST",
	            	data: function () {
	            		var data = new FormData();
			            data.append("userfile", $("#userfile").get(0).files[0]);
			            return data;
			        }(),
			        processData: false,
			        contentType: false,
			        dataType:"json",
			        success:function(data, status){
			            console.log(data.status);
			            if(data.status == "OK"){
							// Swal.fire({
							// 	title: "Information",
							// 	text: data.pesan,
							// 	icon: "success",
							// 	confirmButtonText: "OK"
							// });
							$('#picturebox').attr('src', data.url);
							$('#picturepath').val(data.url)
							$('#picturename').val(data.picname)
			            } else {
							Swal.fire({
								title: "Error",
								text: data.pesan,
								icon: "error",
								confirmButtonText: "OK"
							});
			            }
			        },
			            error: function(jqXHR, textStatus, errorThrown){
			            Swal.fire(textStatus+' Save : '+errorThrown);
			        }
			    });
	        });
			$.validator.addMethod("cek_data", function (value, element) {
				var isSuccess = false;
				// var content = $('#news_descs').val();
				var youtubelink = $('#youtubelink').val();
				var picture = $('#pictname').text();
				console.log('aa:',youtubelink,picture);
				if( youtubelink.length == 0 && picture.length ==0 ){
				
				}else{
					isSuccess=true;

				}
				return isSuccess;

			});

    $.validator.addMethod("cek_date", function (value, element) {
            var isSuccess = false;
            var from = $('#start_date').val().split("/");
            start_date = new Date(from[2], from[1] - 1, from[0]);
            var to = $('#end_date').val().split("/");
            end_date = new Date(to[2], to[1] - 1, to[0]);
            console.log('end: '+end_date);
            console.log('start: '+start_date);

            if(start_date<end_date){
				isSuccess=true;
            }

            return isSuccess;
        });


    $.validator.addMethod("cek_youtube", function (value, element) {
            var isSuccess = true;            
            var url = $('#youtubelink').val();
			var type = $('input[type=radio][name=attach_type]:checked').val();
			console.log('type:',type);
			if(type=='Y'){
				if (url.length != '0') {
					
					var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
					var match = url.match(regExp);
					console.log(match);
					if (match && match[2].length == 11) {
						// Do anything for being valid
						// if need to change the url to embed url then use below line
						// $('#ytplayerSide').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=0');
						isSuccess = true;
						
					}
					else {
						// Do anything for not being valid
						
						isSuccess = false;
					}
					console.log('issuccess:',isSuccess);
				}
			}
            
            
            return isSuccess;

        });
		    $("#frmEditor").validate({
    			ignore:[],
    			rules: {
					news_title: {
						required: true
					},
					// news_descs:{
					// 	cek_data:true
					// },
					youtubelink:{
						cek_data:true,
						cek_youtube:true
					},
					pictname:{
						cek_data:true
					},
					// start_date:{
					// 	cek_date:true
					// },
					// end_date:{
					// 	cek_date:true
					// }//,
					// news:{
					// 	cek_data:true
					// }
				},
		
				messages: {
					news_descs: {
						cek_data: "One of this field can't be blank"
					},
					youtubelink: {
						cek_data: "One of this field can't be blank",
						cek_youtube: "Invalid youtube link"
					},
					picture: {
						cek_data: "One of this field can't be blank"
					},
					end_date:{
						cek_date:"End Period Date should not be smaller than Start Period Date"
					},
			        errorElement: "span",
			        highlight: function (element, errorClass, validClass) {
			        	$(element).addClass(errorClass); //.removeClass(errorClass);
			        	$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			        },
			        unhighlight: function (element, errorClass, validClass) {
			        	$(element).removeClass(errorClass); //.addClass(validClass);
			        	$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			        },
			        errorPlacement: function (error, element) {
			        	if (element.parent('.input-group').length) {
			            	error.insertAfter(element.parent());
			            } else if (element.hasClass('select2')){
			            	error.insertAfter(element.next('span'));
			            } else {
			            	error.insertAfter(element);
			            }
			        }
			    }
		    });

		    //simpan&edit data
		    $('#btnSave').click(function(event)
		    {
		    	event.preventDefault();
		    	if (event.handled !== true) {
		    		event.handled = true;
		    		if ($('#frmEditor').valid())
		    		{
		    			//block(true);
		    			var id = '<?php echo $id?>';
		    			var action ='<?php echo $form?>';
		    			var content = CKEDITOR.instances.news_descs.getData();
		    			var datafrm = $('#frmEditor').serializeArray();
			    			datafrm.push(
			    				{name:"action",value:action},
			    				{name:"id",value:id},
			    				{name:"news_descs",value:content}
			    			);
		    			console.log(datafrm);

		    			$.ajax({
		    				url : "{{ url('/news/save') }}",
		    				type:"POST",
		    				data: datafrm,
		    				dataType:"json",
		    				success:function(event, data)
		    				{
		    					//console.log(event);
		    					if (event.status == 'OK')
		    					{
		    						Swal.fire({
		    							title: "Information",
		    							animation: true,
		    							icon:"success",
		    							text: event.pesan,
		    							confirmButtonText: "OK"
		    						}).then(function(){
		    							window.location.href="{{url('/news')}}";
		  	    					});
		    					} else {
		  							Swal.fire({
		    							title: "Information",
		    							animation: true,
		    							icon:"error",
		    							text: event.pesan,
		    							confirmButtonText: "OK"
		    						});
		    					}
		    				},error: function(jqXHR, textStatus, errorThrown){
		    					Swal.fire({
		    						title: "Error",
		    						animation: true,
		    						icon:"error",
		    						text: textStatus+' Save : '+errorThrown,
		    						confirmButtonText: "OK",
		    					});
		    					//block(false);
		    				}
		    			});
		    		} else {
		    			//block(false);
						// alert('gavalid');
		    		}
		    	}
		    });

		    function loaddata(){
				var rowID = '<?php echo $id ?>';
				console.log('rowID:',rowID);

			    if (rowID > 0)
			    {
			    	$.getJSON("{{url('/news/id')}}" + "/" + rowID, function (data)
			    	{
					
						$('#'+data[0].content_type).iCheck('check');
						$('#type-'+data[0].attach_type).iCheck('check');
						$('#status-'+data[0].status).iCheck('check');
						$('#youtubelink').val(data[0].youtube_link);
			
			    		console.log(data);
			    		$('#news_title').val(data[0].subject);
			    		document.getElementById('news_length').innerHTML = document.getElementById('news_title').value.length;

			    		

			    		
			    		if(data[0].picture!="")
		                {
		                	$('#picturebox').attr("src",data[0].picture);
		                	$('#picturepath').val(data[0].picture);
		                    // document.getElementById("pictname").innerHTML = data[0].picture;
		                }
		                else {
		                    // document.getElementById("pictname").innerHTML = data[0].picture;
		                }

		                // var start_date = data[0].start_date;
			    		// var year  = start_date.substr(0,4);
		                // var month = start_date.substr(5,2);
		                // var day   = start_date.substr(8,2);
		                // var format_date1 = day+"/"+month+"/"+year;
			    		// $('#start_date').val(format_date1);

						// var end_date = data[0].end_date;
			    		// var year  = end_date.substr(0,4);
		                // var month = end_date.substr(5,2);
		                // var day   = end_date.substr(8,2);
		                // var format_date2 = day+"/"+month+"/"+year;
			    		// $('#end_date').val(format_date2);
						// $('#news_descs').val(data[0].content);
			    		CKEDITOR.instances['news_descs'].setData(data[0].content);
			        });
			    }
			}
		});
	</script>
@endsection
