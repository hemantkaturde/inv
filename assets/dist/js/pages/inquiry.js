// ===== GET PRODUCT DROPDOWN ======
function get_productList_customerwise()
{

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

        
        var data = '';
        data += '<tr id="inq_row_'+inq_cnt+'">';
        
        data += '<td>'+product_name;
        data +=   '<input type="hidden" name="inq_trans_id[]" id="inq_trans_id_'+inq_cnt+'" value="0" readonly/>';
        data +=   '<input type="hidden" name="inq_product_id[]" id="inq_product_id_'+inq_cnt+'" value="'+product_id+'" class="form-control form-control-sm" readonly/>';
        // data +=   '<input type="text" id="product_name_'+inq_cnt+'" value="'+product_name+'" class="form-control form-control-sm" readonly/>';
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

// ===============

function remove_inq_row(cnt)
{
    $("#inq_row_"+cnt).detach();
}