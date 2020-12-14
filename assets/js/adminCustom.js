

$(function(){
	$(document).ready(function(){
		$('.delcat').click(function(){
			var id = $(this).data('id');
			var text = $(this).data('text');
			$.ajax({
				type : 'POST',
				url : surl+'admin/deleteCategory',
				data : {id : id,text :text},
				success:function(data){
					var ndata = JSON.parse(data);
					// alert(id);
					// console.log(data.);
					if (ndata.return == true) 
					{
						$('.error').text(ndata.message);
						$('.ccat'+id).fadeOut();
					}
					else if(ndata.return == false)
					{
						$('.error').text(ndata.message);
					}
					else
					{
						$('.error').text('Something went wrong.');
					}
				},

				error:function(){
						$('.error').text('Something went wrong.');

				}
			});
		});
		$(function () {
			$('.add_spec').click(function(){
				var sp_count = $('.sp_cn').length;
				var items = "";
				items +="<div class='form-group contspecval rmov"+sp_count+"' style='position: relative;'>";
				items +="<input type='text' class='form-control sp_cn' placeholder='Spec value'>";
				items +="<a href = 'javascript:void(0)' class='remove_spec' data-id ="+sp_count+" style ='position: absolute;right:-10px;font-size: 25px;top: 0px;background-color: red;padding: 0px 5px 0px 6px;color: white;'>-</a>";
//				itmes +="</div>"
				
				if(sp_count <=5){
					$('.htmlitems').append(items)
				}
			})
			
		})
		$('body').on('click','.remove_spec',function(){
			var current = $(this).data('id');
			$('.rmov'+current).remove();
		})
		
	});
	
})