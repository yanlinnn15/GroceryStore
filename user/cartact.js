$(document).ready(function(){
	load_minicart_data();
    function load_minicart_data()
    {
        $.ajax({
            url:"display_minicart.php",
            method:"POST",
            dataType:"json",
            success:function(data)
            {
                $('#mini-cart-content').html(data.minicontent);
                $('.count').text(data.count);
            }
        });
    }

	function deletefunc(productID,action){
		$.ajax({
			url:"cart_action.php",
			method:"POST",
			data:{productID:productID, action:action},
			success:function(data)
			{
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Item Deleted',
					showConfirmButton: false,
					timer: 900
				  });
				load_minicart_data();
				load_cart();
			}
		
		});
	}

	$(document).on('click', '.submitcart', function(){
		var productID = $(this).attr("id");
		var productQuantity = parseInt($('#quantity'+productID).val());
		var productAQuantity = parseInt($('#Pquantity'+productID).val());
		var action = "add";
		if(productQuantity > 0)
		{
			$.ajax({
				url:"cart_action.php",
				method:"POST",
				data:{productID:productID, productQuantity:productQuantity, action:action},
				success:function(data)
				{
					if(data!=''){
						var exceed=parseInt(productAQuantity)-parseInt(data);
						if(data>productAQuantity){
							Swal.fire({
								icon: 'info',
								text: 'There are only '+productAQuantity+' remaining for this item!',
								confirmButtonText: 'Ok',
							  });
						}else if(productQuantity>=exceed){
							

							Swal.fire({
								icon: 'info',
								text: 'There are only '+productAQuantity+' remaining for this item!',
								confirmButtonText: 'Ok',
								
							  });
						}

					}else{
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Cart Added',
							showConfirmButton: false,
							timer: 900
						  });
						load_minicart_data();
					}
				},
				error:function(data){
					window.location.href = "https://localhost/onlinegrocery/user/login-register.php";
				}

			});
		}
		else
		{
			Swal.fire("Failed","Item added must be at least 1!","warning");
		}
	});

	$(document).on('click', '.delete', function(){
		var productID = $(this).attr("id");
		Swal.fire({
			icon: 'info',
			text: 'Do you want to delete this item?',
			showDenyButton: true,
			confirmButtonText: 'Yes',
			denyButtonText: 'No',
		  }).then((result) => {
			
			if (result.isConfirmed) {
				deletefunc(productID,"delete");
			}else{
				load_minicart_data();
				load_cart();
			}
		  });
	});

	$(document).on('change', '.update', function(){
		load_cart();
		var productID = $(this).attr("id");
		var productQuantity = parseInt($(this).val());
		var productAQuantity = parseInt($('#productquan'+productID).val());
		var action= "update";

		if(productQuantity>0 && productAQuantity>=productQuantity){
			$.ajax({
				url:"cart_action.php",
				method:"POST",
				data:{productID:productID, action:action, productQuantity:productQuantity},
				success:function(data)
				{
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Cart Update',
						showConfirmButton: false,
						timer: 900
					});
					load_minicart_data();
					load_cart();
				}
			
			});
		}else{
			if(productQuantity>productAQuantity){
				Swal.fire({
					icon: 'info',
					text: 'There are only '+productAQuantity+' remaining for this item!',
					confirmButtonText: 'Ok',
				  }).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url:"cart_action.php",
							method:"POST",
							data:{productID:productID, action:action, productQuantity:productAQuantity},
							success:function(data)
							{
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: 'Cart Update',
									showConfirmButton: false,
									timer: 900
								});
								load_minicart_data();
								load_cart();
							}
						
						});
						
						
					}else{
						load_minicart_data();
						load_cart();
					}
					
				});
			}
			if(productQuantity==0){
				Swal.fire({
					icon: 'info',
					text: 'Do you want to delete this item?',
					showDenyButton: true,
					confirmButtonText: 'Yes',
					denyButtonText: 'No',
				  }).then((result) => {
					
					if (result.isConfirmed) {
						deletefunc(productID,"delete");
					}else{
						load_minicart_data();
						load_cart();
					}
				});
			}else if(productQuantity<0){
				Swal.fire({
					icon: 'info',
					title: 'Item added must be at least 1!',
					confirmButtonText: 'Ok'
				  });

			}
		}
	});
});


function Check(x,p){
	if(p==1){
		Swal.fire({
			icon: 'info',
  			title: 'Oops...',
			text: 'Some product had exceed our stock!',
			confirmButtonText: 'Okay',
			}).then((result) => {
			if (result.isConfirmed) {
				load_cart();
			}
		});
	}else{
		$.ajax({
			type: "POST",
			url: 'checkproduct.php',
			data:{action:'check'},
			success:function(data) {
			  if(data==x){
				window.location='checkout.php';
			  }else{
				Swal.fire({
					icon: 'info',
					title: 'Oops...',
					text: 'Your cart had changed! Click Yes to Reload the Page !',
					showDenyButton: true,
					confirmButtonText: 'Yes',
				  }).then((result) => {
					if (result.isConfirmed) {
						location.reload();
					}
				});
			  }
			}
	   });
	}
}