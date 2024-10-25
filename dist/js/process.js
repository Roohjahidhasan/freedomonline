$(document).ready(function(){   
    bsCustomFileInput.init();   
    var base_url = $("#base_url").val();   
    $(document).on("change",".data",function(){
        if($(this).attr("has_dependency") == -1 || $(this).attr("has_dependency") == 1){
            var DEPENDENT_PARAM = $(this).attr('is_dependent');
            var THIS_PARAM = $(this).attr("name");
            var THIS_VALUE = $(this).val();
            $.ajax(
            {
                method:"POST",
                url:base_url+"ajax/get_lazy_dropdown.php",
                dataType:"text",
                data: {DEPENDENT_PARAM: DEPENDENT_PARAM, THIS_PARAM: THIS_PARAM, THIS_VALUE: THIS_VALUE,DEPENDENT_VALUE:''},
                success:function (data) {
                    $("."+DEPENDENT_PARAM).html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) { 
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        }else if($(this).attr("has_dependency") == -2){
            var DEPENDENT_PARAM = $(this).attr('is_dependent');
            var THIS_PARAM = $(this).attr("name");
            var THIS_VALUE = $(this).val();
            $.ajax(
            {
                method:"POST",
                url:base_url+"ajax/get_data.php",
                dataType:"text",
                data: {DEPENDENT_PARAM: DEPENDENT_PARAM, THIS_PARAM: THIS_PARAM, THIS_VALUE: THIS_VALUE},
                success:function (data) {
                    $("."+DEPENDENT_PARAM).val(data);
                },
                error: function (jqXHR, textStatus, errorThrown) { 
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        }
    });
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    var window_width = $(window).width();
    function closeNav(){
      $("body").removeClass("sidebar-open");
      $("body").addClass("sidebar-closed");
      $("body").addClass("sidebar-collapse");
      $("a.closebtn").hide();
    }
    $("a.closebtn").on("click",function(){
      closeNav();
    });
    $(".nav-link .fa-bars").on("click",function(){
        if(window_width < 780){
          $("a.closebtn").show('slow');
        }
    });
    function loadPage(page_url){
        //$("#loading").show();
        $(".page-url").each(function(){
          var href = $(this).attr("href");
          if(href == page_url)
            $(this).addClass("active");
          else
            $(this).removeClass("active");
        });
        if(window_width < 780)
          closeNav();
        $("#placeholder").html("");  
        $.get(base_url+"admin/ajax/"+page_url,function(data){
           //$("#loading").hide();
           $("#placeholder").html(data);           
        });
    }

    $(document).on("click","#pageClose",function(){
        loadPage(page_url);
    });
    
    $(document).on("click","#btnSave",function(){
        var model = {};
        model['tbl'] = $(this).attr("tbl");
        var param = [];
        $(".err_mgs").text("");
        var is_required = 0;
        $(".data").each(function(){
            if($(this).attr("type") == "text")
                var value = $(this).val().trim();
            else
                var value = $(this).val();
            if($(this).attr("type") == "number"){
                if(isNaN(value)){
                    $("#err_"+$(this).attr("name")).text("Please Provide a Valid Number!");
                    is_required = 1
                }
            }else if($(this).attr("type") == "checkbox"){
                if($(this).prop("checked") == false)
                    value = "";
            }else if($(this).attr("type") == "email"){
                if(!validateEmail(value)){
                    $("#err_"+$(this).attr("name")).text("Please Provide a Valid Email!");
                    is_required = 1
                }
            }
            if($(this).attr("type") != "file"){
                model[$(this).attr('name')] = value;
            }
            if($(this).attr('is_required') == 1){
                if(value == ""){
                    $("#err_"+$(this).attr("name")).text("This Field is Required!");
                    is_required = 1
                }
            }
        });
        if(is_required == 1){
            return false;
        }
        is_required == 0
        $(".data").each(function(){
            if($(this).attr("type") == "file"){
                var check_file = $('.'+$(this).attr("name"))[0].files[0];
                if(check_file != undefined){
                    var size = $('.'+$(this).attr("name"))[0].files[0].size;
                    sizeKB = Number(size)/1024;
                    if(sizeKB <= 500){
                        model[$(this).attr('name')] = size+$('.'+$(this).attr("name"))[0].files[0].name;
                        var formData = new FormData();
                        formData.append('file', $('.'+$(this).attr("name"))[0].files[0]);
                        $.ajax({
                            url : base_url+"ajax/upload.php",
                            type : 'POST',
                            data : formData,
                            processData: false,
                            contentType: false, 
                            success : function(data) {
                            }
                        });
                    }else{
                        if($(this).attr('is_required') == 1){
                            $("#err_"+$(this).attr("name")).text("This Field is Required!");
                            is_required = 1;
                        }
                    }
                }
            }
        });
        if(is_required == 1){
            return false;
        }
        $("#btnSave").attr("disabled","disabled");
        if($("#btnSave").val() == "Save"){
            $.ajax(
                {
                    method:"POST",
                    url:base_url+"ajax/save.php",
                    dataType:"json",
                    data: model,
                    success:function (data) {
                        clear();
                        const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Save Successfully'
                        });
                        //window.location.reload();
                        loadPage(page_url);
                    }
                }
            );
        }else{
            model['PK_NAME'] = modelEdit.PK_NAME;
            model['PK_VALUE'] = modelEdit.PK_VALUE;
            $.ajax(
                {
                    method:"POST",
                    url:base_url+"ajax/update.php",
                    dataType:"json",
                    data: model,
                    success:function (data) {
                        clear();
                        const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Update Successfully'
                        });                        
                        loadPage(page_url);
                        //window.location.reload();
                    }
                }
            );
        }
    });
    function clear(){
        $(".data").each(function(){
            $(this).val("");
        });
    }
    var modelEdit = {};
    $(document).on("click",".edit",function(){
        $("#btnSave").val("Update");
        modelEdit = {};
        modelEdit['PK_NAME'] = $(this).attr("PK_NAME");
        modelEdit['TBL'] = $(this).attr("TBL");
        modelEdit['PK_VALUE'] = $(this).attr("PK_VALUE");
        $.ajax(
            {
                async: false,
                method:"POST",
                url:base_url+"ajax/get_edit_data.php",
                dataType:"json",
                data: modelEdit,
                success:function (data) {
                    $(".data").each(function(){
                        var FIELD_NAME = $(this).attr("name");
                        if($(this).attr("type") != "file")
                            $("."+FIELD_NAME).val(data[FIELD_NAME]).trigger('change');
                        if($(this).attr("has_dependency") == -1 || $(this).attr("has_dependency") == 1){
                            var DEPENDENT_PARAM = $(this).attr('is_dependent').trim();
                            var THIS_PARAM = $(this).attr("name");
                            var THIS_VALUE = $(this).val();
                            var DEPENDENT_VALUE = data[DEPENDENT_PARAM];
                            if(DEPENDENT_PARAM != ""){
                                $.ajax(
                                {
                                    method:"POST",
                                    url:base_url+"ajax/get_lazy_dropdown.php",
                                    dataType:"text",
                                    data: {DEPENDENT_PARAM: DEPENDENT_PARAM, THIS_PARAM: THIS_PARAM, THIS_VALUE: THIS_VALUE,DEPENDENT_VALUE:DEPENDENT_VALUE},
                                    success:function (data) {
                                        $("."+DEPENDENT_PARAM).html(data);
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) { 
                                        console.log(jqXHR, textStatus, errorThrown);
                                    }
                                });
                            }
                        }
                    });
                }
            }
        );
    });
    $(document).on("click",".remove",function(){
        var PK_NAME = $(this).attr("PK_NAME");
        var TBL = $(this).attr("TBL");
        var PK_VALUE = $(this).attr("PK_VALUE");
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax(
            {
                async: false,
                method:"POST",
                url:base_url+"ajax/delete.php",
                dataType:"text",
                data: {PK_NAME: PK_NAME, TBL: TBL, PK_VALUE: PK_VALUE},
                success:function (data) {
                    loadPage(page_url);
                },
                error: function (jqXHR, textStatus, errorThrown) { 
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        }
    });

    
    var page_url = "#";
    loadPage("index.php");
    $(document).on("click",".page-url",function(){
        var href = $(this).attr("href");
        page_url = href;
        loadPage(page_url);
        return false;
    });
    function sendSMS(){
        $.post(base_url+"ajax/send_sms.php",{},function(result){
            if(result == 0)
              window.location.replace(base_url+"logout.php");
        });
    }
    setInterval(sendSMS, 60000);
    $("select").select2();

    //common transaction
    $(document).on("change",".TRANSACTION_TYPE_NO",function(){
        $(".hide_cash").hide();
        var TRANSACTION_TYPE_NO = $(".TRANSACTION_TYPE_NO").val();
        if(TRANSACTION_TYPE_NO == 2)
            $(".cheque").show();
        if(TRANSACTION_TYPE_NO == 3)
            $(".bank_only").show();
    });
    var base_url = $("#BASE_URL").val().trim();
    //Sale Purchase

    var SALE_PURCHASE_ITEM_NO = [];
    var SALE_PURCHASE_ITEM_NAME = [];
    var PURCHASE_RATE = [];
    var PURCHASE_QUANTITY = [];
    var PURCHASE_SUBTOTAL = [];
    var PURCHASE_IS_PURCHASE = [];
    var PURCHASE_AMOUNT = 0;
    function SalePurchaseDetailList(){
        var html = "";
        for (var i = 0; i < SALE_PURCHASE_ITEM_NO.length; i++){
            var action = "<input type='button' class='btn btn-danger sale_purchase_detail_remove' data='"+i+"' value='Remove'/>";
            var html = html+"<tr class='return"+PURCHASE_IS_PURCHASE[i]+"'><td>"+action+"</td><td>"+SALE_PURCHASE_ITEM_NAME[i]+"</td><td>"+PURCHASE_RATE[i]+"</td><td>"+PURCHASE_QUANTITY[i]+"</td><td>"+PURCHASE_SUBTOTAL[i]+"</td></tr>";
        }
        $("#sale_purchase_detail_list").html(html);
        $(".PURCHASE_AMOUNT").val(PURCHASE_AMOUNT);
        $(".PAYABLE_AMOUNT").val(Number($(".PREVIOUS_DUE").val())+Number($(".PURCHASE_AMOUNT").val()));
    }
    function SalePurchaseDetail(IS_PURCHASE){
        var SALE_ITEM_NO = $(".SALE_ITEM_NO").val();
        var QUANTITY = $(".QUANTITY").val();
        if(isNaN(SALE_ITEM_NO) || SALE_ITEM_NO == ""){
            alert("Please Select a Item!");
            return false;
        }
        if(isNaN(QUANTITY) || QUANTITY <= 0){
            alert("Invalid Item Quantity!");
            $(".QUANTITY").focus();
            return false;
        }
        var SALE_ITEM_NAME = $(".SALE_ITEM_NO :selected").text();
        var RATE = $(".RATE").val();
        var SUBTOTAL = $(".SUBTOTAL").val();
        if(SALE_PURCHASE_ITEM_NO.includes(SALE_ITEM_NO) == false || IS_PURCHASE == -1){
            SALE_PURCHASE_ITEM_NO.push(SALE_ITEM_NO);
            SALE_PURCHASE_ITEM_NAME.push(SALE_ITEM_NAME);
            PURCHASE_RATE.push(RATE);
            PURCHASE_QUANTITY.push(QUANTITY);
            PURCHASE_SUBTOTAL.push(SUBTOTAL);
            PURCHASE_IS_PURCHASE.push(IS_PURCHASE);
            PURCHASE_AMOUNT+=Number(SUBTOTAL)*Number(IS_PURCHASE);
            SalePurchaseDetailList();
        }else{
            alert("Duplicate Item Added!");
        }
    }
    $(document).on("click","#btnSalePurchaseDetail",function(){  
        $(this).attr("disabled","disabled");
        if($("#sale_purchase_detail_list").text().trim() == ""){
            SALE_PURCHASE_ITEM_NO = [];
            SALE_PURCHASE_ITEM_NAME = [];
            PURCHASE_RATE = [];
            PURCHASE_QUANTITY = [];
            PURCHASE_SUBTOTAL = [];
            PURCHASE_IS_PURCHASE = [];
            PURCHASE_AMOUNT = 0;
        }
        var IS_PURCHASE = $(".IS_PURCHASE").val();
        SalePurchaseDetail(IS_PURCHASE);
    });

    $(document).on("click",".sale_purchase_detail_remove",function(){  
        $(this).attr("disabled","disabled");
        var SALE_PURCHASE_ITEM_NO_NEW = [];
        var SALE_PURCHASE_ITEM_NAME_NEW = [];
        var PURCHASE_RATE_NEW = [];
        var PURCHASE_QUANTITY_NEW = [];
        var PURCHASE_SUBTOTAL_NEW = [];
        var SALE_IS_PURCHASE_NEW = [];
        var data = $(this).attr("data");  
        PURCHASE_AMOUNT = 0;      
        for (var i = 0; i < SALE_PURCHASE_ITEM_NO.length; i++){
            if(i != data){
                SALE_PURCHASE_ITEM_NO_NEW.push(SALE_PURCHASE_ITEM_NO[i]);
                SALE_PURCHASE_ITEM_NAME_NEW.push(SALE_PURCHASE_ITEM_NAME[i]);
                PURCHASE_RATE_NEW.push(PURCHASE_RATE[i]);
                PURCHASE_QUANTITY_NEW.push(PURCHASE_QUANTITY[i]);
                PURCHASE_SUBTOTAL_NEW.push(PURCHASE_SUBTOTAL[i]);
                SALE_IS_PURCHASE_NEW.push(PURCHASE_IS_PURCHASE[i]);
                PURCHASE_AMOUNT += Number(PURCHASE_SUBTOTAL[i])*Number(PURCHASE_IS_PURCHASE[i]);
            }
        }        
        SALE_PURCHASE_ITEM_NO = SALE_PURCHASE_ITEM_NO_NEW;
        SALE_PURCHASE_ITEM_NAME = SALE_PURCHASE_ITEM_NAME_NEW;
        PURCHASE_RATE = PURCHASE_RATE_NEW
        PURCHASE_QUANTITY = PURCHASE_QUANTITY_NEW;
        PURCHASE_SUBTOTAL = PURCHASE_SUBTOTAL_NEW;
        PURCHASE_IS_PURCHASE = SALE_IS_PURCHASE_NEW;
        SalePurchaseDetailList();
    });
    $(document).on("click","#btnSalePurchase",function(){
        $(this).attr("disabled","disabled");
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        var SUPPLIER_BILL_NUMBER = $(".SUPPLIER_BILL_NUMBER").val();
        var SALE_SUPPLIER_NO = $(".SALE_SUPPLIER_NO").val();
        var PREVIOUS_DUE = $(".PREVIOUS_DUE").val();
        var sale_purchase_detail_list = $("#sale_purchase_detail_list").text().trim();
        var PURCHASE_AMOUNT = $(".PURCHASE_AMOUNT").val();
        var PAYABLE_AMOUNT = $(".PAYABLE_AMOUNT").val();
        var TRANSACTION_TYPE_NO = "-100";
        var AMOUNT = 0;
        var NUMBER = "";
        var DATE = "";
        var TRANSACTION_ON = $(".TRANSACTION_ON").val();
        if(sale_purchase_detail_list == ""){
            alert("Please Add Purchase Item!");
            return false;
        }
        $(this).prop("disabled",true);
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_PURCHASE',PAYABLE_AMOUNT: PAYABLE_AMOUNT,SUPPLIER_BILL_NUMBER:SUPPLIER_BILL_NUMBER,TRANSACTION_DATE : TRANSACTION_DATE,SALE_SUPPLIER_NO : SALE_SUPPLIER_NO, PREVIOUS_DUE : PREVIOUS_DUE,PURCHASE_AMOUNT : PURCHASE_AMOUNT,TRANSACTION_TYPE_NO : TRANSACTION_TYPE_NO,AMOUNT : AMOUNT,NUMBER : NUMBER,DATE : DATE,TRANSACTION_ON : TRANSACTION_ON,SALE_PURCHASE_ITEM_NO : SALE_PURCHASE_ITEM_NO.toString(),PURCHASE_RATE : PURCHASE_RATE.toString(),PURCHASE_QUANTITY : PURCHASE_QUANTITY.toString(),PURCHASE_SUBTOTAL : PURCHASE_SUBTOTAL.toString(),PURCHASE_IS_PURCHASE : PURCHASE_IS_PURCHASE.toString()},function(data){
            $("#placeholder").html("");  
            $.get(base_url+"admin/ajax/sale_purchase.php",function(data){
               $("#placeholder").html(data);           
            });
        });
    });    
    //sale sale
    var ORDER_SL_ARRAY = [];
    var ORDER_ITEM_ARRAY = [];
    var DETAIL_NOTE_ARRAY = [];
    var RATE_ARRAY = [];
    var QUANTITY_ARRAY = [];
    var SUBTOTAL_ARRAY = [];
    var SALE_AMOUNT = 0;
    function SaleSaleDetailList(){
        var html = "";
        for (var i = 0; i < ORDER_SL_ARRAY.length; i++){
            var action = "<input type='button' class='btn btn-danger sale_sale_detail_remove' data='"+i+"' value='Remove'/>";
            var html = html+"<tr class='return"+ORDER_SL_ARRAY[i]+"'><td>"+action+"</td><td>"+ORDER_ITEM_ARRAY[i]+"</td><td>"+DETAIL_NOTE_ARRAY[i]+"</td><td>"+RATE_ARRAY[i]+"</td><td>"+QUANTITY_ARRAY[i]+"</td><td>"+SUBTOTAL_ARRAY[i]+"</td></tr>";
        }
        $("#sale_sale_detail_list").html(html);
        $(".SALE_AMOUNT").val(SALE_AMOUNT);
        $(".PAYABLE_AMOUNT").val(Number($(".PREVIOUS_DUE").val())+Number($(".SALE_AMOUNT").val()));
    }
    var inc = 0;
    function SaleSaleDetail(){
        var ORDER_ITEM = $(".ORDER_ITEM").val().trim();
        if(ORDER_ITEM == ""){
            alert("Order Item Required!");
            $(".ORDER_ITEM").focus();
            return false;
        }
        var DETAIL_NOTE = $(".DETAIL_NOTE").val().trim();
        var RATE = $(".RATE").val();
        if(RATE <= 0){
            alert("Invalid Rate!");
            $(".RATE").focus();
            return false;
        }
        var QUANTITY = $(".QUANTITY").val();
        if(QUANTITY <= 0){
            alert("Invalid Quantity!");
            $(".QUANTITY").focus();
            return false;
        }
        var SUBTOTAL = $(".SUBTOTAL").val();
        inc++;
        ORDER_SL_ARRAY.push(inc);
        ORDER_ITEM_ARRAY.push(ORDER_ITEM);
        DETAIL_NOTE_ARRAY.push(DETAIL_NOTE);
        RATE_ARRAY.push(RATE);
        QUANTITY_ARRAY.push(QUANTITY);
        SUBTOTAL_ARRAY.push(SUBTOTAL);
        SALE_AMOUNT+=Number(SUBTOTAL);
        SaleSaleDetailList();
        $(".ORDER_ITEM").val("");
        $(".DETAIL_NOTE").val("");
        $(".RATE").val("");
        $(".QUANTITY").val("");
        $(".SUBTOTAL").val("");
    }
    $(document).on("click","#btnSaleSaleDetail",function(){  
        if($("#sale_sale_detail_list").text().trim() == ""){
            SALE_SALE_ITEM_NAME = [];
            SALE_RATE = [];
            SALE_QUANTITY = [];
            SALE_SUBTOTAL = [];
            SALE_AMOUNT = 0;
        }
        SaleSaleDetail();
    });

    $(document).on("click",".sale_sale_detail_remove",function(){  
        var ORDER_SL_ARRAY_NEW = [];
        var ORDER_ITEM_ARRAY_NEW = [];
        var DETAIL_NOTE_ARRAY_NEW = [];
        var RATE_ARRAY_NEW = [];
        var QUANTITY_ARRAY_NEW = [];
        var SUBTOTAL_ARRAY_NEW = [];
        var data = $(this).attr("data");  
        SALE_AMOUNT = 0;       
        for (var i = 0; i < ORDER_SL_ARRAY.length; i++){
            if(i != data){
                ORDER_SL_ARRAY_NEW.push(ORDER_SL_ARRAY[i]);
                ORDER_ITEM_ARRAY_NEW.push(ORDER_ITEM_ARRAY[i]);
                DETAIL_NOTE_ARRAY_NEW.push(DETAIL_NOTE_ARRAY[i]);
                RATE_ARRAY_NEW.push(RATE_ARRAY[i]);
                QUANTITY_ARRAY_NEW.push(QUANTITY_ARRAY[i]);
                SUBTOTAL_ARRAY_NEW.push(SUBTOTAL_ARRAY[i]);
                SALE_AMOUNT += Number(SALE_SUBTOTAL[i]);
            }
        }        
        ORDER_SL_ARRAY = ORDER_SL_ARRAY_NEW;
        ORDER_ITEM_ARRAY = ORDER_ITEM_ARRAY_NEW;
        DETAIL_NOTE_ARRAY = DETAIL_NOTE_ARRAY_NEW
        RATE_ARRAY = RATE_ARRAY_NEW;
        QUANTITY_ARRAY = QUANTITY_ARRAY_NEW;
        SUBTOTAL_ARRAY = SUBTOTAL_ARRAY_NEW;
        SaleSaleDetailList();
    });
    $(document).on("click","#btnSaleSale",function(){
        $(this).attr("disabled","disabled");
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        var SALE_CUSTOMER_NO = $(".SALE_CUSTOMER_NO").val();
        var CUSTOMER = $(".CUSTOMER").val();
        var CUSTOMER_CONTACT = $(".CUSTOMER_CONTACT").val();
        var PREVIOUS_DUE = $(".PREVIOUS_DUE").val();
        var WORK_ORDER_NUMBER = $(".WORK_ORDER_NUMBER").val().trim();
        var WORK_ORDER_DATE = $(".WORK_ORDER_DATE").val();
        var FILE_NUMBER = $(".FILE_NUMBER").val().trim();
        var NOTE = $(".NOTE").val().trim();
        var sale_sale_detail_list = $("#sale_sale_detail_list").text().trim();
        var SALE_AMOUNT = $(".SALE_AMOUNT").val();
        var RECEIVABLE_AMOUNT = $(".RECEIVABLE_AMOUNT").val();
        var TRANSACTION_TYPE_NO = "-200";
        var AMOUNT = 0;
        var NUMBER = "";
        var DATE = "";
        var TRANSACTION_ON = $(".TRANSACTION_ON").val();
        if(sale_sale_detail_list == ""){
            alert("Please Add Order Item!");
            return false;
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_SALE',TRANSACTION_DATE : TRANSACTION_DATE,SALE_CUSTOMER_NO : SALE_CUSTOMER_NO,CUSTOMER : CUSTOMER,CUSTOMER_CONTACT : CUSTOMER_CONTACT,WORK_ORDER_NUMBER: WORK_ORDER_NUMBER,WORK_ORDER_DATE: WORK_ORDER_DATE,FILE_NUMBER: FILE_NUMBER,NOTE: NOTE,PREVIOUS_DUE : PREVIOUS_DUE,SALE_AMOUNT : SALE_AMOUNT,RECEIVABLE_AMOUNT : RECEIVABLE_AMOUNT,TRANSACTION_TYPE_NO : TRANSACTION_TYPE_NO,AMOUNT : AMOUNT,NUMBER : NUMBER,DATE : DATE,TRANSACTION_ON : TRANSACTION_ON,ORDER_ITEM_ARRAY : ORDER_ITEM_ARRAY.toString(),DETAIL_NOTE_ARRAY : DETAIL_NOTE_ARRAY.toString(),RATE_ARRAY : RATE_ARRAY.toString(),QUANTITY_ARRAY : QUANTITY_ARRAY.toString(),SUBTOTAL_ARRAY : SUBTOTAL_ARRAY.toString()},function(data){
            ORDER_SL_ARRAY = [];
            ORDER_ITEM_ARRAY = [];
            DETAIL_NOTE_ARRAY = [];
            RATE_ARRAY = [];
            QUANTITY_ARRAY = [];
            SUBTOTAL_ARRAY = [];
            SALE_AMOUNT = 0;
            $("#placeholder").html("");  
            $.get(base_url+"admin/ajax/sale_sale_masters.php?sub=invoice&mn=Invoice",function(data){
               $("#placeholder").html(data);           
            });
        });
    });  
    $(document).on("click","#btnSaleBillPrepare",function(){
        $(this).attr("disabled","disabled");
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        var SALE_CUSTOMER_NO = $(".SALE_CUSTOMER_NO").val();
        var billdetails = $("#billdetails").text().trim();
        if(billdetails == ""){
            alert("No Due Chalan!");
            return false;
        }
        var SALE_CHALAN_MASTER_NO_ARRAY = [];
        var AMOUNT_WITH_VAT_ARRAY = [];
        $(".bill_prepare").each(function(){
            SALE_CHALAN_MASTER_NO_ARRAY.push($(this).attr("SALE_CHALAN_MASTER_NO"));
            AMOUNT_WITH_VAT_ARRAY.push($(this).attr("AMOUNT_WITH_VAT"));
        });
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_BILL_PREPARE',TRANSACTION_DATE: TRANSACTION_DATE,SALE_CUSTOMER_NO: SALE_CUSTOMER_NO,SALE_CHALAN_MASTER_NO_ARRAY: SALE_CHALAN_MASTER_NO_ARRAY.toString(),AMOUNT_WITH_VAT_ARRAY: AMOUNT_WITH_VAT_ARRAY.toString()},function(data){
            $("#placeholder").html("");  
            $.get(base_url+"admin/ajax/sale_sale_bill.php?sub=bill_prepare&mn=Bill",function(data){
               $("#placeholder").html(data);           
            });
        });
    });
    $(document).on("click","#btnSaleChalanPrepare",function(){
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        var SALE_CUSTOMER_NO = $(".SALE_CUSTOMER_NO").val();
        var VAT_CHALLAN_NUMBER = $(".VAT_CHALLAN_NUMBER").val().trim();
        var VAT_PERCENTAGE = $(".VAT_PERCENTAGE").val();
        var chalandetails = $("#chalandetails").text().trim();
        if(chalandetails == ""){
            alert("No Chalan Item!");
            return false;
        }
        if(VAT_PERCENTAGE.trim() == ""){
            alert("VAT Percentage Required!");
            return false;
        }
        var ORDER_ITEM_ARRAY = [];
        var DETAIL_NOTE_ARRAY = [];
        var RATE_ARRAY = [];
        var QUANTITY_ARRAY = [];
        var DELIVERED_QUANTITY_ARRAY = [];
        var CANCEL_QUANTITY_ARRAY = [];
        var WORK_ORDER_NUMBER_ARRAY = [];
        var WORK_ORDER_DATE_ARRAY = [];
        var SALE_SALE_DETAIL_NO_ARRAY = [];
        var CHALLAN_QUANTITY_ARRAY = [];
        var NO_OF_PAKTS_ARRAY = [];
        var CTN_PER_PAKTS_ARRAY = [];
        $(".cahlan_prepare").each(function(){
            var CHALLAN_QUANTITY = $(this).val();
            var ORDER_ITEM = $(this).attr("ORDER_ITEM");
            var DETAIL_NOTE = $(this).attr("DETAIL_NOTE");
            var RATE = $(this).attr("RATE");
            var QUANTITY = $(this).attr("QUANTITY");
            var DELIVERED_QUANTITY = $(this).attr("DELIVERED_QUANTITY");
            var CANCEL_QUANTITY = $(this).attr("CANCEL_QUANTITY");
            var WORK_ORDER_NUMBER = $(this).attr("WORK_ORDER_NUMBER");
            var WORK_ORDER_DATE = $(this).attr("WORK_ORDER_DATE");
            var SALE_SALE_DETAIL_NO = $(this).attr("SALE_SALE_DETAIL_NO");
            CHALLAN_QUANTITY_ARRAY.push(CHALLAN_QUANTITY);
            ORDER_ITEM_ARRAY.push(ORDER_ITEM);
            DETAIL_NOTE_ARRAY.push(DETAIL_NOTE);
            RATE_ARRAY.push(RATE);
            QUANTITY_ARRAY.push(QUANTITY);
            DELIVERED_QUANTITY_ARRAY.push(DELIVERED_QUANTITY);
            CANCEL_QUANTITY_ARRAY.push(CANCEL_QUANTITY);
            WORK_ORDER_NUMBER_ARRAY.push(WORK_ORDER_NUMBER);
            WORK_ORDER_DATE_ARRAY.push(WORK_ORDER_DATE);
            SALE_SALE_DETAIL_NO_ARRAY.push(SALE_SALE_DETAIL_NO);
        });
        $(".NO_OF_PAKTS").each(function(){
            var NO_OF_PAKTS = $(this).val();
            NO_OF_PAKTS_ARRAY.push(NO_OF_PAKTS);
        });
        $(".CTN_PER_PAKTS").each(function(){
            var CTN_PER_PAKTS = $(this).val();
            CTN_PER_PAKTS_ARRAY.push(CTN_PER_PAKTS);
        });
        $(this).attr("disabled","disabled");
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_CHALAN_PREPARE',TRANSACTION_DATE: TRANSACTION_DATE, SALE_CUSTOMER_NO: SALE_CUSTOMER_NO,VAT_CHALLAN_NUMBER:VAT_CHALLAN_NUMBER, VAT_PERCENTAGE: VAT_PERCENTAGE, CHALLAN_QUANTITY_ARRAY: CHALLAN_QUANTITY_ARRAY.toString(), ORDER_ITEM_ARRAY: ORDER_ITEM_ARRAY.toString(), DETAIL_NOTE_ARRAY: DETAIL_NOTE_ARRAY.toString(), RATE_ARRAY: RATE_ARRAY.toString(), QUANTITY_ARRAY: QUANTITY_ARRAY.toString(), DELIVERED_QUANTITY_ARRAY: DELIVERED_QUANTITY_ARRAY.toString(), CANCEL_QUANTITY_ARRAY: CANCEL_QUANTITY_ARRAY.toString(), WORK_ORDER_NUMBER_ARRAY: WORK_ORDER_NUMBER_ARRAY.toString(), WORK_ORDER_DATE_ARRAY: WORK_ORDER_DATE_ARRAY.toString(), SALE_SALE_DETAIL_NO_ARRAY: SALE_SALE_DETAIL_NO_ARRAY.toString(),NO_OF_PAKTS_ARRAY:NO_OF_PAKTS_ARRAY.toString(),CTN_PER_PAKTS_ARRAY:CTN_PER_PAKTS_ARRAY.toString()},function(data){
            $("#placeholder").html("");  
            $.get(base_url+"admin/ajax/sale_sale_calan.php?sub=challan&mn=Challan",function(data){
               $("#placeholder").html(data);           
            });
        });
    });
    function transaction(){  
        $(".err_mgs").each(function(){
            $(this).text("");
        });      
        var ACC_ACCOUNT_HEAD_NO = $(".ACC_ACCOUNT_HEAD_NO").val();
        if(ACC_ACCOUNT_HEAD_NO == ""){
            $("#err_ACC_ACCOUNT_HEAD_NO").text("This Field is Required!");
            return false;
        }
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        if(TRANSACTION_DATE == ""){
            $("#err_TRANSACTION_DATE").text("This Field is Required!");
            return false;
        }
        var TRANSACTION_NOTE = $(".TRANSACTION_NOTE").val().trim();
        if(TRANSACTION_NOTE == ""){
            $("#err_TRANSACTION_NOTE").text("This Field is Required!");
            return false;
        }
        var TRANSACTION_TYPE_NO = $(".TRANSACTION_TYPE_NO").val();
        if(TRANSACTION_TYPE_NO == ""){
            $("#err_TRANSACTION_TYPE_NO").text("This Field is Required!");
            return false;
        }
        var ACC_BANK_NO = $(".ACC_BANK_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        if(!(TRANSACTION_TYPE_NO == 1)){
            if(ACC_BANK_NO == ""){
                $("#err_ACC_BANK_NO").text("This Field is Required!");
                return false;
            }
            if(ACC_BANK_ACCOUNT_NO == ""){
                $("#err_ACC_BANK_ACCOUNT_NO").text("This Field is Required!");
                return false;
            }
        }
        var TRANSACTION_AMOUNT = $(".TRANSACTION_AMOUNT").val();
        if(TRANSACTION_AMOUNT == ""){
            $("#err_TRANSACTION_AMOUNT").text("This Field is Required!");
            return false;
        }
        var OPENING_BALANCE = $(".OPENING_BALANCE").val();
        var ACC_HEAD_TYPE_NO = $(".ACC_HEAD_TYPE_NO").val();
        var CHEQUE_NUMBER = $(".CHEQUE_NUMBER").val();
        var CHEQUE_DATE = $(".CHEQUE_DATE").val();
        if(TRANSACTION_TYPE_NO == 2){
            if(CHEQUE_NUMBER == ""){
                $("#err_CHEQUE_NUMBER").text("This Field is Required!");
                return false;
            }
            if(CHEQUE_DATE == ""){
                $("#err_CHEQUE_DATE").text("This Field is Required!");
                return false;
            }
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_TRANSACTION',ACC_ACCOUNT_HEAD_NO : ACC_ACCOUNT_HEAD_NO,TRANSACTION_DATE : TRANSACTION_DATE,TRANSACTION_NOTE : TRANSACTION_NOTE,TRANSACTION_TYPE_NO : TRANSACTION_TYPE_NO,ACC_BANK_NO : ACC_BANK_NO,ACC_BANK_ACCOUNT_NO : ACC_BANK_ACCOUNT_NO,TRANSACTION_AMOUNT : TRANSACTION_AMOUNT,OPENING_BALANCE : OPENING_BALANCE,ACC_HEAD_TYPE_NO : ACC_HEAD_TYPE_NO,CHEQUE_NUMBER : CHEQUE_NUMBER,CHEQUE_DATE : CHEQUE_DATE},function(data){
            $("#placeholder").html("");  
            var url = "admin/ajax/acc_receive.php";
            if(ACC_HEAD_TYPE_NO == 1){
                url = "admin/ajax/acc_payment.php";
            }
            $.get(base_url+url,function(data){
               $("#placeholder").html(data);           
            });
        });
    }
    $(document).on("click","#checkReceivedOther",function(){ 
        $(this).attr("disabled","disabled");
        var url = "admin/ajax/cheque_receive_from_other_approval.php";
        $.get(base_url+url,function(data){
           $("#placeholder").html(data);           
        });
    });  
    $(document).on("click","#checkReceivedCustomer",function(){ 
        $(this).attr("disabled","disabled");
        var url = "admin/ajax/cheque_receive_approval.php";
        $.get(base_url+url,function(data){
           $("#placeholder").html(data);           
        });
    });  
    $(document).on("click","#checkPaymentOther",function(){ 
        $(this).attr("disabled","disabled");
        var url = "admin/ajax/cheque_payment_to_other_approval.php";
        $.get(base_url+url,function(data){
           $("#placeholder").html(data);           
        });
    }); 
    $(document).on("click","#checkPaymentSupplier",function(){ 
        $(this).attr("disabled","disabled");
        var url = "admin/ajax/cheque_payment_approval.php";
        $.get(base_url+url,function(data){
           $("#placeholder").html(data);           
        });
    }); 

    $(document).on("click",".cancel-item",function(){
        $(this).attr("disabled","disabled");
        var SALE_SALE_DETAIL_NO = $(this).attr('val');
        var CANCEL_QUANTITY = $("#cancel_qnt"+SALE_SALE_DETAIL_NO).val();
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE: 'CHALAN_CANCEL',CANCEL_QUANTITY:CANCEL_QUANTITY,SALE_SALE_DETAIL_NO:SALE_SALE_DETAIL_NO},function(data){
           var SALE_CUSTOMER_NO = $(".SALE_CUSTOMER_NO").val();
           $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE: 'CHALAN_PREPARE',SALE_CUSTOMER_NO:SALE_CUSTOMER_NO},function(data){
              $("#chalandetails").html(data);
           });
        });
    }); 

    $(document).on("click","#btnPayment,#btnReceive",function(){
        transaction();
    });
    $(document).on("click","#btnLoanReceive",function(){
        $(".err_mgs").each(function(){
            $(this).text("");
        });      
        var SALE_LOAN_PARTY_NO = $(".SALE_LOAN_PARTY_NO").val();
        if(SALE_LOAN_PARTY_NO == ""){
            $("#err_SALE_LOAN_PARTY_NO").text("This Field is Required!");
            return false;
        }
        var PARTY_OPENING_BALANCE = $(".PARTY_OPENING_BALANCE").val();
        var TRANSACTION_ON = $(".TRANSACTION_ON").val();
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        if(TRANSACTION_DATE == ""){
            $("#err_TRANSACTION_DATE").text("This Field is Required!");
            return false;
        }
        var TRANSACTION_NOTE = $(".TRANSACTION_NOTE").val().trim();
        if(TRANSACTION_NOTE == ""){
            $("#err_TRANSACTION_NOTE").text("This Field is Required!");
            return false;
        }
        var TRANSACTION_TYPE_NO = $(".TRANSACTION_TYPE_NO").val();
        if(TRANSACTION_TYPE_NO == ""){
            $("#err_TRANSACTION_TYPE_NO").text("This Field is Required!");
            return false;
        }
        var ACC_BANK_NO = $(".ACC_BANK_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        if(!(TRANSACTION_TYPE_NO == 1)){
            if(ACC_BANK_NO == ""){
                $("#err_ACC_BANK_NO").text("This Field is Required!");
                return false;
            }
            if(ACC_BANK_ACCOUNT_NO == ""){
                $("#err_ACC_BANK_ACCOUNT_NO").text("This Field is Required!");
                return false;
            }
        }
        var TRANSACTION_AMOUNT = $(".TRANSACTION_AMOUNT").val();
        if(TRANSACTION_AMOUNT == ""){
            $("#err_TRANSACTION_AMOUNT").text("This Field is Required!");
            return false;
        }
        var OPENING_BALANCE = $(".OPENING_BALANCE").val();
        var ACC_HEAD_TYPE_NO = $(".ACC_HEAD_TYPE_NO").val();
        var CHEQUE_NUMBER = $(".CHEQUE_NUMBER").val();
        var CHEQUE_DATE = $(".CHEQUE_DATE").val();
        if(TRANSACTION_TYPE_NO == 2){
            if(CHEQUE_NUMBER == ""){
                $("#err_CHEQUE_NUMBER").text("This Field is Required!");
                return false;
            }
            if(CHEQUE_DATE == ""){
                $("#err_CHEQUE_DATE").text("This Field is Required!");
                return false;
            }
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_LOAN_RECEIVE',SALE_LOAN_PARTY_NO : SALE_LOAN_PARTY_NO,PARTY_OPENING_BALANCE : PARTY_OPENING_BALANCE,TRANSACTION_ON : TRANSACTION_ON,TRANSACTION_DATE : TRANSACTION_DATE,TRANSACTION_NOTE : TRANSACTION_NOTE,TRANSACTION_TYPE_NO : TRANSACTION_TYPE_NO,ACC_BANK_NO : ACC_BANK_NO,ACC_BANK_ACCOUNT_NO : ACC_BANK_ACCOUNT_NO,TRANSACTION_AMOUNT : TRANSACTION_AMOUNT,OPENING_BALANCE : OPENING_BALANCE,ACC_HEAD_TYPE_NO : ACC_HEAD_TYPE_NO,CHEQUE_NUMBER : CHEQUE_NUMBER,CHEQUE_DATE : CHEQUE_DATE},function(data){
            $("#placeholder").html("");  
            var url = "admin/ajax/loan_receive_other.php";
            $.get(base_url+url,function(data){
               $("#placeholder").html(data);           
            });
        });
    });
    
    $(document).on("click","#btnLoanPayment",function(){
        $(".err_mgs").each(function(){
            $(this).text("");
        });      
        var SALE_LOAN_PARTY_NO = $(".SALE_LOAN_PARTY_NO").val();
        if(SALE_LOAN_PARTY_NO == ""){
            $("#err_SALE_LOAN_PARTY_NO").text("This Field is Required!");
            return false;
        }
        var PARTY_OPENING_BALANCE = $(".PARTY_OPENING_BALANCE").val();
        var TRANSACTION_ON = $(".TRANSACTION_ON").val();
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        if(TRANSACTION_DATE == ""){
            $("#err_TRANSACTION_DATE").text("This Field is Required!");
            return false;
        }
        var TRANSACTION_NOTE = $(".TRANSACTION_NOTE").val().trim();
        if(TRANSACTION_NOTE == ""){
            $("#err_TRANSACTION_NOTE").text("This Field is Required!");
            return false;
        }
        var TRANSACTION_TYPE_NO = $(".TRANSACTION_TYPE_NO").val();
        if(TRANSACTION_TYPE_NO == ""){
            $("#err_TRANSACTION_TYPE_NO").text("This Field is Required!");
            return false;
        }
        var ACC_BANK_NO = $(".ACC_BANK_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        if(!(TRANSACTION_TYPE_NO == 1)){
            if(ACC_BANK_NO == ""){
                $("#err_ACC_BANK_NO").text("This Field is Required!");
                return false;
            }
            if(ACC_BANK_ACCOUNT_NO == ""){
                $("#err_ACC_BANK_ACCOUNT_NO").text("This Field is Required!");
                return false;
            }
        }
        var TRANSACTION_AMOUNT = $(".TRANSACTION_AMOUNT").val();
        if(TRANSACTION_AMOUNT == ""){
            $("#err_TRANSACTION_AMOUNT").text("This Field is Required!");
            return false;
        }
        var OPENING_BALANCE = $(".OPENING_BALANCE").val();
        var ACC_HEAD_TYPE_NO = $(".ACC_HEAD_TYPE_NO").val();
        var CHEQUE_NUMBER = $(".CHEQUE_NUMBER").val();
        var CHEQUE_DATE = $(".CHEQUE_DATE").val();
        if(TRANSACTION_TYPE_NO == 2){
            if(CHEQUE_NUMBER == ""){
                $("#err_CHEQUE_NUMBER").text("This Field is Required!");
                return false;
            }
            if(CHEQUE_DATE == ""){
                $("#err_CHEQUE_DATE").text("This Field is Required!");
                return false;
            }
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_LOAN_PAYMENT',SALE_LOAN_PARTY_NO : SALE_LOAN_PARTY_NO,PARTY_OPENING_BALANCE : PARTY_OPENING_BALANCE,TRANSACTION_ON : TRANSACTION_ON,TRANSACTION_DATE : TRANSACTION_DATE,TRANSACTION_NOTE : TRANSACTION_NOTE,TRANSACTION_TYPE_NO : TRANSACTION_TYPE_NO,ACC_BANK_NO : ACC_BANK_NO,ACC_BANK_ACCOUNT_NO : ACC_BANK_ACCOUNT_NO,TRANSACTION_AMOUNT : TRANSACTION_AMOUNT,OPENING_BALANCE : OPENING_BALANCE,ACC_HEAD_TYPE_NO : ACC_HEAD_TYPE_NO,CHEQUE_NUMBER : CHEQUE_NUMBER,CHEQUE_DATE : CHEQUE_DATE},function(data){
            $("#placeholder").html("");  
            var url = "admin/ajax/loan_payment_to_other.php";
            $.get(base_url+url,function(data){
               $("#placeholder").html(data);           
            });
        });
    });
    
    $(document).on("click","#btnChequeReceiveFromCustomerApproval",function(){
        $(this).attr("disabled","disabled");
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var AMOUNT = $(".AMOUNT").val();
        var SALE_SALE_TRANSACTION_NO = $(".SALE_SALE_TRANSACTION_NO").val();
        var DATE = $(".DATE").val();
        if(ACC_BANK_ACCOUNT_NO == "" || AMOUNT == "" || AMOUNT <= 0){
            alert("Invalid Cheque Details!");
            return false;
        }
        if(DATE == ""){
            alert("Invalid Cheque Date!");
            return false;
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'CHEQUE_RECEIVE_FROM_CUSTOMER_APPROVAL',ACC_BANK_ACCOUNT_NO:ACC_BANK_ACCOUNT_NO,AMOUNT:AMOUNT,SALE_SALE_TRANSACTION_NO:SALE_SALE_TRANSACTION_NO,DATE:DATE},function(data){
            loadPage(page_url);
        });
    });  
    $(document).on("click","#btnChequeReceiveFromOtherApproval",function(){
        $(this).attr("disabled","disabled");
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var TRANSACTION_AMOUNT = $(".TRANSACTION_AMOUNT").val().trim();
        var ACC_ACCOUNT_HEAD_TRANSACTION_NO = $(".ACC_ACCOUNT_HEAD_TRANSACTION_NO").val();
        var CHEQUE_DATE = $(".CHEQUE_DATE").val();
        if(ACC_BANK_ACCOUNT_NO == "" || TRANSACTION_AMOUNT == "" || TRANSACTION_AMOUNT <= 0){
            alert("Invalid Cheque Details!");
            return false;
        }
        if(CHEQUE_DATE == ""){
            alert("Invalid Cheque Date!");
            return false;
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'CHEQUE_RECEIVE_FROM_OTHER_APPROVAL',ACC_BANK_ACCOUNT_NO:ACC_BANK_ACCOUNT_NO,TRANSACTION_AMOUNT:TRANSACTION_AMOUNT,ACC_ACCOUNT_HEAD_TRANSACTION_NO:ACC_ACCOUNT_HEAD_TRANSACTION_NO,CHEQUE_DATE,CHEQUE_DATE:CHEQUE_DATE},function(data){
            loadPage(page_url);
        });
    });  
    $(document).on("click","#btnChequePaymentToSupplierApproval",function(){
        $(this).attr("disabled","disabled");
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var ACC_ACCOUNT_HEAD_NO = $(".ACC_ACCOUNT_HEAD_NO").val();
        var AMOUNT = $(".AMOUNT").val();
        var SALE_PURCHASE_TRANSACTION_NO = $(".SALE_PURCHASE_TRANSACTION_NO").val();
        var DATE = $(".DATE").val();
        if(ACC_BANK_ACCOUNT_NO == "" || AMOUNT == "" || AMOUNT <= 0){
            alert("Invalid Cheque Details!");
            return false;
        }
        if(DATE == ""){
            alert("Invalid Cheque Date!");
            return false;
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'CHEQUE_PAYMENT_TO_SUPPLIER_APPROVAL',ACC_BANK_ACCOUNT_NO:ACC_BANK_ACCOUNT_NO,AMOUNT:AMOUNT,SALE_PURCHASE_TRANSACTION_NO:SALE_PURCHASE_TRANSACTION_NO,DATE:DATE,ACC_ACCOUNT_HEAD_NO:ACC_ACCOUNT_HEAD_NO},function(data){
            loadPage(page_url);
        });
    });  
    $(document).on("click","#btnChequePaymentToOtherApproval",function(){
        $(this).attr("disabled","disabled");
        var ACC_ACCOUNT_HEAD_NO = $(".ACC_ACCOUNT_HEAD_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var TRANSACTION_AMOUNT = $(".TRANSACTION_AMOUNT").val().trim();
        var ACC_ACCOUNT_HEAD_TRANSACTION_NO = $(".ACC_ACCOUNT_HEAD_TRANSACTION_NO").val();
        var CHEQUE_DATE = $(".CHEQUE_DATE").val();
        if(ACC_BANK_ACCOUNT_NO == "" || TRANSACTION_AMOUNT == "" || TRANSACTION_AMOUNT <= 0){
            alert("Invalid Cheque Details!");
            return false;
        }
        if(CHEQUE_DATE == ""){
            alert("Invalid Cheque Date!");
            return false;
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'CHEQUE_PAYMENT_TO_OTHER_APPROVAL',ACC_ACCOUNT_HEAD_NO:ACC_ACCOUNT_HEAD_NO,ACC_BANK_ACCOUNT_NO:ACC_BANK_ACCOUNT_NO,TRANSACTION_AMOUNT:TRANSACTION_AMOUNT,ACC_ACCOUNT_HEAD_TRANSACTION_NO:ACC_ACCOUNT_HEAD_TRANSACTION_NO,CHEQUE_DATE:CHEQUE_DATE},function(data){
            loadPage(page_url);
        });
    });  
    $(document).on("click","#btnSaleCustomerReceivable",function(){
        $(this).attr("disabled","disabled");
        $("#err_SALE_CUSTOMER_NO").text("");
        $("#err_NUMBER").text("");
        $("#err_DATE").text("");
        $("#err_ACC_BANK_NO").text("");
        $("#err_ACC_BANK_ACCOUNT_NO").text("");
        var SALE_CUSTOMER_NO = $(".SALE_CUSTOMER_NO").val();
        var TRANSACTION_TYPE_NO = $(".TRANSACTION_TYPE_NO").val();
        var AMOUNT = $(".AMOUNT").val();
        var NUMBER = $(".NUMBER").val();
        var DATE = $(".DATE").val();
        var ACC_BANK_NO = $(".ACC_BANK_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var TRANSACTION_ON = $(".TRANSACTION_ON").val();
        var RECEIVABLE_AMOUNT = $(".RECEIVABLE_AMOUNT").val();
        var TRANSACTION_NOTE = $(".TRANSACTION_NOTE").val();
        if(SALE_CUSTOMER_NO == ""){
            $("#err_SALE_CUSTOMER_NO").text("This field is Required!");
            return false;
        }
        if(TRANSACTION_TYPE_NO == 2){
            if(NUMBER == ""){
                $("#err_NUMBER").text("This field is Required!");
                return false;
            }
            if(DATE == ""){
                $("#err_DATE").text("This field is Required!");
                return false;
            }
        }
        if(TRANSACTION_TYPE_NO == 3){
            if(ACC_BANK_NO == ""){
                $("#err_ACC_BANK_NO").text("This field is Required!");
                return false;
            }
            if(ACC_BANK_ACCOUNT_NO == ""){
                $("#err_ACC_BANK_ACCOUNT_NO").text("This field is Required!");
                return false;
            }
        }
        $(this).prop("disabled",true);
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_CUSTOMER_RECEIVABLE',SALE_CUSTOMER_NO : SALE_CUSTOMER_NO,TRANSACTION_TYPE_NO : TRANSACTION_TYPE_NO,AMOUNT : AMOUNT,NUMBER : NUMBER,DATE : DATE,ACC_BANK_NO : ACC_BANK_NO,ACC_BANK_ACCOUNT_NO : ACC_BANK_ACCOUNT_NO,TRANSACTION_ON : TRANSACTION_ON,RECEIVABLE_AMOUNT : RECEIVABLE_AMOUNT,TRANSACTION_NOTE:TRANSACTION_NOTE},function(data){
            alert("Receive Successfully!")
            loadPage(page_url);
        });
    });  
    $(document).on("click","#btnSalaryProcess",function(){
        var YEAR = $(".YEAR").val();
        if(YEAR == ""){
            $("#err_YEAR").text("This field is Required!");
            return false;
        }
        var MONTH_NO = $(".MONTH_NO").val();
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALARY_PROCESS',YEAR : YEAR,MONTH_NO : MONTH_NO},function(data){
            if(data == 1){
                alert("Process Successfully!")
                loadPage(page_url);
            }else{
                alert("Already Process Salary for this month!")
                return false;
            }
        });
    });  
    $(document).on("click","#btnSaleSupplierPayable",function(){
        $(this).attr("disabled","disabled");
        $("#err_SALE_SUPPLIER_NO").text("");
        $("#err_NUMBER").text("");
        $("#err_DATE").text("");
        $("#err_ACC_BANK_NO").text("");
        $("#err_ACC_BANK_ACCOUNT_NO").text("");
        $("#err_TRANSACTION_TYPE_NO").text("");
        var ACC_ACCOUNT_HEAD_NO = $(".ACC_ACCOUNT_HEAD_NO").val();
        var SALE_SUPPLIER_NO = $(".SALE_SUPPLIER_NO").val();
        var TRANSACTION_TYPE_NO = $(".TRANSACTION_TYPE_NO").val();
        var ACC_BANK_NO = $(".ACC_BANK_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var AMOUNT = $(".AMOUNT").val();
        var NUMBER = $(".NUMBER").val();
        var DATE = $(".DATE").val();
        var TRANSACTION_ON = $(".TRANSACTION_ON").val();
        var PAYABLE_AMOUNT = $(".PAYABLE_AMOUNT").val();
        var TRANSACTION_NOTE = $(".TRANSACTION_NOTE").val();
        if(err_SALE_SUPPLIER_NO == ""){
            $("#err_SALE_SUPPLIER_NO").text("This field is Required!");
            return false;
        }
        if(TRANSACTION_TYPE_NO == ""){
            $("#err_TRANSACTION_TYPE_NO").text("This field is Required!");
            return false;
        }
        if(TRANSACTION_TYPE_NO == 2){
            if(NUMBER == ""){
                $("#err_NUMBER").text("This field is Required!");
                return false;
            }
            if(DATE == ""){
                $("#err_DATE").text("This field is Required!");
                return false;
            }
            if(ACC_BANK_NO == ""){
                $("#err_ACC_BANK_NO").text("This field is Required!");
                return false;
            }
            if(ACC_BANK_ACCOUNT_NO == ""){
                $("#err_ACC_BANK_ACCOUNT_NO").text("This field is Required!");
                return false;
            }
        }
        if(TRANSACTION_TYPE_NO == 3){
            if(ACC_BANK_NO == ""){
                $("#err_ACC_BANK_NO").text("This field is Required!");
                return false;
            }
            if(ACC_BANK_ACCOUNT_NO == ""){
                $("#err_ACC_BANK_ACCOUNT_NO").text("This field is Required!");
                return false;
            }
        }
        $(this).prop("disabled",true);
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'SALE_SUPPLIER_PAYABLE',ACC_ACCOUNT_HEAD_NO:ACC_ACCOUNT_HEAD_NO,SALE_SUPPLIER_NO : SALE_SUPPLIER_NO,TRANSACTION_TYPE_NO : TRANSACTION_TYPE_NO,AMOUNT : AMOUNT,NUMBER : NUMBER,DATE : DATE,ACC_BANK_NO : ACC_BANK_NO,ACC_BANK_ACCOUNT_NO : ACC_BANK_ACCOUNT_NO,TRANSACTION_ON : TRANSACTION_ON,PAYABLE_AMOUNT : PAYABLE_AMOUNT,TRANSACTION_NOTE:TRANSACTION_NOTE},function(data){
            alert("Paid to Supplier Successfully!")
            loadPage(page_url);
        });
    }); 

    $(document).on("click","#btnSalaryPayment",function(){
        $(this).attr("disabled","disabled");
        var PAYROLL_SALARY_MASTER_NO_ARRAY = [];
        var EMPLOYEE_NO_ARRAY = [];
        var PAID_AMOUNT_ARRAY = [];
        var YEAR_ARRY = [];
        var MONTH_NO_ARRY = [];
        $(".select_payroll").each(function(){
            if($(this).prop("checked") == true)
            var PAYROLL_SALARY_MASTER_NO = $(this).attr("val");
            var EMPLOYEE_NO = $(this).attr("EMPLOYEE_NO");
            var YEAR = $(this).attr("YEAR");
            var MONTH_NO = $(this).attr("MONTH_NO");
            PAYROLL_SALARY_MASTER_NO_ARRAY.push(PAYROLL_SALARY_MASTER_NO);
            EMPLOYEE_NO_ARRAY.push(EMPLOYEE_NO);
            PAID_AMOUNT_ARRAY.push($('#sal'+PAYROLL_SALARY_MASTER_NO).val());
            YEAR_ARRY.push(YEAR);
            MONTH_NO_ARRY.push(MONTH_NO);
        });
        var PAID_AMOUNT = Number($("#total_sale").text());
        var TRANSACTION_TYPE_NO = $(".TRANSACTION_TYPE_NO").val();
        if(TRANSACTION_TYPE_NO == ""){
            $("#err_TRANSACTION_TYPE_NO").text("This field is Required!");
            return false;
        }
        var ACC_BANK_NO = $(".ACC_BANK_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var CURRENT_BALANCE = Number($("#CURRENT_BALANCE").text());
        if(TRANSACTION_TYPE_NO == 3){
            if(ACC_BANK_NO == ""){
                $("#err_ACC_BANK_NO").text("This field is Required!");
                return false;
            }
            if(ACC_BANK_ACCOUNT_NO == ""){
                $("#err_ACC_BANK_ACCOUNT_NO").text("This field is Required!");
                return false;
            }
        }
        if(PAID_AMOUNT > CURRENT_BALANCE){
            alert("Insufficient Fund!");
            return false;
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'PAYROL_SALARY_PAYMENT',YEAR_ARRY : YEAR_ARRY.toString(),MONTH_NO_ARRY : MONTH_NO_ARRY.toString(),PAYROLL_SALARY_MASTER_NO_ARRAY : PAYROLL_SALARY_MASTER_NO_ARRAY.toString(),EMPLOYEE_NO_ARRAY : EMPLOYEE_NO_ARRAY.toString(),PAID_AMOUNT_ARRAY : PAID_AMOUNT_ARRAY.toString(),PAID_AMOUNT : PAID_AMOUNT,TRANSACTION_TYPE_NO : TRANSACTION_TYPE_NO,ACC_BANK_NO : ACC_BANK_NO,ACC_BANK_ACCOUNT_NO : ACC_BANK_ACCOUNT_NO,CURRENT_BALANCE : CURRENT_BALANCE},function(data){
            alert("Salary Paid Successfully!");
            loadPage(page_url);
        });
    });

    $(document).on("change",".page_load",function(){
        var url = $(this).attr("url");
        loadPage(url); 
    });

    $(document).on("click","#btnCashDepositToBank",function(){
        $(this).attr("disabled","disabled");
        $("#err_TRANSACTION_DATE").text("");
        $("#err_ACC_BANK_NO").text("");
        $("#err_ACC_BANK_ACCOUNT_NO").text("");
        $("#err_TRANSACTION_AMOUNT").text("");
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        var CURRENT_BALANCE = $("#CURRENT_BALANCE_VALUE").text();
        var TRANSACTION_AMOUNT = $(".TRANSACTION_AMOUNT").val();
        var ACC_BANK_NO = $(".ACC_BANK_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var TRANSACTION_ON = $(".TRANSACTION_ON").val();
        if(TRANSACTION_DATE == ""){
            $("#err_TRANSACTION_DATE").text("This field is Required!");
            return false;
        }
        if(TRANSACTION_AMOUNT == ""){
            $("#err_TRANSACTION_AMOUNT").text("This field is Required!");
            return false;
        }
        if(ACC_BANK_NO == ""){
            $("#err_ACC_BANK_NO").text("This field is Required!");
            return false;
        }
        if(ACC_BANK_ACCOUNT_NO == ""){
            $("#err_ACC_BANK_ACCOUNT_NO").text("This field is Required!");
            return false;
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'ACC_CASH_DEPOSIT_TO_BANK',TRANSACTION_DATE: TRANSACTION_DATE,CURRENT_BALANCE: CURRENT_BALANCE,TRANSACTION_AMOUNT: TRANSACTION_AMOUNT,ACC_BANK_NO: ACC_BANK_NO,ACC_BANK_ACCOUNT_NO: ACC_BANK_ACCOUNT_NO,TRANSACTION_ON: TRANSACTION_ON},function(data){
            alert("Cash Deposit to Bank Successfully!");
            loadPage(page_url);
        });
    });

    $(document).on("click","#btnCashWithdrawFromBank",function(){
        $(this).attr("disabled","disabled");
        $("#err_TRANSACTION_DATE").text("");
        $("#err_ACC_BANK_NO").text("");
        $("#err_ACC_BANK_ACCOUNT_NO").text("");
        $("#err_TRANSACTION_AMOUNT").text("");
        var TRANSACTION_DATE = $(".TRANSACTION_DATE").val();
        var CURRENT_BALANCE = $("#CURRENT_BALANCE").text();
        var TRANSACTION_AMOUNT = $(".TRANSACTION_AMOUNT").val();
        var ACC_BANK_NO = $(".ACC_BANK_NO").val();
        var ACC_BANK_ACCOUNT_NO = $(".ACC_BANK_ACCOUNT_NO").val();
        var TRANSACTION_ON = $(".TRANSACTION_ON").val();
        if(TRANSACTION_DATE == ""){
            $("#err_TRANSACTION_DATE").text("This field is Required!");
            return false;
        }
        if(TRANSACTION_AMOUNT == ""){
            $("#err_TRANSACTION_AMOUNT").text("This field is Required!");
            return false;
        }
        if(ACC_BANK_NO == ""){
            $("#err_ACC_BANK_NO").text("This field is Required!");
            return false;
        }
        if(ACC_BANK_ACCOUNT_NO == ""){
            $("#err_ACC_BANK_ACCOUNT_NO").text("This field is Required!");
            return false;
        }
        $.post(base_url+"admin/ajax/ajax_request.php",{REQ_TYPE:'ACC_CASH_WIDTHDRAW_FROM_BANK',TRANSACTION_DATE: TRANSACTION_DATE,CURRENT_BALANCE: CURRENT_BALANCE,TRANSACTION_AMOUNT: TRANSACTION_AMOUNT,ACC_BANK_NO: ACC_BANK_NO,ACC_BANK_ACCOUNT_NO: ACC_BANK_ACCOUNT_NO,TRANSACTION_ON: TRANSACTION_ON},function(data){
            alert("Cash Width Draw from Bank Successfully!");
            loadPage(page_url);
        });
    });
});

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;

    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;

    window.close();
}