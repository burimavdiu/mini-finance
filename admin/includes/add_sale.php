    
	<?php
		$mesazhi="";
		if(isset($_POST['addUser'])){
            $registrar=$_SESSION['user']['user_id'];
			$mesazhi=addUser($_POST['firstname'],$_POST['lastname'],
			$_POST['departments'],$_POST['password'],$_POST['email'],
			$_POST['username'],$_POST['phone'],$registrar);
		}
	?>
	<!-- card-register forma e regjistrimit--> 
    <div class="card  mx-auto mt-30 ">
		<div class="card-header h4">Fatura</div>
		<div class="card-body mx-5">
			<form action="" method="POST">  
                <div class="box box-primary">  
                     
                    <div class="box-body">  
                        <div class="form-group">  
                            ReceiptName  
                            <input type="text" name="name" class="form-control">  
                        </div>  
                        <div class="form-group">  
							Location  
                            <input type="text" name="location" class="form-control">  
                        </div>  
                    </div>  
                    <input type="submit" class="btnbtn-primary" name="save" value="Save Record">  
                </div><br/>  
                <table class="table table-bordered table-hover">  
					<thead>  
						<th>No</th>  
						<th>Product Name</th>  
						<th>Quantity</th>  
						<th>Price</th>  
						<th>Discount</th>  
						<th>Amount</th>  
						<th><input type="button" value="+" id="add" class="btnbtn-primary"></th>  
					</thead>  
                    <tbody class="detail">  
						<tr>  
							<td class="no">1</td>  
							<td><input type="text" class="form-control productname" name="productname[]"></td>  
							<td><input type="text" class="form-control quantity" name="quantity[]"></td>  
							<td><input type="text" class="form-control price" name="price[]"></td>  
							<td><input type="text" class="form-control discount" name="discount[]"></td>  
							<td><input type="text" class="form-control amount" name="amount[]"></td>  
							<td><a href="#" class="remove">Delete</td>  
						</tr>  
					</tbody>  
					<tfoot>  
						<th></th>  
						<th></th>  
						<th></th>  
						<th></th>  
						<th></th>  
						<th style="text-align:center;" class="total">0<b></b></th>  
					</tfoot>  
  
				</table>  
			</form>  
      </div>
    </div>
	<script type="text/javascript">  
		$(function(){  
			$('#add').click(function(){  
				addnewrow();  
			});
			$('body').delegate('.remove','click',function(){  
				$(this).parent().parent().remove();  
			});  
			$('body').delegate('.quantity,.price,.discount','keyup',function(){  
				vartr=$(this).parent().parent();  
				varqty=tr.find('.quantity').val();  
				var price=tr.find('.price').val();  
			  
				var dis=tr.find('.discount').val();  
				varamt =(qty * price)-(qty * price *dis)/100;  
				tr.find('.amount').val(amt);  
				total();  
			});  
		});  
		function total(){  
			var t=0;  
			$('.amount').each(function(i,e)   
			{  
			varamt =$(this).val()-0;  
			t+=amt;  
			});  
			$('.total').html(t);  
		}  	
		function addnewrow()   
		{  
			var n=($('.detail tr').length-0)+1;  
			vartr = '<tr>'+  
			'<td class="no">'+n+'</td>'+  
			'<td><input type="text" class="form-control productname" name="productname[]"></td>'+  
			'<td><input type="text" class="form-control quantity" name="quantity[]"></td>'+  
			'<td><input type="text" class="form-control price" name="price[]"></td>'+  
			'<td><input type="text" class="form-control discount" name="discount[]"></td>'+  
			'<td><input type="text" class="form-control amount" name="amount[]"></td>'+  
			'<td><a href="#" class="remove">Delete</td>'+  
			'</tr>';  
			$('.detail').append(vartr);   
		}	
</script>  
	