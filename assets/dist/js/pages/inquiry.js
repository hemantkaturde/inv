// ===== GET PRODUCT DROPDOWN ======
function get_productList_customerwise()
{
    var cust_id = $('#customer').val();
    var path = base_url+'controller_Inquiry/get_product_data_asper_customers/'+cust_id;
    console.log(path);
    $.ajax({
        type : 'POST',
        url : path,
        dataType : 'json',
        success : function(response)
        {
            var data = "";
            data += '<select class="form-control" name="product" id="product" onchange="get_product_price()">';
            data += '<option value="">Select product</option>';
                $.each(response, function(index, value){
                    data += '<option value="'+value['id']+'">'+value['product_type']+' - '+value['name']+'</option>';
                });

            data += '</select>';

            $('#product').html(data);
        },
        error : function(response)
        {
            console.log(response);
        }

    });
}

function get_product_price()
{
    var pro_id = $('#product').val();
    var path = base_url+'controller_Inquiry/get_product_data/'+pro_id;
    console.log(path);
    $.ajax({
        type : 'POST',
        url : path,
        dataType : 'json',
        success : function(response)
        {
            var rate1 = response[0]['price'];
            var qty1 = response[0]['qty'];
            var total = rate1 * qty1;
            $("#rate").val(rate1);
            $("#qty").val(qty1);
            $("#final_amt").val(total);
        },
        error : function(response)
        {
            console.log(response);
        }

    });
}

// ===== ADD ROW FOR INQUIRY =======

function calulate_amount()
{
    var rate = $("#rate").val();
    if(!(rate)) rate = 0;

    var qty = $("#qty").val();
    if(!(qty)) qty = 0;

    total = rate*qty;
    $("#final_amt").val(total);

}

var inq_cnt = 1;
function add_inquiry_row()
{
    check = 1;
    if($("#product").val() == "")
    {
        $("#product").css({'border-color':'red'});
        check = 0;
    }else
    {
        $("#product").css({'border-color':'green'});
    }

    if($("#rate").val() == "")
    {
        $("#rate").css({'border-color':'red'});
        check = 0;
    }else
    {
        $("#rate").css({'border-color':'green'});
    }

    if($("#qty").val() == "")
    {
        $("#qty").css({'border-color':'red'});
        check = 0;
    }else
    {
        $("#qty").css({'border-color':'green'});
    }

    if($("#final_amt").val() == "")
    {
        $("#final_amt").css({'border-color':'red'});
        check = 0;
    }else
    {
        $("#final_amt").css({'border-color':'green'});
    }

    if(check == 0)
    {
        alert("Please add all fields");
    }
    else
    {
        var product_id = $("#product :selected").val();
        var product_name = $('#product :selected').text();
        if(!(product_id)) product_id = 0;

        var rate = $("#rate").val();
        if(!(rate)) rate = 0;

        var qty = $("#qty").val();
        if(!(qty)) qty = 0;

        var final_amt = $("#final_amt").val();
        if(!(final_amt)) final_amt = 0;

        var path = base_url+'controller_Inquiry/get_product_data_in_inquiry/'+product_id;
        $.ajax({
            type : 'POST',
            url : path,
            dataType : 'json',
            success : function(response)
            {
                console.log(response);

                if(response != "")
                {
                    alert("This product is already Exist.");
                }
                else
                {
                    var cn = 0;
                    for(var i=1; i < inq_cnt; i++)
                    {
                        if($("#inq_product_id_"+i).val() == product_id)
                        {
                            cn = cn+1;
                        }
                    }
                    if(cn >= 1)
                    {
                        alert("This product is already exist.");
                    }else
                    {
                        var data = '';
                        data += '<tr id="inq_row_'+inq_cnt+'">';
                        
                        data += '<td>'+product_name;
                        data +=   '<input type="hidden" name="inq_trans_id[]" id="inq_trans_id_'+inq_cnt+'" value="0" readonly/>';
                        data +=   '<input type="hidden" name="inq_product_id[]" id="inq_product_id_'+inq_cnt+'" value="'+product_id+'" class="form-control form-control-sm" readonly/>';
                        data += '</td>';

                        data += '<td>'+qty;
                        data +=   '<input type="hidden" name="inq_qty[]" id="inq_qty_'+inq_cnt+'" value="'+qty+'" class="form-control form-control-sm" readonly/>';
                        data += '</td>';

                        data += '<td>'+rate;
                        data +=   '<input type="hidden" name="inq_rate[]" id="inq_rate_'+inq_cnt+'" value="'+rate+'" class="form-control form-control-sm" readonly/>';
                        data += '</td>';

                        data += '<td>'+final_amt;
                        data +=   '<input type="hidden" name="inq_final_amt[]" id="inq_final_amt_'+inq_cnt+'" value="'+final_amt+'" class="form-control form-control-sm" readonly/>';
                        data += '</td>';

                        data += '<td>';
                        data +=   '<a onclick="remove_inq_row('+inq_cnt+')"><i class="fa fa-trash"></i></a>';
                        data += '</td>';

                        data += '</tr>';

                        inq_cnt++;
                        $('#inquiry_wrapper').prepend(data);
                        $("#product").val("");
                        $("#rate").val("");
                        $("#qty").val("");
                        $("#final_amt").val("");
                    }
                }
            },
            error : function(response)
            {
                console.log(response);
            }

        }); 
        
    }
}

// ===============

function remove_inq_row(cnt)
{
    $("#inq_row_"+cnt).detach();
}