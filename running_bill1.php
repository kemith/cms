<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dynamic Table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style2.css">
    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
	
        $(document).ready(function(){
            // Add new row
            $("#add-row").click(function(){
                 var running_bill = $("#running_bill").val();
                var date = $("#date").val();
                var amount = $("#amount").val();
                var tds = $("#tds").val();
                var retention_money = $("#retention_money").val();
                var mobilization_advance = $("#mobilization_advance").val();
                var material_advance = $("#material_advance").val();
                var ld = $("#ld").val();
                var net_payable = $("#net_payable").val();
                $(".table tbody tr").last().after(
                    '<tr class="fadetext">'+
                        '<td><input type="checkbox" id="select-row"></td>'+
                        '<td>'+running_bill+'</td>'+
                        '<td>'+date+'</td>'+
                        '<td>'+amount+'</td>'+
                        '<td>'+tds+'</td>'+
                        '<td>'+retention_money+'</td>'+
                        '<td>'+mobilization_advance+'</td>'+
                        '<td>'+material_advance+'</td>'+
                        '<td>'+ld+'</td>'+
                        '<td>'+net_payable+'</td>'+
                    '</tr>'
                );
            })

            // Select all checkbox
            $("#select-all").click(function(){
                var isSelected = $(this).is(":checked");
                if(isSelected){
                    $(".table tbody tr").each(function(){
                        $(this).find('input[type="checkbox"]').prop('checked', true);
                    })
                }else{
                    $(".table tbody tr").each(function(){
                        $(this).find('input[type="checkbox"]').prop('checked', false);
                    })
                }
            });
            
            // Remove selected rows
            $("#remove-row").click(function(){
                $(".table tbody tr").each(function(){
                    var isChecked = $(this).find('input[type="checkbox"]').is(":checked");
                    var tableSize = $(".table tbody tr").length;
                    if(tableSize == 1){
                        alert('All rows cannot be deleted.');
                    }else if(isChecked){
                        $(this).remove();
                    }
                });
            });

        })
    </script>
</head>
<body>
<button type="button" class="btn btn-primary" style="width:90px;"><a href="manage_activity.php" style="color:black;text-decoration: none;">Go back</a></button>

    <div class="container">
    <div class="content">

        <div class="form-div">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="running_bill" placeholder="Running Account Bill">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="date" placeholder="Date">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="amount" placeholder="Amount">
                </div>
				 <div class="col-md-3">
                    <input type="text" class="form-control" id="tds" placeholder="2% TDS">
                </div></br></br>
				 <div class="col-md-3">
                    <input type="text" class="form-control" id="retention_money" placeholder="10% Retention Money">
                </div>
				 <div class="col-md-3">
                    <input type="text" class="form-control" id="mobilization_advance" placeholder="Mobilization Advance">
                </div>
				 <div class="col-md-3">
                    <input type="text" class="form-control" id="material_advance" placeholder="Material Advance">
                </div>
				 <div class="col-md-3">
                    <input type="text" class="form-control" id="ld" placeholder="Liquidity Damages">
                </div></br></br>
				 <div class="col-md-3">
                    <input type="text" class="form-control" id="net_payable" placeholder="Net Payable">
                </div>
                <div class="col-md-3" style="text-align: right;">
                    <button class="btn btn-primary" id="add-row">Add Row</button>
                </div>
            </div>
        </div>

        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th rowspan="2">All <input type="checkbox" id="select-all"></th>
						<th rowspan="2">Running Account Bill </th>
						<th rowspan="2">Date</th>
						<th rowspan="2">Amount</th>
						<th colspan="5">Deduction</th>
						<th rowspan="2">Net Payable</th>
						</tr>
						<th>2% TDS</th>
						<th>10% Retention Money</th>
						<th>Mobilization Advance</th>
						<th>Material Advance</th>
						<th>Liquidity Damages</th>
					</tr>
			
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" id="select-row"></td>
                        
                    </tr>
                </tbody>
            </table>
            <button class="remove-row" id="remove-row">Remove Row</button>

        </div>
    </div>

</body>
</html>