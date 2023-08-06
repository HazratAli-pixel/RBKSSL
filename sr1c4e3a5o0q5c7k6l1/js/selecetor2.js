
        "use strict";
      function cmbCode_bankbookonchange(){
      var Sel    = $('#cmbCode').val();
      var Text   = $('#cmbCode').text();
      var select = $("option:selected", $("#cmbCode")).text()
        $("#txtName").val(select);
        $("#txtCode").val(Sel);
    }

     $(document).ready(function() {
     
              

   var frm = $("#cash_adjustment");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url      : $(this).attr('action'),
            method   : $(this).attr('method'),
            dataType : 'json',
            data     : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
         setInterval(function(){ location.reload(); }, 2000);
                } else {
           toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });



     /*contra voucher*/
    $(document).ready(function() {
                "use strict";
   var frm = $("#contra_voucher_form");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url      : $(this).attr('action'),
            method   : $(this).attr('method'),
            dataType : 'json',
            data     : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
           setInterval(function(){ location.reload(); }, 2000);
            
                } else {
           toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });

    "use strict";
    function addaccountContravoucher(divName){
    var optionval = $("#headoption").val();
    var row       = $("#debtAccVoucher tbody tr").length;
    var count     = row + 1;
    var limits    = 500;
    var tabin     = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control select2' onchange='load_dbtvouchercode(this.value,"+ count +")' required></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='text' name='txtAmount[]' class='form-control total_price text-right valid_number' value='0' id='txtAmount_"+ count +"' onkeyup='calculationContravoucher("+ count +")'></td><td><input type='text' name='txtAmountcr[]' class='form-control total_price1 text-right valid_number' id='txtAmount1_"+ count +"' value='0' onkeyup='calculationContravoucher("+ count +")'></td><td><button  class='btn btn-danger-soft red' type='button'  onclick='deleteRowContravoucher(this)'><i class='far fa-trash-alt'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
           $("#cmbCode_"+count).html(optionval);
          count++;
           
         $(".select2").select2();
        }
    }


    "use strict";
function calculationContravoucher(sl) {
        var gr_tot1=0;
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

 $(".total_price1").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot1 += parseFloat(this.value))
        });
        $("#grandTotal").val(gr_tot.toFixed(2,2));
         $("#grandTotal1").val(gr_tot1.toFixed(2,2));
    }


      "use strict";
    function deleteRowContravoucher(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationContravoucher()
    }


  "use strict";
  function load_dbtvouchercode(id,sl){
   var base_url = $("#base_url").val();
    $.ajax({
        url     : base_url + "/account/debitvoucher_code/" + id,
        type    : "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

/*debit credit voucher*/
  $(document).ready(function() {
  "use strict";
   var frm = $("#credit_voucher_form");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url      : $(this).attr('action'),
            method   : $(this).attr('method'),
            dataType : 'json',
            data     : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
      setInterval(function(){ location.reload(); }, 2000);
            
                } else {
           toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });

             
"use strict";
    function addaccountdbt(divName){
    var optionval = $("#headoption").val();
    var row       = $("#debtAccVoucher tbody tr").length;
    var count     = row + 1;
    var limits    = 500;
    var tabin     = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control select2' onchange='load_dbtvouchercode(this.value,"+ count +")' required></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='text' name='txtAmount[]' class='form-control total_price text-right valid_number' id='txtAmount_"+ count +"' onkeyup='dbtvouchercalculation("+ count +")' required></td><td><button class='btn btn-danger-soft red' type='button'  onclick='deleteRowdbtvoucher(this)'><i class='far fa-trash-alt'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
           $("#cmbCode_"+count).html(optionval);
          count++;
           
        $(".select2").select2();
        }
    }


    "use strict";
function dbtvouchercalculation(sl) {
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotal").val(gr_tot.toFixed(2,2));
    }

       "use strict";
    function deleteRowdbtvoucher(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        dbtvouchercalculation()
    }


    "use strict";
  function load_dbtvouchercode(id,sl){
   var base_url = $("#base_url").val();
    $.ajax({
        url     : base_url + "/account/debitvoucher_code/" + id,
        type    : "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


  $(document).ready(function() {
    "use strict";
   var frm = $("#customer_receive");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url      : $(this).attr('action'),
            method   : $(this).attr('method'),
            dataType : 'json',
            data     : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
                             swal({
        title: "Success!",
        showCancelButton  : true,
        cancelButtonText  : "NO",
        cancelButtonColor : "red",
        confirmButtonText : "Yes",
        confirmButtonColor: "#008000",
        text: "Do You Want To Print ?",
        type: "success",
        
       
      }, function(inputValue) {
          if (inputValue===true) {
     $('#customer_receive').trigger("reset");
        
       printRawHtmlCustomerRcv(data.details);
     } else {
      $('#customer_receive').trigger("reset");
      }
      });     
          } else {
           toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });

      function printRawHtmlCustomerRcv(view) {
      printJS({
        printable: view,
        type: 'raw-html',
        onPrintDialogClose: printJobCompletecrv(),
        
      });

      

    }

      function printJobCompletecrv() {
        setInterval(function(){ location.reload(); }, 3000);

        }

    "use strict";
    $( document ).ready(function() {
     var elements = document.getElementsByClassName('bank_div');
    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'none';
    }
    });
    "use strict";
    function bank_payment(val){
        if(val==2){
           var style = 'block';           
        }else{
     var style ='none';
        }
        var elements = document.getElementsByClassName('bank_div');

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display =style;
    }    
   
    }


    "use strict";
    function load_customer_code(id){
      var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "/account/customer_code/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          $('#txtCode').val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

  
  $(document).ready(function() {
    "use strict";
   var frm = $("#debit_voucher_form");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url : $(this).attr('action'),
            method : $(this).attr('method'),
            dataType : 'json',
            data : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
            location.reload();
                } else {
           toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });

    $(document).ready(function(){
        "use strict";
        var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
        var base_url = $("#base_url").val();
        $('#cmbGLCode').on('change',function(){
           var Headid=$(this).val();
            $.ajax({
                 url: base_url + '/account/ledger_head',
                type: 'POST',
                data: {
                    Headid: Headid,
                    app_csrf:CSRF_TOKEN
                },
                success: function (data) {
                   $("#ShowmbGLCode").html(data);
                }
            });

        });
    });


      $(document).ready(function() {
            "use strict";

var frm = $("#journal_voucher_form");
frm.on('submit', function(e) {
    e.preventDefault(); 
    $.ajax({
        url : $(this).attr('action'),
        method : $(this).attr('method'),
        dataType : 'json',
        data : frm.serialize(),
        success: function(data) 
        {
    if (data.status == true) {
       toastr["success"](data.message);
 setInterval(function(){ location.reload(); }, 2000);
        
            } else {
       toastr["error"](data.exception);
            }
        },
        error: function(xhr)
        {
            alert('failed!');
        }
    });
});
 });


/*manufacturer payment part*/
  $(document).ready(function() {
    "use strict";
   var frm = $("#manufacturer_payment");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url      : $(this).attr('action'),
            method   : $(this).attr('method'),
            dataType : 'json',
            data     : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
                             swal({
        title: "Success!",
        showCancelButton: true,
        cancelButtonText: "NO",
        cancelButtonColor: "red",
        confirmButtonText: "Yes",
        confirmButtonColor: "#008000",
        text: "Do You Want To Print ?",
        type: "success",
        
       
      }, function(inputValue) {
          if (inputValue===true) {
     $('#manufacturer_payment').trigger("reset");
        
       printRawHtmlmpayment(data.details);
  } else {
    location.reload();
  }
    
      });  
            
                } else {
           toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });

      function printRawHtmlmpayment(view) {
      printJS({
        printable: view,
        type: 'raw-html',
        onPrintDialogClose: printJobCompletempayment(),
        
      });

      

    }

        function printJobCompletempayment() {
       
       setInterval(function(){ location.reload(); }, 3000);
        }

    "use strict";
 function load_manufacturer_code(id){
   var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "/account/manufacturer_code/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode').val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


          $(document).ready(function() {
                "use strict";

   var frm = $("#opening_form");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url      : $(this).attr('action'),
            method   : $(this).attr('method'),
            dataType : 'json',
            data     : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
            setInterval(function(){ location.reload(); }, 1000);
                } else {
           toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });



    $(document).ready(function () {
  $('#jstree1').jstree({
            'core' : {
                "themes" : { "icons": false },

            },
            'plugins' : [ 'types', 'dnd' ],
            
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                },
                'attr':{
                    'class': 'panel-heading'
                }

            }
        });
  });


    "use strict";
function loadCoaData(id){
  var base_url = $("#base_url").val();
    $.ajax({
        url     : base_url + "/account/load_treeform/" + id,
        type    : "GET",
        dataType: "json",
        success: function(data)
        {
          

            $('#newform').html(data);
            $('#treeviewmodal').modal('show'); 
            $('#btnSave').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}




    "use strict";
    function newHeaddata(id){
      var base_url = $("#base_url").val();
     $.ajax({
        url     : base_url + "/account/new_form/" + id,
        type    : "GET",
        dataType: "json",
        success: function(data)
        {
           console.log(data.rowdata);
           var headlabel = data.headlabel;
           $('#txtHeadCode').val(data.headcode);
            document.getElementById("txtHeadName").value = '';
            $('#txtPHead').val(data.rowdata.HeadName);
            $('#txtHeadLevel').val(headlabel);
            $('#btnSave').prop("disabled", false);
             $('#btnSave').show();
            $('#btnUpdate').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


function treeSubmit(){
  var frm      = $("#treeview_form");
  var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
  var fdata    = frm.serialize();
  var base_url = $("#base_url").val();
  var headcode = $('input[name=txtHeadCode]').val();
  var headname = $('input[name=txtHeadName]').val();
  var oldHeadname = $('input[name=HeadName]').val();
  var pheadname= $('input[name=txtPHead]').val();
  var level    = $('input[name=txtHeadLevel]').val();
  var type     = $('input[name=txtHeadType]').val();
  var is_active= $('input[name=IsActive]').val();
  var is_trans = $('input[name=IsTransaction]').val();
  var is_gl = $('input[name=IsGL]').val();
             $.ajax({
            url      : base_url+"/account/add_coa",
            method   : 'POST',
            dataType : 'json',
            data     : {
              txtHeadCode:headcode,txtHeadName:headname,HeadName:oldHeadname,txtPHead:pheadname,txtHeadLevel:level,txtHeadType:type,IsActive:is_active,IsTransaction:is_trans,IsGL:is_gl,app_csrf:CSRF_TOKEN

            },
            success: function(data) 
            { 
              
                 
                if (data.status == true) {
                   toastr["success"](data.message);
                } else {
                    toastr["error"](data.exception);
                }
                $("#treeviewmodal").modal('hide');
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
}  

  $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#voucherList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting" : [[ 2, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,3,4,5,6] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[20, 35, 50,100,250,500, -1], [20, 35, 50,100,250,500, "All"]],
 
                        buttons  : [{
                        extend   : 'copyHtml5',
                        text     : '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'excelHtml5',
                        text     : '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'csvHtml5',
                        text     : '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'pdfHtml5',
                        text     : '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/account/check_voucherlist',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'VNo' },
             { data: 'VDate'},
             { data: 'Narration' },
             { data: 'Debit'},
             { data: 'Credit'},
             { data: 'button'},
          ],


    });

});

/*account js end */   

/*bank js start*/
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#signature_pic").change(function() {
  readURL(this);
});


 $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#BankList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting" : [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[20,35, 50,100,250,500, -1], [20, 35, 50,100,250,500, "All"]],
 
                        buttons  : [{
                        extend   : 'copyHtml5',
                        text     : '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'excelHtml5',
                        text     : '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'csvHtml5',
                        text     : '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'pdfHtml5',
                        text     : '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/bank/bank_checkdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'bank_name' },
             { data: 'ac_name'},
             { data: 'ac_number' },
             { data: 'branch'},
             { data: 'signature_pic'},
             { data: 'balance',class:"balance text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
 
  api.columns('.balance', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toFixed(2, 2));
  });


}

    });

});

/* bank js end*/

/*customer js start*/
$(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#CustomerListCredit').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting" : [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9,10] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[20, 25, 35,100,250,500, -1], [20, 35, 50,100,250,500, "All"]],
 
                        buttons  : [{
                        extend   : 'copyHtml5',
                        text     : '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'excelHtml5',
                        text     : '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'csvHtml5',
                        text     : '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'pdfHtml5',
                        text     : '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/customer/credit_customer_checkdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'customer_name' },
             { data: 'address'},
             { data: 'mobile' },
             { data: 'email'},
             { data: 'city'},
             { data: 'state'},
             { data: 'zip'},
             { data: 'country'},
             { data: 'balance',class:"balance text-right"},
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
 
  api.columns('.balance', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+''+sum.toFixed(2, 2));
  });


}

    });

});


 $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#CustomerList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting" : [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9,10] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[20, 35, 50,100,250,500, -1], [20, 35, 50,100,250,500, "All"]],
 
                        buttons  : [{
                        extend   : 'copyHtml5',
                        text     : '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'excelHtml5',
                        text     : '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'csvHtml5',
                        text     : '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'pdfHtml5',
                        text     : '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/customer/customer_checkdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'customer_name' },
             { data: 'address'},
             { data: 'mobile' },
             { data: 'email'},
             { data: 'city'},
             { data: 'state'},
             { data: 'zip'},
             { data: 'country'},
             { data: 'balance',class:"balance text-right"},
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
 
  api.columns('.balance', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+''+sum.toFixed(2, 2));
  });


}

    });

});


   $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#CustomerListpaid').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting" : [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9,10] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[20, 35, 50,100,250,500, -1], [20, 35, 50,100,250,500, "All"]],
 
                        buttons  : [{
                        extend   : 'copyHtml5',
                        text     : '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'excelHtml5',
                        text     : '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'csvHtml5',
                        text     : '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend   : 'pdfHtml5',
                        text     : '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/customer/paid_customer_checkdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'customer_name' },
             { data: 'address'},
             { data: 'mobile' },
             { data: 'email'},
             { data: 'city'},
             { data: 'state'},
             { data: 'zip'},
             { data: 'country'},
             { data: 'balance',class:"balance text-right"},
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
 
  api.columns('.balance', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+''+sum.toFixed(2, 2));
  });


}

    });

});

/*customer js end*/
/*language js start*/
 $(document).ready(function() { 
      "use strict";
   var language       = $('#language').val();
   var base_url       = $('#base_url').val();
   var csrf_test_name = $('[name="csrf_test_name"]').val();
   var total_phrase   = $('#total_phrase').val();
     $('#languageList').DataTable({ 

             responsive: true,
       
             "aaSorting" : [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[25, 50,100,250,500, total_phrase], [25, 50,100,250,500, "All"]],
            
            'serverMethod': 'post',
            'ajax': {
               'url' : base_url + '/dashboard/labels',
               "type": "POST",
               data:{
                language : language,
                app_csrf:csrf_test_name
               }
            },
          'columns': [
             { data: 'sl' },
             { data: 'phrase' },
             { data: language},
          ],



    });



});

   function userRole(id){
var base_url       = $('#base_url').val();
        $.ajax({
            url     : base_url + "/role/check_exist/" + id,
            type    : "GET",
            dataType: "json",
            success: function(data)
            {
                $('#existrole').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#existrole').html("<p style='color:red'><?php echo lan('no_role_selected');?></p>");
            }
        });
    }


    /*hrm js start*/
    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#attendanceList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting" : [[ 2, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,3,4,5,6] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons  : [{
                        extend   : 'copyHtml5',
                        text     : '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title    : " attendance List",
                        className: 'btn-light'
                    },
                    {
                        extend   : 'excelHtml5',
                        text     : '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        exportOptions: {
                       columns   : [ 0, 1, 2, 3, 4,5] 
                           },
                        title    : "attendance List",
                        className: 'btn-light'
                    },
                    {
                        extend   : 'csvHtml5',
                        text     : '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns   : [ 0, 1, 2, 3, 4,5] 
                           },
                         title   : "attendance List",
                        className: 'btn-light'
                    },
                    {
                        extend   : 'pdfHtml5',
                        text     : '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                        columns  : [ 0, 1, 2, 3, 4,5] 
                           },
                        title    : "attendance List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/attendance/attendance_checkdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'employee' },
             { data: 'date' },
             { data: 'sign_in'},
             { data: 'sign_out' },
             { data: 'staytime' },
             { data: 'button'},
          ],

    });

});


  
  function singout_modal(id){
    $("#attendance_id").val(id);
    $("#sign_outmodal").modal('show');
  }

   $(document).ready(function() {
                "use strict";

   var frm = $("#singout_form");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url      : $(this).attr('action'),
            method   : $(this).attr('method'),
            dataType : 'json',
            data     : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
           location.reload();
                } else {
           toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });

   $("#image").change(function() {
  readURL(this);
});



  $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#EmployeeList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting" : [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9,10] },

            ],
           'processing'  : true,
           'serverSide'  : true,

          
           'lengthMenu'  :[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                buttons  : [{
                extend   : 'copyHtml5',
                text     : '<i class="far fa-copy"></i>',
                titleAttr: 'Copy',
                title    : " employee List",
                className: 'btn-light'
                    },
                    {
                extend   : 'excelHtml5',
                text     : '<i class="far fa-file-excel"></i>',
                titleAttr: 'Excel',
                exportOptions: {
               columns   : [ 0, 1, 2, 3, 4,5,6,7,8] 
                   },
                title    : "employee List",
                className: 'btn-light'
                    },
                    {
                extend   : 'csvHtml5',
                text     : '<i class="far fa-file-alt"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                columns  : [ 0, 1, 2, 3, 4,5,6,7,8] 
                   },
                title    : "employee List",
                className: 'btn-light'
                    },
                    {
                extend   : 'pdfHtml5',
                text     : '<i class="far fa-file-pdf"></i>',
                exportOptions: {
                columns  : [ 0, 1, 2, 3, 4,5,6,7,8] 
                   },
                title    : "employee List",
                titleAttr: 'PDF',
                className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/employee/employee_checkdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'first_name' },
             { data: 'last_name' },
             { data: 'designation'},
             { data: 'phone' },
             { data: 'email' },
             { data: 'blood_group'},
             { data: 'hrate'},
             { data: 'country'},
             { data: 'image'},
             { data: 'button'},
          ],

    });

});




    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#expenseList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 2, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,3,4,5,6] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
              buttons  : [{
              extend   : 'copyHtml5',
              text     : '<i class="far fa-copy"></i>',
              titleAttr: 'Copy',
              title    : " expense List",
              className: 'btn-light'
                    },
                    {
              extend   : 'excelHtml5',
              text     : '<i class="far fa-file-excel"></i>',
              titleAttr: 'Excel',
              exportOptions: {
              columns  : [ 0, 1, 2, 3, 4,5] 
                 },
              title    : "expense List",
              className: 'btn-light'
                    },
                    {
              extend   : 'csvHtml5',
              text     : '<i class="far fa-file-alt"></i>',
              titleAttr: 'CSV',
              exportOptions: {
              columns  : [ 0, 1, 2, 3, 4,5] 
                 },
              title    : "expense List",
              className: 'btn-light'
                    },
                    {
              extend   : 'pdfHtml5',
              text     : '<i class="far fa-file-pdf"></i>',
              exportOptions: {
              columns  : [ 0, 1, 2, 3, 4,5] 
                 },
              title    : "expense List",
              titleAttr: 'PDF',
              className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
            'url' :base_url + '/expense/check_expensedata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
         data.fromdate       = $('#from_date').val();
         data.todate         = $('#to_date').val();
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'date' },
             { data: 'HeadName' },
             { data: 'debit'},
             { data: 'credit' },
             { data: 'narration' },
             { data: 'button'},
          ],

    });


     $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});



    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#SalarySheet').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting" : [[ 3, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,4] },

            ],
             'processing': true,
             'serverSide': true,
          
             'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                buttons  : [{
                extend   : 'copyHtml5',
                text     : '<i class="far fa-copy"></i>',
                titleAttr: 'Copy',
                title    : " salry List",
                className: 'btn-light'
                    },
                    {
                    extend: 'excelHtml5',
                    text: '<i class="far fa-file-excel"></i>',
                    titleAttr: 'Excel',
                     exportOptions: {
                   columns: [ 0, 1, 2, 3] 
                       },
                    title: "salry List",
                    className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "salry List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "salry List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/payroll/get_salary_sheet',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'gdate' },
             { data: 'date' },
             { data: 'generate_by'},
             { data: 'button'},
          ],

    });

});



  $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#SalaryPayment').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 6, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,4,5,7,8,9] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title: " salry List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                        title: "salry List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "salry List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "salry List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/payroll/get_salary_paymentlist',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'employee' },
             { data: 'salary_month'},
             { data: 'total_salary' },
             { data: 'total_working_minutes'},
             { data: 'working_period'},
             { data: 'payment_date'},
              { data: 'payment_due'},
             { data: 'paid_by'},
             { data: 'button'},
          ],

    });

});


  
    function payment_modal(salpayid,employee_id,TotalSalary,WorkHour,Period,salary_month){
   var sal_id         = salpayid;
   var employee_id    = employee_id;
   var base_url       =  $("#base_url").val();
   var csrf_test_name = $('[name="csrf_test_name"]').val();
    $.ajax({
    url: base_url + "/payroll/employee_paydata/",
    method:'post',
    dataType:'json',
    data:{
     'sal_id'        :sal_id,
     'employee_id'   :employee_id,
     'totalamount'   :TotalSalary,
     'app_csrf':csrf_test_name
    },
    success:function(data){
  document.getElementById('employee_name').value = data.Ename;
  document.getElementById('employee_id').value   = data.employee_id;
  document.getElementById('salType').value       = salpayid;
  document.getElementById('total_salary').value  = TotalSalary;
  document.getElementById('total_working_minutes').value = WorkHour;
  document.getElementById('working_period').value= Period;
  document.getElementById('salary_month').value = salary_month;
  $("#paymentModal").modal('show');
    },
    error:function(jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }

    });

   
  }


            "use strict";
function employechange(id){
  var base_url       =  $("#base_url").val();
  var csrf_test_name = $('[name="csrf_test_name"]').val();
$.ajax({
  url: base_url + "/payroll/employee_basic_info/",
  method:'post',
  dataType:'json',
  data:{
'employee_id': id,
app_csrf:csrf_test_name,
  },
  success:function(data){
document.getElementById('basic').value=data.rate;
document.getElementById('sal_type').value=data.rate_type;
document.getElementById('sal_type_name').value=data.stype;
document.getElementById('grsalary').value=data.rate;
if(data.rate_type==1){
  document.getElementById("taxinput").disabled = true;
   document.getElementById("taxmanager").checked = true;
   document.getElementById("taxmanager").setAttribute('disabled','disabled');  
}else{
  document.getElementById("taxinput").disabled = false;
   document.getElementById("taxmanager").checked = false;
  document.getElementById("taxmanager").removeAttribute('disabled');  
}
var i;
var count = $('#add tr').length;
for (i = 0; i < count; i++) { 
   $("#add_"+i).val('');
}

  },
   error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
});
}


    "use strict";
function summary(){
var addper = 0;
 $(".addamount").each(function() {
        isNaN(this.value) || 0 == this.value.length || (addper += parseFloat(this.value))
    });
 if(addper >100){
  alert('You Can Not input more than 100%');
 }
var b = parseInt($('#basic').val());
var add = 0;
var deduct = 0;
 $(".addamount").each(function() {
  var value = this.value;
  var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (add += parseFloat(value*basic/100))
    });
 $(".deducamount").each(function() {
   var value = this.value;
  var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (deduct += parseFloat(value*basic/100))
    });
document.getElementById('grsalary').value=add+b-(deduct);
}


    "use strict";
 function handletax(checkbox){
  var deduct = 0;
  var add = 0;
  var b = parseInt($('#basic').val());
   $(".deducamount").each(function() {
   var value = this.value;
  var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (deduct += parseFloat(value*basic/100))
    });
    $(".addamount").each(function() {
  var value = this.value;
  var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (add += parseFloat(value*basic/100))
    });
 
  var amount = b-deduct;
  var  tax    = parseInt($('#taxinput').val());
  var netamount = amount+tax;
  var base_url =  $("#base_url").val();
  var csrf_test_name = $('[name="csrf_test_name"]').val();
    if(checkbox.checked == true){
       $.ajax({
        url : base_url +'/payroll/tax_handle',
            method: 'post',
            dataType: 'json',
            data: 
            {
                'amount': amount,
                app_csrf:csrf_test_name,
            },
        success: function(data)
        {            
              document.getElementById('grsalary').value=add+b-data-deduct;
              document.getElementById('taxinput').value='';
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }else{
var b = parseInt($('#basic').val());
var add = 0;
var deduct = 0;
 $(".addamount").each(function() {
  var value = this.value;
  var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (add += parseFloat(value*basic/100))
    });
 $(".deducamount").each(function() {
   var value = this.value;
  var basic = parseInt($('#basic').val());
        isNaN(value*basic/100) || 0 == (value*basic/100).length || (deduct += parseFloat(value*basic/100))
    });
document.getElementById('grsalary').value=add+b-(deduct);
   }
}



    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#employeesalaryList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 3, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,4,5] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title: " salry List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                        title: "salry List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                         title: "salry List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                         title: "salry List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/payroll/salary_setupdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'employee' },
             { data: 'salary_type' },
             { data: 'create_date'},
             { data: 'gross_salary' },
             { data: 'button'},
          ],

    });

});




    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#loanpayment').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 2, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,3,4,5] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title: " Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                        title: "Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "Person List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/loan/check_loanpaymentList',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
         data.fromdate = $('#from_date').val();
         data.todate = $('#to_date').val();
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'person_name' },
             { data: 'VDate' },
             { data: 'narration'},
             { data: 'amount',class:"text-right total_balance",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

"footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_balance', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });


  $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


 $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#loanpersonledger').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 2, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,3,4,5] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title: " Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                        title: "Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "Person List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/loan/checkperson_ledger',
            "data": function ( data) {
         data.app_csrf       = CSRF_TOKEN;
         data.fromdate       = $('#from_date').val();
         data.todate         = $('#to_date').val();
         data.person_id      = $('#person_id').val();
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'person_name' },
             { data: 'VDate' },
             { data: 'narration'},
             { data: 'debit',class:"text-right total_debit",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'credit',class:"text-right total_credit",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'balance',class:"text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency )},
          ],

"footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_debit', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });

     api.columns('.total_credit', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });


  $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});

 $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#LoanPersonList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 2, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,3,4] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title: " Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                        title: "Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "Person List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3] 
                           },
                         title: "Person List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/loan/personal_loan_checkperson',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'person_name' },
             { data: 'person_phone' },
             { data: 'person_address'},
             { data: 'balance',class:"text-right total_balance",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

"footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_balance', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

});

 /*invoice js part start*/

    "use strict";   
function CustomerListInvoice(sl) {
    var base_url   = $('#base_url').val();
    var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
            var customer_name = $('#customer_name').val();
        $.ajax( {
          url: base_url + "/invoice/search_customer",
          method: 'POST',
          dataType: "json",
          data: {
            term: request.term,
            customer_name:customer_name,
            app_csrf:CSRF_TOKEN
          },
          success: function( data ) {
           
            response( data );

          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find("#customer_id").val(ui.item.value); 
           
            var customer_id          = ui.item.value;
            $(this).unbind("change");
            customer_due(customer_id);
            return false;
       }
   }

   $('body').on('keypress.autocomplete', '#customer_name', function() {
       $(this).autocomplete(options);
   });


}


/*bank payment part show\hide*/
    "use strict";
    $( document ).ready(function() {
     var elements = document.getElementsByClassName('bank_div');
     var ptype = $('#payment_type').val();
    for (var i = 0; i < elements.length; i++){
        if(ptype == 2){
        elements[i].style.display = 'block';
        }else{
         elements[i].style.display = 'none';   
        }
        
    }
    });
    "use strict";
    function bank_payment(val){
        if(val==2){
           var style = 'block';           
        }else{
     var style ='none';
   
        }
        var elements = document.getElementsByClassName('bank_div');

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display =style;
    }    
   
    }



"use strict";
function addInputFieldInvoice(t) {
    var row       = $("#normalinvoice tbody tr").length;
    var count     = row + 1;
    var limits    = 500;
    var taxnumber = $("#txfieldnum").val();
    var tbfild    ='';
    for(var i=0;i<taxnumber;i++){
        var taxincrefield = '<input id="total_tax'+i+'_'+count+'" class="total_tax'+i+'_'+count+' valid_number" type="hidden"><input id="all_tax'+i+'_'+count+'" class="total_tax'+i+'" type="hidden" name="tax[]">';
         tbfild +=taxincrefield;
    }
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name_" + count,
            tabindex = count * 5,
            e = document.createElement("tr"),
            tab1 = tabindex + 1,
            tab2 = tabindex + 2,
            tab3 = tabindex + 3,
            tab4 = tabindex + 4,
            tab5 = tabindex + 5,
            tab6 = tabindex + 6,
            tab7 = tabindex + 7,
            tab8 = tabindex + 8,
            tab9 = tabindex + 9,
            tab10 = tabindex + 10,
            tab11 = tabindex + 11;
        e.innerHTML = "<td><input type='text' name='product_name' onkeyup='invoice_productList(" + count + ")' onkeypress='invoice_productList(" + count + ")' class='form-control productSelection' placeholder='Medicine Name' id='" + a + "' required tabindex='"+tab1+"'><input type='hidden' class='autocomplete_hidden_value  product_id_" + count + "' name='product_id[]' id='product_id_" + count + "'/></td><td><select class='form-control select2' required id='batch_id_" + count + "'  name='batch_id[]' onchange='product_stock_invoice(" + count + ")' tabindex='"+tab2+"'><option></option></select>     <td><input type='text' name='available_quantity[]' id='available_quantity_" + count + "' class='form-control text-right available_quantity_" + count + "' value='0' readonly='readonly' /></td> <td id='expire_date_" + count + "'></td><td><input class='form-control text-right unit_" + count + " valid' value='None' readonly='' aria-invalid='false' type='text'></td><td> <input type='text' name='product_quantity[]' onkeyup='quantity_calculate_invoice(" + count + "),checkqty_invoice(" + count + ");' onchange='quantity_calculate_invoice(" + count + ");' id='total_qntt_" + count + "' class='total_qntt_" + count + " form-control text-right valid_number' placeholder='0.00' min='0' tabindex='"+tab3+"' required/></td><td><input type='text' name='box_quantity[]' onkeyup='quantity_calculate_invoice("+count+"),checkqty_invoice("+count+");' onchange='quantity_calculate_invoice("+count+");' class='form-control text-right' id='box_qty_"+count+"' placeholder='0.00' min='0'  readonly='' /><input type='hidden' id='u_box_"+count+"' name='b_qty'/></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate_invoice(" + count + "),checkqty_invoice(" + count + ");' onchange='quantity_calculate_invoice(" + count + ");' id='price_item_" + count + "' class='price_item"+count+" form-control text-right valid_number' required placeholder='0.00'  min='0' tabindex='"+tab4+"'/></td><td><input type='text' name='discount[]' onkeyup='quantity_calculate_invoice(" + count + "),checkqty_invoice(" + count + ");' onchange='quantity_calculate_invoice(" + count + ");' id='discount_" + count + "' class='form-control text-right valid_number' placeholder='0.00' min='0' tabindex='"+tab5+"' /><input type='hidden' value='' name='discount_type' id='discount_type_" + count + "'></td><td class='text-right'><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' readonly='readonly'/></td><td>" + tbfild + "<input type='hidden' id='all_discount_" + count + "' class='total_discount dppr'/><a tabindex='"+tab6+"' style='text-align: right;' class='btn btn-danger-soft'  value='Delete' onclick='deleteRowinvoice(this)'><i class='far fa-trash-alt'></i></a></td>", 
        document.getElementById(t).appendChild(e), 
        document.getElementById(a).focus(),
        document.getElementById("add_invoice_item").setAttribute("tabindex", tab7);
         $(".select2").select2();
        document.getElementById("invdcount").setAttribute("tabindex", tab8);
        document.getElementById("paidAmount").setAttribute("tabindex", tab9);
        document.getElementById("full_paid_invoice_tab").setAttribute("tabindex", tab10);
        document.getElementById("add_invoice").setAttribute("tabindex", tab11);
        
        count++;

    }
}
 

 "use strict";
function deleteRowinvoice(t) {
    var a = $("#normalinvoice > tbody > tr").length;
    if (1 == a) alert("There only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e), 
        calculateSumInvoice();
        invoice_paidamount();
    }
}


 "use strict";
function invoice_productList(sl) {

        var priceClass    = 'price_item'+sl;
        var base_url      = $('#base_url').val();
        var unit          = 'unit_'+sl;
        var tax           = 'total_tax_'+sl;
        var discount_type = 'discount_type_'+sl; 
        var batch_id      = 'batch_id_'+sl;
        var CSRF_TOKEN    = $('[name="csrf_test_name"]').val();

    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
            var product_name = $('#product_name_'+sl).val();
        $.ajax( {
          url: base_url + "/invoice/search_medicine",
          method: 'post',
          dataType: "json",
          data: {
            term: request.term,
            product_name:product_name,
            app_csrf:CSRF_TOKEN
          },
          success: function( data ) {
            response( data );

          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
                $(this).val(ui.item.label);
                var id=ui.item.value;
                var dataString = 'product_id='+ id;
                var boxqty     = 'u_box_'+ sl;
                var base_url   = $('.baseUrl').val();
                var available_quantity = 'available_quantity_'+sl;
                $.ajax
                   ({
                        type: "POST",
                        url: base_url+"/invoice/medicine_details_data",
                        data: {
                            product_id:id,app_csrf:CSRF_TOKEN
                           
                        },
                        cache: false,
                        success: function(data)
                        {
                       
                            var obj = jQuery.parseJSON(data);
                                for (var i = 0; i < (obj.txnmber); i++) {
                            var txam = obj.taxdta[i];
                            var txclass = 'total_tax'+i+'_'+sl;
                           $('.'+txclass).val(txam);
                            }

                         $('.'+priceClass).val(obj.price);
                            $('.'+unit).val(obj.unit);
                            $('#'+batch_id).html(obj.batch);
                            $('#'+boxqty).val(obj.box_qty);
                            $('#'+available_quantity).val(obj.total_product);
                            quantity_calculate_invoice(sl);
                            
                        } 
                    });

            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keypress.autocomplete', '.productSelection', function() {
       $(this).autocomplete(options);
   });

}


   "use strict";
function product_stock_invoice(sl) {
            var  batch_id          = $('#batch_id_'+sl).val();
            var dataString         = 'batch_id='+ batch_id;
            var product_id         = $('#product_id_'+sl).val();
            var available_quantity = 'available_quantity_'+sl;
            var product_rate       = 'product_rate_'+sl;
            var expire_date        = 'expire_date_'+sl;
            var base_url           = $('#base_url').val();
            var CSRF_TOKEN         = $('[name="csrf_test_name"]').val();
             $.ajax({
                type: "POST",
                url: base_url+"/invoice/get_batch_stock",
                data: {batch_id:batch_id,product_id:product_id,app_csrf:CSRF_TOKEN},
                cache: false,
                success: function(data)
                {
                   var obj   = JSON.parse(data);
                   var today = new Date();
                   var dd    = today.getDate();
                   var mm    = today.getMonth()+1; 
                   var yyyy = today.getFullYear();
                    if(dd<10){
                    var dd='0'+dd;
                    }
                    if(mm<10){
                     var mm='0'+mm;
                    }
                    var today = yyyy+'-'+mm+'-'+dd;

                   var aj  = new Date(today);
                   var exp = new Date(obj.expire_date);
                    if (aj >= exp) {
                   
                      toastr["error"]('Date Expired Please Select another');
                      $('#batch_id_'+sl)[0].selectedIndex = 0;
                      $('#'+expire_date).html('<p style="color:red;align:center">'+obj.expire_date+'</p>');
                       document.getElementById('expire_date_'+sl).innerHTML = '';
                    }else{
                       $('#'+expire_date).html('<p style="color:green;align:center">'+obj.expire_date+'</p>');
                    }


                    $('#'+available_quantity).val(obj.total_product);

                }
             });

            $(this).unbind("change");
            return false;

}


"use strict";
function quantity_calculate_invoice(item) {
    var quantity    = $("#total_qntt_" + item).val();
    var price_item  = $("#price_item_" + item).val();
    var discount    = $("#discount_" + item).val();
    var invoice_discount = $("#invdcount").val();
    var box         = $("#u_box_"+item).val();
    var box_qty     = quantity/box;
      $("#box_qty_" + item).val(box_qty);
    var total_tax   = $("#total_tax_" + item).val();
    var total_discount = $("#total_discount_" + item).val();
    var dis_type    = $("#discount_type").val();
    var taxnumber = $("#txfieldnum").val();

var available_quantity = $("#available_quantity_" + item).val();
    if (parseInt(quantity) > parseInt(available_quantity)) {
        var message = "You can Sale maximum " + available_quantity + " Items";
         $("#total_qntt_" + item).val('');
        var quantity = 0;
         alert(message);
        $("#total_price_" + item).val(0);
        for(var i=0;i<taxnumber;i++){
        $("#all_tax"+i+"_" + item).val(0);
         
    }
       
        
    }
        

    if (quantity > 0 || discount > 0) {
        if (dis_type == 1) {
           var price = quantity * price_item;
            var dis = (price * discount / 100);
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var temp = price - dis;
            var ttletax = 0;
            $("#total_price_" + item).val(temp.toFixed(2,2));
             for(var i=0;i<taxnumber;i++){
           var tax = (temp) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }


        }else if(dis_type == 2){
            var price = quantity * price_item;
            // Discount cal per product
            var dis   = discount * quantity;
            $("#all_discount_" + item).val(dis);

            //Total price calculate per product
             var temp = price - dis;
            $("#total_price_" + item).val(temp.toFixed(2,2));

            var ttletax = 0;
             for(var i=0;i<taxnumber;i++){
           var tax = (temp) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }

        }else if(dis_type == 3){
             var total_price = quantity * price_item;
             var dis =  discount;
            // Discount cal per product
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var price = total_price - dis;
            $("#total_price_" + item).val(price.toFixed(2,2));

             var ttletax = 0;
             for(var i=0;i<taxnumber;i++){
           var tax = (price) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }
        }
    }else {
        var n = quantity * price_item;
        var c = quantity * price_item * total_tax;
        $("#total_price_" + item).val(n), 
        $("#all_tax_" + item).val(c)
    }
    calculateSumInvoice();
    invoice_paidamount();
}
//Calculate Sum
"use strict";
function calculateSumInvoice() {
document.getElementById("change").value = '';
  var taxnumber = $("#txfieldnum").val();

    var t  = 0,
        a  = 0,
        e  = 0,
        o  = 0,
        f  = 0,
        p  = 0,
        ad = 0,
        tx = 0,
        ds = 0,
     invdis =  $("#invdcount").val();
    //Total Tax
      for(var i=0;i<taxnumber;i++){
      
var j = 0;
    $(".total_tax"+i).each(function () {
        isNaN(this.value) || 0 == this.value.length || (j += parseFloat(this.value))
    });
            $("#total_tax_amount"+i).val(j.toFixed(2, 2));
             
    }
    //Total Discount
    $(".total_discount").each(function() {
        isNaN(this.value) || 0 == this.value.length || (p += parseFloat(this.value))
    }), 
    
    $("#total_discount_ammount").val(p.toFixed(2,2)),
    $("#total_product_dis").val(p), 

     $(".totalTax").each(function () {
        isNaN(this.value) || 0 == this.value.length || (f += parseFloat(this.value))
    }),
            $("#total_tax_amount").val(f.toFixed(2, 2)),

    //Total Price
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
    }),
     $(".dppr").each(function () {
        isNaN(this.value) || 0 == this.value.length || (ad += parseFloat(this.value))
    }), 

    o  = a.toFixed(2,2), 
    e  = t.toFixed(2,2),
    tx = f.toFixed(2, 2),
    ds = p.toFixed(2, 2);

    var test = +tx + +e + -ds+ -invdis+ + ad;
      var dis = $("#total_product_dis").val();
    var totaldiscount = +dis + +invdis;
    var total =  parseFloat(t);
    if(totaldiscount > total){
    var message = 'Discount Can not Greater than Total Amount';
         toastr["error"](message);
         $("#invdcount").val(0);
         var test = +tx + +e + -ds+  +ad;
          var totaldiscount = dis;
    }else{
      var test = +tx + +e + -ds+ -invdis+ + ad;
    }
    $("#grandTotal").val(test.toFixed(2, 2));
     $("#total_discount_ammount").val(totaldiscount.toFixed(2, 2));
 var previous    = $("#previous").val();
 var gt          = $("#grandTotal").val();
   
   var grnt_totals = +gt+ +previous;
   $("#n_total").val(grnt_totals.toFixed(2,2));
   invoice_paidamount();

}

//Invoice Paid Amount
"use strict";
function invoice_paidamount() {
    var d = 0;
    var t = $("#n_total").val(),
        a = $("#paidAmount").val(),
        e = t - a;
        d = a - t;
        if(e > 0){
    $("#dueAmmount").val(e.toFixed(2,2))
}else{
  $("#dueAmmount").val(0)   
   $("#change").val(d.toFixed(2,2))

}
}



"use strict";
function full_paid_invoice() {
    var grandTotal = $("#n_total").val();
    $("#paidAmount").val(grandTotal);
    invoice_paidamount();
    calculateSumInvoice();
}

"use strict";
function invoice_discount(){
   var gt          = $("#n_total").val();
   var invdis      = $("#invdcount").val();
   var grnt_totals = gt-invdis;
   
   $("#total_discount_ammount").val(grnt_totals.toFixed(2,2))
   $("#invtotal").val(grnt_totals.toFixed(2,2))
   $("#dueAmmount").val(grnt_totals.toFixed(2,2))

}

     "use strict";
  function checkqty_invoice(sl)
{

  var quant = $("#total_qntt_"+sl).val();
  var price = $("#price_item_"+sl).val();
  var dis   = $("#discount_"+sl).val();
  if (isNaN(quant))
  {
    alert("must_input_numbers");
    document.getElementById("total_qntt_"+sl).value = '';
    return false;
  }
  if (isNaN(price))
  {
    alert("must_input_numbers");
     document.getElementById("price_item_"+sl).value = '';
    return false;
  }
  if (isNaN(dis))
  {
    alert("must_input_numbers");
     document.getElementById("discount_"+sl).value = '';
    return false;
  }
}


          $(document).ready(function() {
                "use strict";

   var frm = $("#manual_sale_insert");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url      : $(this).attr('action'),
            method   : $(this).attr('method'),
            dataType : 'json',
            data     : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
                    swal({
        title: "Success!",
        showCancelButton: true,
        cancelButtonText: "NO",
        cancelButtonColor: "red",
        confirmButtonText: "Yes",
        confirmButtonColor: "#008000",
        text: "Do You Want To Print ?",
        type: "success",
        
       
      }, function(inputValue) {
          if (inputValue===true) {
      $("#normalinvoice tbody tr").remove();
        
       printRawHtmlInvoice(data.details);
  } else {
       $("#normalinvoice tbody tr").remove();
        setInterval(function(){ location.reload(); }, 1000);
  }
    
      });  
                } else {
                    toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });


    function printRawHtmlInvoice(view) {
      printJS({
        printable: view,
        type: 'raw-html',
        onPrintDialogClose: printJobCompleteInvoice(),
        
      });

      

    }

        function printJobCompleteInvoice() {
        $("#normalinvoice tbody tr").remove();
        setInterval(function(){ location.reload(); }, 1000);

        }


             "use strict";
    $( document ).ready(function() {
     var elements = document.getElementsByClassName('bank_div');
     var ptype = $('#payment_type').val();
    for (var i = 0; i < elements.length; i++){
        if(ptype == 2){
        elements[i].style.display = 'block';
        }else{
         elements[i].style.display = 'none';   
        }
        
    }
    });



   /* pos invoice */
           "use strict";
function detailsmodal(productname,model,unit,price,image,product_id){
    $("#detailsmodal").modal('show');
    var base_url = document.getElementById("base_url").value;
    if(image !=''){
      var image = image;
    }else{
      var image = '/assets/dist/img/products/product.png';
    }
    var stock = document.getElementById("available_quantity_"+product_id).value;
    document.getElementById("modal_productname").innerHTML = productname;
    document.getElementById("modal_productstock").innerHTML = stock;
    document.getElementById("modal_productmodel").innerHTML = model;
    document.getElementById("modal_productunit").innerHTML = unit;
    document.getElementById("modal_productprice").innerHTML = price;
    document.getElementById("modalimg").innerHTML ='<img src="'+base_url+'/' + image + '" alt="image" style="width:100px; height:60px;" />';

}
    "use strict";   
function CustomerList_pos(sl) {
    var base_url    = $('#base_url').val();
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
       var customer_name = $('#customer_name').val();
        $.ajax( {
          url: base_url + "/invoice/search_customer",
          method: 'POST',
          dataType: "json",
          data: {
            customer_name:customer_name,
            app_csrf:CSRF_TOKEN
          },
          success: function( data ) {
            response( data );

          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
        $(this).parent().parent().find("#customer_id").val(ui.item.value); 
        var customer_id          = ui.item.value;
        $(this).unbind("change");
        customer_due(customer_id);
        return false;
       }
   }

   $('body').on('keypress.autocomplete', '#customer_name', function() {
       $(this).autocomplete(options);
   });


}
     function onselectimage(id){
        var product_id = id;
        var exist      = $("#product_id_" + product_id).val();
        var qty        = $("#total_qntt_" + product_id).val();
        var add_qty    = parseInt(qty)+1;;
        var base_url   = $('#base_url').val();
        var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
         if(product_id == exist){
            $("#total_qntt_" + product_id).val(add_qty);
            quantity_calculate_pos(product_id);
            calculateSum_pos();
            invoice_paidamount();
            image_activation(product_id);
            document.getElementById('add_item').value = '';
            document.getElementById('add_item').focus();       
         }else{
            $.ajax({
                type: "post",
                async: false,
                url: base_url + '/invoice/get_posdata',
                data: {product_id: product_id,app_csrf:CSRF_TOKEN},
                success: function (data) {
                    if (data == false) {
                        alert('This Product Not Found !');
                         document.getElementById('add_item').value = '';
                         document.getElementById('add_item').focus();
                           $(".select2").select2();
                         quantity_calculate_pos(product_id);
                         calculateSum_pos();
                         invoice_paidamount();
                    } else {
                        $("#hidden_tr").css("display", "none");
                        document.getElementById('add_item').value = '';
                        document.getElementById('add_item').focus();
                        $('#normalinvoice tbody').append(data);
                        calculateSum_pos();
                        invoice_paidamount();
                        image_select(product_id);
                        $("input[name='product_quantity[]']").TouchSpin({
                        verticalbuttons: true
                           });
                         $(".select2").select2();
                    }
                },
                error: function () {
                    alert('Request Failed, Please check your code and try again!');
                }
            });
        }
    

 }


   "use strict";
function product_stock_pos(sl) {
            var  batch_id          = $('#batch_id_'+sl).val();
            var dataString         = 'batch_id='+ batch_id;
            var product_id         = $('#product_id_'+sl).val();
            var available_quantity = 'available_quantity_'+sl;
            var product_rate       = 'product_rate_'+sl;
            var expire_date        = 'expire_date_'+sl;
            var base_url           = $('#base_url').val();
            var CSRF_TOKEN         = $('[name="csrf_test_name"]').val();
             $.ajax({
                type: "POST",
                url: base_url+"/invoice/get_batch_stock",
                data: {batch_id:batch_id,product_id:product_id,app_csrf:CSRF_TOKEN},
                cache: false,
                success: function(data)
                {
                   var obj = JSON.parse(data);
                   var today = new Date();
                   var dd = today.getDate();
                   var mm = today.getMonth()+1; 
                   var yyyy = today.getFullYear();
                    if(dd<10){
                    var dd='0'+dd;
                    }
                    if(mm<10){
                     var mm='0'+mm;
                    }
                    var today = yyyy+'-'+mm+'-'+dd;

                   var aj  = new Date(today);
                   var exp = new Date(obj.expire_date);
                    if (aj >= exp) {
                     
                     toastr["error"]('Date Expired Please Select another');
                      $('#batch_id_'+sl)[0].selectedIndex = 0;
                      $('#'+expire_date).html('<p style="color:red;align:center">'+obj.expire_date+'</p>');
                       document.getElementById('expire_date_'+sl).innerHTML = '';
                    }else{
                       $('#'+expire_date).html('<p style="color:green;align:center">'+obj.expire_date+'</p>');
                    }


                    $('#'+available_quantity).val(obj.total_product);

                }
             });

            $(this).unbind("change");
            return false;

}


  function image_select(id){
         var qty = $("#total_qntt_" + id).val();
         $("#image-active_"+ id ).addClass("active");
         $("#image-active_count_"+ id ).addClass("quantity");
        var active_product = $("#active_pro_"+id).text(qty); 
       }


    function image_activation(id){
    var batch = $('#batch_id_'+id).val();
if(batch =='Select Batch'){
  var  message ='Please Select Batch';
    toastr["error"](message);
    qty = $("#total_qntt_" + id).val(0);
    return false;
}
         var qty = $("#total_qntt_" + id).val();
         $("#image-active_"+ id ).addClass("active");
         $("#image-active_count_"+ id ).addClass("quantity");
        var active_product = $("#active_pro_"+id).text(qty); 
       }


    function quantity_calculate_pos(item){
    var quantity         = $("#total_qntt_" + item).val();
    var price_item       = $("#price_item_" + item).val();
    var discount         = $("#discount_"+ item).val();
    var invoice_discount = $("#invdcount").val();
    var box              = $("#u_box_"+item).val();
    var box_qty          = quantity/box;
    $("#box_qty_" + item).val(box_qty);
    var total_tax        = $("#total_tax_" + item).val();
    var total_discount   = $("#total_discount_" + item).val();
    var dis_type         = $("#discount_type").val();
    var taxnumber        = $("#txfieldnum").val();

    var batch     = $("#batch_id_" + item).val();
    var available_quantity = $("#available_quantity_" + item).val();


    if (parseInt(quantity) > parseInt(available_quantity)) {
      if(batch == ''){
        var message = "Please Select Batch";
      }else{
         var message = "You can Sale maximum " + available_quantity + " Items";
      }
        
         $("#total_qntt_" + item).val(0);
        var quantity = 0;
          toastr["error"](message);
         //alert(message);
        $("#total_price_" + item).val(0);
        for(var i=0;i<taxnumber;i++){
        $("#all_tax"+i+"_" + item).val(0);  
    }    
    }
        
    if (quantity > 0 || discount > 0) {
        if (dis_type == 1) {
            var price = quantity * price_item;
            var dis   = +(price * discount / 100);
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var temp    = price - dis;
            var ttletax = 0;
            $("#total_price_" + item).val(temp.toFixed(2,2));
            for(var i=0;i<taxnumber;i++){
           var tax = (temp) * $("#total_tax"+i+"_" + item).val();
         
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
           }
        }else if(dis_type == 2){
            var price  = quantity * price_item;
            // Discount cal per product
            var dis   = discount * quantity;
            $("#all_discount_" + item).val(dis);

            //Total price calculate per product
             var temp = price - dis;
            $("#total_price_" + item).val(temp.toFixed(2,2));

            var ttletax = 0;
             for(var i=0;i<taxnumber;i++){
           var tax = (temp) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }

        }else if(dis_type == 3){
             var total_price = quantity * price_item;
             var dis =  discount;
            // Discount cal per product
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var price = total_price - dis;
            $("#total_price_" + item).val(price.toFixed(2,2));

             var ttletax = 0;
             for(var i=0;i<taxnumber;i++){
           var tax = (price) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }
        }
    }else {
        var n = quantity * price_item;
        var c = quantity * price_item * total_tax;
        $("#total_price_" + item).val(n), 
        $("#all_tax_" + item).val(c)
    }

     calculateSum_pos();
    }



    function check_category(category){
        var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
        var base_url   = $('#base_url').val();
        var myurl= base_url + '/invoice/get_item_by_category';
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {category_id:category,app_csrf:CSRF_TOKEN},
            success: function(data) {
                if (data == '420') {
                    $("#product_search").html(data);
                }else{
                    $("#product_search").html(data); 
                }
               
            },
            error: function() {
                alert('Request Failed, Please check your code and try again!');
            }
        });
    } 

    "use strict";
 $('body').on('keyup', '#product_name', function() {
        var CSRF_TOKEN    = $('[name="csrf_test_name"]').val();
        var product_name  = $(this).val();
        var base_url      = $('#base_url').val();
        var myurl         = base_url + '/invoice/get_medicine_by_name';
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,app_csrf:CSRF_TOKEN},
            success: function(data) {
                if (data == '420') {
                    $("#product_search").html('<h1 class"srcalrt">Product not found !</h1>');
                }else{
                    $("#product_search").html(data); 
                }
            },
            error: function() {
                alert('Request Failed, Please check your code and try again!');
            }
        });
    });


"use strict";
function calculateSum_pos() {
document.getElementById("change").value = '';
  var taxnumber = $("#txfieldnum").val();

    var t = 0,
        a = 0,
        e = 0,
        o = 0,
        f = 0,
        p = 0,
        ad = 0,
        tx = 0,
        ds = 0,
     invdis =  $("#invdcount").val();
    //Total Tax
      for(var i=0;i<taxnumber;i++){
      
var j = 0;
    $(".total_tax"+i).each(function () {
        isNaN(this.value) || 0 == this.value.length || (j += parseFloat(this.value))
    });
            $("#total_tax_amount"+i).val(j.toFixed(2, 2));
             
    }
    //Total Discount
    $(".total_discount").each(function() {
        isNaN(this.value) || 0 == this.value.length || (p += parseFloat(this.value))
    }), 
    
    $("#total_discount_ammount").val(p.toFixed(2,2)), 
    $("#total_product_dis").val(p),
     $(".totalTax").each(function () {
        isNaN(this.value) || 0 == this.value.length || (f += parseFloat(this.value))
    }),
            $("#total_tax_amount").val(f.toFixed(2, 2)),

    //Total Price
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
    }),
     $(".dppr").each(function () {
        isNaN(this.value) || 0 == this.value.length || (ad += parseFloat(this.value))
    }), 

    o  = a.toFixed(2,2), 
    e  = t.toFixed(2,2),
    tx = f.toFixed(2, 2),
    ds = p.toFixed(2, 2);

    var test = +tx + +e + -ds+ -invdis+ + ad;
    var dis = $("#total_product_dis").val();
    var totaldiscount = +dis + +invdis;
    var total =  parseFloat(t);
           if(totaldiscount > total){
    var message = 'Discount Can not Greater than Total Amount';
         toastr["error"](message);
         $("#invdcount").val(0);
         var test = +tx + +e + -ds+  +ad;
          var totaldiscount = dis;
    }else{
      var test = +tx + +e + -ds+ -invdis+ + ad;
    }
    $("#grandTotal").val(test.toFixed(2, 2));
    $("#total_discount_ammount").val(totaldiscount.toFixed(2, 2));
    var previous    = $("#previous").val();
    var gt          = $("#grandTotal").val();
   
   var grnt_totals = +gt+ +previous;
   $("#n_total").val(grnt_totals.toFixed(2,2));
   $("#net_total_text").text(grnt_totals.toFixed(2, 2)); 
   invoice_paidamount();

}

function checkqty(id){

}

"use strict";
function invoice_paidamount() {
    var d = 0;
    var b = 0;
    var t = $("#n_total").val(),
        a = $("#paidAmount").val(),
        e = t - a,
        d = a - t;
        if(e > 0){
        $("#dueAmmount").val(e.toFixed(2,2));
        $("#due_text").text(e.toFixed(2,2));
        $("#due_amount").val(e.toFixed(2,2));
        $("#change").val(b.toFixed(2,2));
       }else{
        $("#dueAmmount").val(0);
        $("#due_text").text(b.toFixed(2,2));
         $("#due_amount").val(0);   
        $("#change").val(d.toFixed(2,2));

      }
      }


"use strict";
function full_paid() {
    var grandTotal = $("#n_total").val();
    $("#paidAmount").val(grandTotal);
    invoice_paidamount();
    calculateSum_pos();
}

"use strict";
function deleteRow(t,product_id) {
    var a = $("#normalinvoice > tbody > tr").length;
    if (1 == a) alert("There only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e), 
        image_inaactivation(product_id);
        calculateSum_pos();
        invoice_paidamount();
    }
}

     "use strict";
    function customer_due(id){
   var base_url = $("#base_url").val();
   var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
        $.ajax({
            url: base_url + '/invoice/customer_previous',
            type: 'post',
            data: {customer_id:id,app_csrf:CSRF_TOKEN}, 
            success: function (msg){
               
                $("#previous").val(msg);
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        });        
    }
    function image_inaactivation(id){
        var qty = $("#total_qntt_" + id).val();
        $("#image-active_"+ id ).removeClass("active");
        $("#image-active_count_"+ id ).removeClass("quantity");
        var active_product = $("#active_pro_"+id).text(''); 
       }


   $(document).ready(function () {
    "use strict";
        $("input[name='product_quantity']").TouchSpin({
        verticalbuttons: true
    });
    });



 $(function($){
    var barcodeScannerTimer;
    var barcodeString = '';

$('#add_item').on('keypress', function (e) {
    barcodeString = barcodeString + String.fromCharCode(e.charCode);

    clearTimeout(barcodeScannerTimer);
    barcodeScannerTimer = setTimeout(function () {
        processbarcodeGui();
    }, 300);
});


 function processbarcodeGui() {
    if (barcodeString != '') {  
        var product_id = barcodeString;
        var exist      = $("#product_id_" + product_id).val();
        var qty        = $("#total_qntt_" + product_id).val();
        var add_qty    = parseInt(qty)+1;;
        var base_url   = $('#base_url').val();
        var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
        if(product_id == exist){
          $("#total_qntt_" + product_id).val(add_qty);
          image_activation(product_id);
          quantity_calculate_pos(product_id);
          calculateSum_pos();
          invoice_paidamount();
          document.getElementById('add_item').value = '';
          document.getElementById('add_item').focus();       
         }else{
            $.ajax({
                type: "post",
                async: false,
                url: base_url + '/invoice/get_posdata',
                data: {product_id: product_id,app_csrf:CSRF_TOKEN},
                success: function (data) {
                    if (data == false) {
                        alert('This Product Not Found !');
                        document.getElementById('add_item').value = '';
                        document.getElementById('add_item').focus();
                        quantity_calculate_pos();
                         calculateSum_pos(barcodeString);
                        invoice_paidamount();
                    } else {
                        $("#hidden_tr").css("display", "none");
                        document.getElementById('add_item').value = '';
                        document.getElementById('add_item').focus();
                        $('#normalinvoice tbody').append(data);
                          $("input[name='product_quantity[]']").TouchSpin({
                        verticalbuttons: true
                           });
                        image_select(product_id);
                        calculateSum_pos();
                        invoice_paidamount();
                    }
                },
                error: function () {
                    alert('Request Failed, Please check your code and try again!');
                }
            });
        }
    } else {
        alert('barcode is invalid: ' + barcodeString);
    }

    barcodeString = ''; 
}
});

   $(function($){
        var barcodeScannerTimer;
        var barcodeString = '';
        $('#add_item_m').keydown(function (e) {
        if (e.keyCode == 13) {
        var product_id = $(this).val();
        var exist      = $("#product_id_" + product_id).val();
        var qty        = $("#total_qntt_" + product_id).val();
        var add_qty    = parseInt(qty)+1;
        var base_url   = $('#base_url').val();
        var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
         if(product_id == exist){
            $("#total_qntt_" + product_id).val(add_qty);
            image_activation(product_id);
          quantity_calculate_pos(product_id);
          calculateSum_pos();
          invoice_paidamount();
           document.getElementById('add_item_m').value = '';
           document.getElementById('add_item_m').focus();       
         }else{
            $.ajax({
                type: "post",
                async: false,
                url: base_url + '/invoice/get_posdata',
                data: {product_id: product_id,app_csrf:CSRF_TOKEN},
                success: function (r) {
                   
                        $("#hidden_tr").css("display", "none");
                        document.getElementById('add_item_m').value = '';
                        document.getElementById('add_item_m').focus();
                        $('#normalinvoice tbody').append(r);
                          $("input[name='product_quantity[]']").TouchSpin({
                        verticalbuttons: true
                           });
                        image_select(product_id);
                        calculateSum_pos();
                        invoice_paidamount();
                   
                },
                error: function () {
                    alert('Request Failed, Please check your code and try again!');
                }
            });
        }
        }
    });
          });


          $(document).ready(function() {
                "use strict";

   var frm = $("#pos_sale_insert");
    frm.on('submit', function(e) {

        var tr = $("#normalinvoice > tbody > tr").length;
        var medicine_select = 'Please Select Medicine';

        if(tr == 0){
      toastr["error"](medicine_select);
        return false;    
        }
  
        e.preventDefault(); 
        $.ajax({
            url : $(this).attr('action'),
            method : $(this).attr('method'),
            dataType : 'json',
            data : frm.serialize(),
            success: function(data) 
            {
        if (data.status == true) {
           toastr["success"](data.message);
            $(".quantity").removeClass("quantity");
            $(".product-panel").removeClass("active");
            $(".active_qty").text('');
                    swal({
        title: "Success!",
        showCancelButton: true,
        cancelButtonText: "NO",
        cancelButtonColor: "red",
        confirmButtonText: "Yes",
        confirmButtonColor: "#008000",
        text: "Do You Want To Print ?",
        type: "success",
        
       
      }, function(inputValue) {
          if (inputValue===true) {
      $("#normalinvoice tbody tr").remove();
        $('#gui_sale_insert').trigger("reset");
        $("#n_total").val('');
        $("#net_total_text").text('0.00'); 
        $("#dueAmmount").val('') ;
        $("#due_text").text('0.00');
       
       printRawHtml_pos(data.details);
  } else {
     location.reload();
    
       $("#normalinvoice tbody tr").remove();
        $('#pos_sale_insert').trigger("reset");
        $("#n_total").val('');
        $("#net_total_text").text('0.00'); 
        $("#dueAmmount").val('') ;
        $("#due_text").text('0.00');     
  }
    
      });  
                } else {
                    toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });


    function printRawHtml_pos(view) {
      printJS({
        printable: view,
        type: 'raw-html',
        onPrintDialogClose: printJobComplete_pos(),
        
      });

      

    }

        function printJobComplete_pos() {
        $("#normalinvoice tbody tr").remove();
        $('#pos_sale_insert').trigger("reset");

        }


        $(document).ready(function() {
        "use strict";
       $("#newcustomer").submit(function(e){
        e.preventDefault();
        var customer_id      = $("#customer_id");
        var customer_name    = $("#customer_name");
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function()
            {
                // customeMessage.removeClass('hide');
               
            },
            success: function(data)
            {
                if (data.status == true) {
                    toastr["success"](data.message);
                    customer_id.val(data.customer_id);
                    customer_name.val(data.customer_name);
                     $("#cust_info").modal('hide');
                } else {
                    toastr["error"](data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }

        });

    });
 });


  function bankpayment(id){
     $("#bank_id").val(id);
     $("#payment_type").val(2);
  }  

  function bankpayment_submit(){
     var bank_id = $("#bank_id").val();
     if(bank_id ==''){
        toastr["error"]('Please Select Bank');
        return false;
     }else{
         $('#bank_info_div').modal('hide');
        $('#pos_sale_insert').trigger('submit');

     }
  } 


/*purchase part*/
    "use strict";
    function add_purchaseRow(divName){
            var optionval = $("#leaf_type_dropdown").val();
            var row       = $("#purchaseTable tbody tr").length;
            var count     = row + 1;
            var newdiv    = document.createElement('tr');
            var tabin     = "product_name_"+count,
             tabindex = count * 7,
           newdiv = document.createElement("tr"),
            tab1 = tabindex + 1,
            tab2 = tabindex + 2,
            tab3 = tabindex + 3,
            tab4 = tabindex + 4,
            tab5 = tabindex + 5,
            tab6 = tabindex + 6,
            tab7 = tabindex + 7,
            tab8 = tabindex + 8,
            tab9 = tab8 + 1,
            tab10 = tab9 + 1,
            tab11 = tab10 + 1,
            tab12 = tab11 + 1,
            tab13 = tab12 + 1,
            tab14 = tab13 + 1;
            newdiv.innerHTML ='<td class="span3 manufacturer"><input type="text" name="product_name"  class="form-control product_name productSelection" onkeypress="product_list_purchase('+ count +')" placeholder="Medicine Name" id="product_name_'+ count +'" tabindex="'+tab1+'" required> <input type="hidden" class="autocomplete_hidden_value product_id_'+ count +'" name="product_id[]" id="SchoolHiddenId"/>  <input type="hidden" class="sl" value="'+ count +'">  </td> <td> <input type="text"  name="batch_id[]" id="batch_id_'+ count +'" tabindex="'+tab2+'" class="form-control text-right"  tabindex="11" placeholder="Batch Id" /></td><td><input type="text" name="expeire_date[]" onchange="checkExpiredate('+ count +')" id="expeire_date_'+ count +'"  class="form-control datepicker" tabindex="'+tab3+'" required  placeholder="Expire Date"/> </td>  <td class="wt"> <input type="text" id="available_quantity_'+ count +'" class="form-control text-right stock_ctn_'+ count +'" placeholder="0.00" readonly/> </td><td><select name="leaf_type[]" class="form-control select2" id="leaf_type_'+ count +'" onchange="purchase_calculation('+ count +'),checkqty('+ count +')" required  tabindex="'+tab4+'"></select></td> <td class="text-right"><input type="text" name="box_quantity[]" id="box_quantity_'+ count +'" class="form-control text-right valid_number" onkeyup="purchase_calculation('+ count +'),checkqty(' + count +')" onchange="purchase_calculation('+ count +')" placeholder="0.00" value="" min="0"  required="required" tabindex="'+tab5+'"/></td><td class="text-right"><input type="text" name="product_quantity[]"  required  id="quantity_'+ count +'" class="form-control text-right store_cal_' + count + '" onkeyup="purchase_calculation(' + count + '),checkqty(' + count + ');" onchange="purchase_calculation(' + count + ')" placeholder="0.00" value="" min="0" readonly/> <input type="hidden" name="unit_qty[]" id="unit_qty_' + count + '">  </td><td class="test"><input type="text" name="product_rate[]"  required onkeyup="purchase_calculation('+ count +'),checkqty(' + count + ');" onchange="purchase_calculation('+ count +');" id="product_rate_'+ count +'" class="form-control product_rate_'+ count +' text-right valid_number" placeholder="0.00" value="" min="0" tabindex="'+tab6+'"/></td><td><input type="text" class="form-control valid_number" name="mrp[]" required id="mrp_'+ count +'" tabindex="'+tab7+'"></td><td class="text-right"><input class="form-control total_price text-right total_price_'+ count +'" type="text" name="total_price[]" id="total_price_'+ count +'" value="0.00" readonly="readonly" /> </td><td> <input type="hidden" id="total_discount_1" class="" /><input type="hidden" id="all_discount_1" class="total_discount" /><button type="button" class="btn btn-danger-soft" tabindex="'+tab8+'" onclick="deleteRow(this)"><i class="far fa-trash-alt"></i></button></td>';
            document.getElementById(divName).appendChild(newdiv);
            document.getElementById(tabin).focus();
             $("#leaf_type_"+count).html(optionval);
             $(".select2").select2();
             document.getElementById("add_invoice_item").setAttribute("tabindex", tab9);
             document.getElementById("vat").setAttribute("tabindex", tab10);
             document.getElementById("discount").setAttribute("tabindex", tab11);
             document.getElementById("full_paid_purchase_tab").setAttribute("tabindex", tab12);
             document.getElementById("paid_amount").setAttribute("tabindex", tab13);
             document.getElementById("save_purchase").setAttribute("tabindex", tab14);
            count++;
 $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
    }
    

        function deleteRow(e) {
        var t = $("#purchaseTable > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
      
    }



function disoucnt_calculation() {
    var gr_tot = 0;
    var total =  parseFloat($("#sub_total").val());
    $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

    var vat = $("#vat").val();
    if(vat > 0){
      var vat = vat;
    }else{
      vat  = 0;
    }
    var t = $("#discount").val();
    if(t > total){
    var message = 'Discount Can not Greater than Total Amount';
         toastr["error"](message);
         $("#discount").val(0);  
    var net_total = +gr_tot+ +vat;
    }else{
    var net_total = +gr_tot+ +vat+ -t;
    }
   
    $("#grandTotal").val(net_total);
}

    function purchase_vatcalculation(){
     var vat = $('#vat').val();
      var discount = $('#discount').val();
      var total =  parseFloat($("#sub_total").val());
     if(discount > 0){
      var discount = discount;
     }else{
      var discount = 0;
     }
     if(vat > 0){
      var vat = vat;
     }else{
      var vat = 0;
     }
     var nt       = $("#sub_total").val();
     if(vat > total){
     var message = 'VAT Can not Greater than Total Amount';
         toastr["error"](message); 
      $('#vat').val(0);
    var ntotal   =  +nt+ -discount;
     }else{
    var ntotal   =  +nt+ +vat+ -discount;
     }
     
    $("#grandTotal").val(ntotal.toFixed(2,2));
    
    paid_calculation();
  }

function paid_calculation() {
    var paid_amount = $("#paid_amount").val();
    var gr_total    = $("#grandTotal").val(); 
    var net_total   = parseFloat(gr_total) - paid_amount;
    $("#due_amount").val(net_total);
    disoucnt_calculation();
}


    "use strict";   
function product_list_purchase(sl) {
     var CSRF_TOKEN      = $('[name="csrf_test_name"]').val();
     var manufacturer_id = $('#manufacturer_id').val();
     var base_url        = $('#base_url').val();
    if ( manufacturer_id == 0) {
        
        toastr["error"]('Please Select manufacturer !');
        return false;
    }
    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
            var product_name = $('#product_name_'+sl).val();
        $.ajax( {
          url: base_url + "/purchase/product_search_bymanufacturer",
          method: 'POST',
          dataType: "json",
          data: {
            term: request.term,
            manufacturer_id:manufacturer_id,
            product_name:product_name,
            app_csrf:CSRF_TOKEN
          },
          success: function( data ) {
           
            response( data );

          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
            var sl = $(this).parent().parent().find(".sl").val(); 

            var product_id        = ui.item.value;
            var  manufacturer_id  = $('#manufacturer_id').val();
            var base_url          = $('#base_url').val();
            var  uqty             = 'unit_qty_'+sl;
            var available_quantity= 'available_quantity_'+sl;
            var product_rate      = 'product_rate_'+sl;
            var mrp               = 'mrp_'+sl;
           
         
         
            $.ajax({
                type: "POST",
                url: base_url+"/purchase/product_details_by_id",
                 data: {product_id:product_id,manufacturer_id:manufacturer_id,app_csrf:CSRF_TOKEN},
                cache: false,
                success: function(data)
                {
                   
                   var obj = JSON.parse(data);
                    $('#'+available_quantity).val(obj.total_product);
                    $('#'+product_rate).val(obj.manufacturer_price);
                    $('#'+uqty).val(obj.box_qty);
                    $('#'+mrp).val(obj.mrp);
                  
                } 
            });

            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keypress.autocomplete', '.product_name', function() {
       $(this).autocomplete(options);
   });


}


    "use strict";
    function purchase_calculation(sl) {
       
        var gr_tot      = 0;
        var unit_qty    = $("#unit_qty_"+sl).val();
        var box         = $("#box_quantity_"+sl).val();
        var b_p         = $("#leaf_type_"+sl).val();
        var total_unit  = b_p * box;
        $("#quantity_"+sl).val(total_unit);
        var item_ctn_qty = $("#box_quantity_"+sl).val();
        var vendor_rate  = $("#product_rate_"+sl).val();

        var total_price  = item_ctn_qty * vendor_rate;
        $("#total_price_"+sl).val(total_price.toFixed(2));

       
        //Total Price
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });
        $("#sub_total").val(gr_tot.toFixed(2,2));
        $("#grandTotal").val(gr_tot.toFixed(2,2));
        purchase_vatcalculation();
    

    }

      "use strict";
      function checkExpiredate(sl) {
        var purdates     =  $("#purdate").val();
        var expiredate   = $("#expeire_date_"+sl).val();
        var purchasedate = new Date(purdates);
        var expirydate   = new Date(expiredate);
        if (expirydate <= purchasedate ) { 
            toastr["error"]('Expiry Date Should Be Greater than Purchase Date');
          document.getElementById("expeire_date_"+sl).value = '';
            return false;
        }
        return true;
    }


/*report part start*/

      $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#categorywiseSalereport').DataTable({ 
             responsive: true,
            dom: "<'row '<'col-md-6' B><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/report/getcategorywise_sales_reportList',
            "data": function ( data) {
           data.fromdate       = $('#from_date').val();
           data.todate         = $('#to_date').val();
           data.category_id    = $('#category_id').val();
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'date'},
             { data: 'product_name'},
             { data: 'invoice'},
             { data: 'customer_name' },
             { data: 'quantity',class:"total_qty text-right"},
             { data: 'rate'},
             { data: 'discount',class:"total text-right"},
             { data: 'total',class:"total text-right"},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_qty', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });

     api.columns('.total', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});

  /*Cash Calculator*/
    "use strict";
 function cashCalculator() {
         var mul0 = $('.text_0').val();
        var text_0_bal = mul0 * 2000;
        $('.text_0_bal').val(text_0_bal);

        var mul1 = $('.text_1').val();
        var text_1_bal = mul1 * 1000;
        $('.text_1_bal').val(text_1_bal);

        var mul2 = $('.text_2').val();
        var text_2_bal = mul2 * 500;
        $('.text_2_bal').val(text_2_bal);

        var mul3 = $('.text_3').val();
        var text_3_bal = mul3 * 100;
        $('.text_3_bal').val(text_3_bal);

        var mul200 = $('.text_200').val();
        var text_200_bal = mul200 * 200;
        $('.text_200_bal').val(text_200_bal);

        var mul4 = $('.text_4').val();
        var text_4_bal = mul4 * 50;
        $('.text_4_bal').val(text_4_bal);

        var mul5 = $('.text_5').val();
        var text_5_bal = mul5 * 20;
        $('.text_5_bal').val(text_5_bal);

        var mul6 = $('.text_6').val();
        var text_6_bal = mul6 * 10;
        $('.text_6_bal').val(text_6_bal);

        var mul7 = $('.text_7').val();
        var text_7_bal = mul7 * 5;
        $('.text_7_bal').val(text_7_bal);

        var mul8 = $('.text_8').val();
        var text_8_bal = mul8 * 2;
        $('.text_8_bal').val(text_8_bal);

        var mul9 = $('.text_9').val();
        var text_9_bal = mul9 * 1;
        $('.text_9_bal').val(text_9_bal);


        var total_money = (text_0_bal + text_1_bal + text_2_bal + text_3_bal  + text_4_bal + text_5_bal + text_6_bal + text_7_bal + text_8_bal + text_9_bal + text_200_bal);

        $('.total_money').val(total_money);
    }



    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#ClosingList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 2, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,3,4,5,6] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Closing List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Closing List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Closing List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Closing List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/report/getclosing_data',
            "data": function ( data) {
            data.fromdate = $('#from_date').val();
           data.todate = $('#to_date').val();
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'last_day_closing'},
             { data: 'date'},
             { data: 'cash_in'},
             { data: 'cash_out'},
             { data: 'amount' },
             { data: 'close_by'},
          ],


    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


  $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#productWiseSalesreport').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/report/getproductwise_sales_reportList',
            "data": function ( data) {
           data.fromdate       = $('#from_date').val();
           data.todate         = $('#to_date').val();
           data.product_id     = $('#product_id').val();
           data.app_csrf       = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'date'},
             { data: 'product_name'},
             { data: 'invoice'},
             { data: 'customer_name' },
             { data: 'quantity',class:"total_qty text-right"},
             { data: 'rate'},
             { data: 'discount',class:"total text-right"},
             { data: 'total',class:"total text-right"},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_qty', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });

     api.columns('.total', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});

 $(document).ready(function() { 
      "use strict";
   var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
   var currency    = $("#currency").val();
   var base_url    = $('#base_url').val();
   var mydatatable = $('#purchaseReport').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 4, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,5,6,] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[ 25, 50,100,250,500, -1], [25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/report/getpurchase_reportList',
            "data": function ( data) {
            data.fromdate  = $('#from_date').val();
           data.todate     = $('#to_date').val();
           data.app_csrf   = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'chalan_no'},
             { data: 'purchase_id'},
             { data: 'manufacturer_name'},
             { data: 'purchase_date' },
             { data: 'total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'purchase_by'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


  $(document).ready(function() { 
      "use strict";
   var CSRF_TOKEN  =  $('[name="csrf_test_name"]').val();
   var currency    = $("#currency").val();
   var base_url    = $('#base_url').val();
   var mydatatable = $('#purchaseReportCategorywise').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 4, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,5,6,7,8,9] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[ 25, 50,100,250,500, -1], [25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/report/get_categorywise_purchaselist',
            "data": function ( data) {
            data.fromdate = $('#from_date').val();
           data.todate = $('#to_date').val();
           data.category_id = $('#category_id').val();
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'category_name'},
             { data: 'product_name'},
             { data: 'manufacturer_name'},
             { data: 'purchase_date' },
             { data: 'quantity',class:"total_sale text-right"},
             { data: 'rate'},
             { data: 'discount'},
             { data: 'total',render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'purchase_by'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});

 $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#Salesreport').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 4, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,5,6,] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/report/getsales_reportList',
            "data": function ( data) {
            data.fromdate = $('#from_date').val();
           data.todate    = $('#to_date').val();
           data.app_csrf  = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'invoice_no'},
             { data: 'invoice_id'},
             { data: 'customer_name'},
             { data: 'date' },
             { data: 'total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'sales_by'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


 $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#userWiseSalesreport').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 4, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,5,6,] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/report/getuserwise_sales_reportList',
            "data": function ( data) {
           data.fromdate = $('#from_date').val();
           data.todate   = $('#to_date').val();
           data.user_id  = $('#user_id').val();
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'invoice_no'},
             { data: 'invoice_id'},
             { data: 'customer_name'},
             { data: 'date' },
             { data: 'total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'sales_by'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


/*medicine part*/
 $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#MedicineList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9,10] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title: " Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3, 4,5,6,7,8] 
                           },
                        title: "Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3, 4,5,6,7,8] 
                           },
                         title: "Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3, 4,5,6,7,8] 
                           },
                         title: "Medicine List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/medicine/medicine_checkdata',
            "data": function (data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'product_name' },
             { data: 'generic_name' },
             { data: 'product_category'},
             { data: 'manufacturer_name' },
             { data: 'product_location' },
             { data: 'price', render: $.fn.dataTable.render.number( ',', '.', 2, currency )  },
             { data: 'purchase_p',render: $.fn.dataTable.render.number( ',', '.', 2, currency )},
             { data: 'strength'},
             { data: 'image'},
             { data: 'button'},
          ],

    });

});


/*return part start*/

    //Quantity calculat
        "use strict";
    function quantity_calculate_invoicereturn(item) {
         var a = 0,o = 0,d = 0,p = 0;
        var sold_qty   = $("#sold_qty_" + item).val();
        var quantity   = $("#total_qntt_" + item).val();
        var price_item = $("#price_item_" + item).val();
        var discount   = $("#discount_" + item).val();
        if(parseInt(sold_qty) < parseInt(quantity)){
            alert("Sold quantity less than quantity!");
            $("#total_qntt_"+item).val("");
        }
        if (parseInt(quantity) > 0) {
            var price = (quantity * price_item);
            var dis = price * (discount / 100);
            $("#all_discount_" + item).val(dis);
            var ttldis = $("#all_discount_" + item).val();

            //Total price calculate per product
            var temp = price - ttldis;
            $("#total_price_" + item).val(temp);//

            $(".total_price").each(function () {
                isNaN(this.value) || o == this.value.length || (a += parseFloat(this.value));
            }),
                    $("#grandTotal").val(a.toFixed(2, 2));

                  $(".total_discount").each(function () {
                isNaN(this.value) || p == this.value.length || (d += parseFloat(this.value));
            }),
                    $("#total_discount_ammount").val(d.toFixed(2, 2));
        }

    }



      $(document).ready(function () {
            "use strict";
        $('input[type=checkbox]').each(function () {
            if (this.nextSibling.nodeName != 'label') {
                $(this).after('<label for="' + this.id + '"></label>')
            }
        })



    })



            "use strict";
        function quantity_calculate_invoicereturnSreturn(item) {
         var a = 0,o = 0 , d = 0,p = 0;
        var sold_qty   = $("#sold_qty_" + item).val();
        var quantity   = $("#total_qntt_" + item).val();
        var price_item = $("#price_item_" + item).val();
        var discount   = $("#discount_" + item).val();
        if(parseInt(sold_qty) < parseInt(quantity)){
            alert("Purchase quantity less than quantity!");
            $("#total_qntt_"+item).val("");
        }
        if (parseInt(quantity) > 0) {
            var price = (quantity * price_item);
            var dis = price * (discount / 100);
            $("#all_discount_" + item).val(dis);

            //Total price calculate per product
            var temp = price - dis;
            $("#total_price_" + item).val(temp.toFixed(2, 2));

            $(".total_price").each(function () {
                isNaN(this.value) || o == this.value.length || (a += parseFloat(this.value));
            }),
            $("#grandTotal").val(a.toFixed(2, 2));
            $(".total_discount").each(function () {
                isNaN(this.value) || p == this.value.length || (d += parseFloat(this.value));
            }),
                    $("#total_discount_ammount").val(d.toFixed(2, 2));     
        }

    }



        //Quantity calculat
        "use strict";
    function quantity_calculate_mreturn(item) {
        var a = 0,o = 0,d = 0,p = 0;
        var sold_qty   = $("#sold_qty_" + item).val();
        var quantity   = $("#total_qntt_" + item).val();
        var price_item = $("#price_item_" + item).val();
        var discount   = $("#discount_" + item).val();
        if(parseInt(sold_qty) < parseInt(quantity)){
            alert("You can not return more than sold/stock Quantity!");
            $("#total_qntt_"+item).val("");
        }
        if (parseInt(quantity) > 0) {
            var price = (quantity * price_item);
            var dis = price * (discount / 100);
            $("#all_discount_" + item).val(dis);
            var ttldis = $("#all_discount_" + item).val();

            //Total price calculate per product
            var temp = price - ttldis;
            $("#total_price_" + item).val(temp.toFixed(2, 2));//

            $(".total_price").each(function () {
                isNaN(this.value) || o == this.value.length || (a += parseFloat(this.value));
            }),
                    $("#grandTotal").val(a.toFixed(2, 2));

                  $(".total_discount").each(function () {
                isNaN(this.value) || p == this.value.length || (d += parseFloat(this.value));
            }),
                    $("#total_discount_ammount").val(d.toFixed(2, 2));
        }

    }

   function checkrequird_mreturn(sl) {
   var  quantity=$('#total_qntt_'+sl).val();
   var check_id    ='check_id_'+sl;
    if (quantity > 0){

    document.getElementById(check_id).setAttribute("required","required");
    }else{
        document.getElementById(check_id).removeAttribute("required");
    }
}



function checkqty_mreturn(sl)
{
  var sold_qty = $('#sold_qty_'+sl).val();
  var quant=$('#total_qntt_'+sl).val();
  if (isNaN(quant))
  {
    alert("Must Input Number");
    document.getElementById("total_qntt_"+sl).value = '';
    return false;
  }
  if (parseInt(quant) < 1)
  {
    alert(":You can not return less than 1");
     document.getElementById("total_qntt_"+sl).value = '';
    return false;
  }
  if (parseInt(quant) > parseInt(sold_qty))
  {
       setTimeout(function(){
    alert("You can not return more than sold/available qty");
    document.getElementById("total_price_"+sl).value = '';
    document.getElementById("discount_"+sl).value = '';
    document.getElementById("total_qntt_"+sl).value = '';
       }, 500);
    return false;
  }




}




      $(document).ready(function() { 
      "use strict";
     var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
     var currency    = $("#currency").val();
     var base_url    = $('#base_url').val();
     var mydatatable = $('#InvoiceReturn').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 3, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,4,5] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice Return List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/return/checkinvoice_returnlist',
            "data": function ( data) {
            data.fromdate = $('#from_date').val();
           data.todate = $('#to_date').val();
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'invoice_id'},
             { data: 'customer_name'},
             { data: 'date_return' },
             { data: 'net_total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


          $(document).ready(function() { 
      "use strict";
     var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
     var currency    = $("#currency").val();
     var base_url    = $('#base_url').val();
     var mydatatable = $('#WastageReturn').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 5, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,4,6,7] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5,6] 
                           },
                        title: "Invoice Return List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/return/checkwastage_returnlist',
            "data": function ( data) {
            data.fromdate = $('#from_date').val();
           data.todate = $('#to_date').val();
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'invoice_id'},
             { data: 'purchase_id'},
             { data: 'customer_name'},
             { data: 'manufacturer_name'},
             { data: 'date_return' },
             { data: 'net_total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


$(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#ManufacturerReturnlist').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 3, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,4,5] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Manufacturer Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Manufacturer Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Manufacturer Return List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Manufacturer Return List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/return/checkmanufacturer_returnlist',
            "data": function ( data) {
            data.fromdate = $('#from_date').val();
           data.todate = $('#to_date').val();
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'purchase_id'},
             { data: 'manufacturer_name'},
             { data: 'date_return' },
             { data: 'net_total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


 
    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#ServiceInvoice').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 4, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,5,6,] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/service/check_invoicelist',
            "data": function ( data) {
            data.fromdate = $('#from_date').val();
           data.todate = $('#to_date').val();
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'invoice_no'},
             { data: 'pay_type'},
             { data: 'customer_name'},
             { data: 'date' },
             { data: 'total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});



    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#StockListBatchwise').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[25, 50,100,250,500, -1], [25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/stock/stock_checkdata_batchwise',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'product_name' },
             { data: 'strength' },
             { data: 'batch_id'},
             { data: 'expeire_date' },
             { data: 'inqty' ,class:"text-right"},
             { data: 'outqty' ,class:"text-right"},
             { data: 'stock' ,class:"text-right"},
             { data: 'stock_box' ,class:"text-right",render: $.fn.dataTable.render.number( ',', '.', 2) },
            

          ],



    });

});



  $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#StockList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9,10] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[25, 50,100,250,500, -1], [25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/stock/stock_checkdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'product_name' },
             { data: 'manufacturer_name' },
             { data: 'sales_price' ,class:"text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'purchase_p' ,class:"text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'totalPurchaseQnty' },
             { data: 'totalSalesQnty' },
             { data: 'stok_quantity',class:"stock" },
             { data: 'stock_box',render: $.fn.dataTable.render.number( ',', '.', 2) },
             { data: 'total_sale_price',class:"total_sale text-right" ,render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'purchase_total' ,class:"total_purchase text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },

          ],

 "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
  api.columns('.stock', {
    page: 'current'
  }).every(function() {

    var sum =this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(sum.toLocaleString());
  });

   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });

     api.columns('.total_purchase', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

});

/*Available stock list*/
    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var mydatatable = $('#Available_stock').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9,10] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[25, 50,100,250,500, -1], [25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/stock/check_available_stock',
            "data": function ( data) {
           data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'product_name' },
             { data: 'manufacturer_name' },
             { data: 'sales_price' ,class:"text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'purchase_p' ,class:"text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'totalPurchaseQnty' ,class:"text-right"},
             { data: 'totalSalesQnty',class:"text-right" },
             { data: 'stok_quantity',class:"stock text-right" },
             { data: 'stock_box',class:"stock text-right",render: $.fn.dataTable.render.number( ',', '.', 2) },
             { data: 'total_sale_price',class:"total_sale text-right" ,render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'purchase_total' ,class:"total_purchase text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },

          ],

 "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
  api.columns('.stock', {
    page: 'current'
  }).every(function() {

    var sum =this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(sum.toLocaleString());
  });

   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });

     api.columns('.total_purchase', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });




  $('#basecolor').on('change', function() {
      $('#basecolor_hexcolor').val(this.value);
  });
  
  $('#menubg_color').on('change', function() {
      $('#menubg_color_hexcolor').val(this.value);
  });

  $('#menu_hover_color').on('change', function() {
      $('#menu_hover_color_hexcolor').val(this.value);
  });

  $('#menu_font_color').on('change', function() {
  $('#menu_font_color_hexcolor').val(this.value);
  });

  $('#active_menu_color').on('change', function() {
  $('#active_menu_color_hexcolor').val(this.value);
  });

  $('#active_menu_bgcolor').on('change', function() {
  $('#active_menu_bgcolor_hexcolor').val(this.value);
  });

   $('#content_text_color').on('change', function() {
  $('#content_text_color_hexcolor').val(this.value);
  }); 

  $('#logo_text_color').on('change', function() {
  $('#logo_text_color_hexcolor').val(this.value);
  });


});

 function checkserver(){
     var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
     var base_url = $("#base_url").val();
        var datavalue = 'check=0';
        $.ajax({
                type: "POST",
                url: base_url + "/autoupdate/checkserver",
                data:{
                    check: 0,
                    app_csrf:CSRF_TOKEN
                },
                success: function(data){
                    if(data==0){
                    swal("Warming", "Your php allow_url_fopen is currently Disable.Check Your server php allow_url_fopen is enable,memory Limit More than 100M and max execution time is 300 or more", "warning");  
                    }
                    else{
                        $("#checkserver").hide();
                        $("#serverok").show();
                        }
                }
            });
     }

     function cancel_upnotification(id){
         var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
         var base_url = $("#base_url").val();
                $.ajax({
                type: "POST",
                url: base_url + "/autoupdate/cancel_notification",
                data: {id:id,app_csrf:CSRF_TOKEN},
                success: function(data){
                    if(data==0){
                    swal("Warming", "Please Try Again", "warning");  
                    }
                    else{
                       toastr["success"]('Successfully Canceled');
                 location.reload();

                        }
                }
            });
     }

    $(document).ready(function() { 
      "use strict";
  var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
   var currency = $("#currency").val();
   var base_url  = $('#base_url').val();
    var mydatatable = $('#PurList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 4, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,5,6,] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/purchase/purchase_list_check',
            "data": function ( data) {
            data.fromdate = $('#from_date').val();
            data.todate   = $('#to_date').val();
            data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'chalan_no'},
             { data: 'purchase_id'},
             { data: 'manufacturer_name'},
             { data: 'purchase_date' },
             { data: 'total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});


  
    $(document).ready(function() { 
      "use strict";
   var CSRF_TOKEN   = $('[name="csrf_test_name"]').val();
   var currency     = $("#currency").val();
   var base_url     = $('#base_url').val();
    var mydatatable = $('#InvoicList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 4, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,5,6,] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                          exportOptions: {
                       columns: [ 0,1,2,3,4,5] 
                           },
                        title: "Invoice List",
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/invoice/invoice_list_check',
              "data": function ( data) {
            data.fromdate = $('#from_date').val();
            data.todate   = $('#to_date').val();
            data.app_csrf = CSRF_TOKEN;
},    
          
            },
          'columns': [
             { data: 'sl' },
             { data: 'invoice_no'},
             { data: 'invoice_id'},
             { data: 'customer_name'},
             { data: 'date' },
             { data: 'total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
   api.columns('.total_sale', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
  });
}

    });

    $("#btn-filter-pur").on('click', function ( e ) {
  mydatatable.ajax.reload();  
  });

});

    $(document).ready(function() { 
      "use strict";
    var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    var currency    = $("#currency").val();
    var base_url    = $('#base_url').val();
    var total_no    = $('#total_manufacturer').val();
    var mydatatable = $('#ManufacturerList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9,10] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, total_no], [10, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/manufacturer/manufacturer_checkdata',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'manufacturer_name' },
             { data: 'address'},
             { data: 'mobile' },
             { data: 'email'},
             { data: 'city'},
             { data: 'state'},
             { data: 'zip'},
             { data: 'country'},
             { data: 'balance',class:"balance text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency ) },
             { data: 'button'},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
 
  api.columns('.balance', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(currency+' '+sum.toFixed(2, 2));
  });


}

    });


    $('.valid_number').keypress(function(event){

 var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode != 46 && charCode != 45 && charCode > 31
    && (charCode < 48 || charCode > 57))
     return false;

  return true;

        });  

});


 "use strict";
function add_serviceField(t) {
    var row = $("#serviceInvoice tbody tr").length;
    var count = row + 1;
       var tab1 = 0;
       var tab2 = 0;
       var tab3 = 0;
       var tab4 = 0;
       var tab5 = 0;
       var tab6 = 0;
       var tab7 = 0;
       var tab8 = 0;
       var tab9 = 0;
    var limits = 500;
    var taxnumber = $("#txfieldnum").val();
    var tbfild ='';
    for(var i=0;i<taxnumber;i++){
        var taxincrefield = '<input id="total_tax'+i+'_'+count+'" class="total_tax'+i+'_'+count+'" type="hidden"><input id="all_tax'+i+'_'+count+'" class="total_tax'+i+'" type="hidden" name="tax[]">';
         tbfild +=taxincrefield;
    }
    if (count == limits)
        alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "service_name_" + count,
                tabindex = count * 5,
                e = document.createElement("tr");
        tab1 = tabindex + 1;
        tab2 = tabindex + 2;
        tab3 = tabindex + 3;
        tab4 = tabindex + 4;
        tab5 = tabindex + 5;
        tab6 = tabindex + 6;
        tab7 = tabindex + 7;
        tab8 = tabindex + 8;
        tab9 = tabindex + 9;
        e.innerHTML = "<td><input type='text' name='service_name' onkeypress='service_productList(" + count + ");' class='form-control serviceSelection common_product' placeholder='Service Name' id='" + a + "' required tabindex='" + tab1 + "'><input type='hidden' class='common_product autocomplete_hidden_value  service_id_" + count + "' name='service_id[]' id='SchoolHiddenId'/></td><td> <input type='text' name='product_quantity[]' required='required' onkeyup='service_calculation(" + count + ");' onchange='service_calculation(" + count + ");' id='total_qntt_" + count + "' class='common_qnt total_qntt_" + count + " form-control text-right valid_number'  placeholder='0.00' min='0' tabindex='" + tab2 + "'/></td><td><input type='text' name='product_rate[]' onkeyup='service_calculation(" + count + ");' onchange='service_calculation(" + count + ");' id='price_item_" + count + "' class='common_rate price_item" + count + " form-control text-right valid_number' required placeholder='0.00' min='0' tabindex='" + tab3 + "'/></td><td><input type='text' name='discount[]' onkeyup='service_calculation(" + count + ");' onchange='service_calculation(" + count + ");' id='discount_" + count + "' class='form-control text-right common_discount valid_number' placeholder='0.00' min='0' tabindex='" + tab4 + "' /><input type='hidden' value='' name='discount_type' id='discount_type_" + count + "'></td><td class='text-right'><input class='common_total_price total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' readonly='readonly'/></td><td>"+tbfild+"<input type='hidden'  id='total_discount_" + count + "' class='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount' name='discount_amount[]'/><button tabindex='" + tab5 + "' style='text-align: right;' class='btn btn-danger-soft' type='button' value='Delete' onclick='deleteserviceRow(this)'><i class='fas fa-trash-alt'></i></button></td>",
          document.getElementById(t).appendChild(e),
          document.getElementById(a).focus(),
          document.getElementById("add_service_item").setAttribute("tabindex", tab6);
        document.getElementById("paidAmount").setAttribute("tabindex", tab7);
        document.getElementById("service_full_paid_tab").setAttribute("tabindex", tab8);
        document.getElementById("add_service").setAttribute("tabindex", tab9);
        count++
    }
}
//Quantity calculat
    "use strict";
function service_calculation(item) {
    var quantity         = $("#total_qntt_" + item).val();
    var price_item       = $("#price_item_" + item).val();
    var invoice_discount = $("#invoice_discount").val();
    var discount         = $("#discount_" + item).val();
    var taxnumber        = $("#txfieldnum").val();
    var total_discount   = $("#total_discount_" + item).val();
    var dis_type         = $("#discount_type").val();


    if (quantity > 0 || discount > 0) {
        if (dis_type == 1) {
            var price = quantity * price_item;
            // Discount cal per product
            var dis = +(price * discount / 100);
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var temp = price - dis;
            var ttletax = 0;
            $("#total_price_" + item).val(price);
             for(var i=0;i<taxnumber;i++){
           var tax = (temp) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }

          
        } else if (dis_type == 2) {
            var price = quantity * price_item;
            // Discount cal per product
            var dis = (discount * quantity);
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var temp = price - dis;
            $("#total_price_" + item).val(price);
            var ttletax = 0;
             for(var i=0;i<taxnumber;i++){
           var tax = (temp) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
        }
        } else if (dis_type == 3) {
            var total_price = quantity * price_item;
            // Discount cal per product
            $("#all_discount_" + item).val(discount);
            //Total price calculate per product
            var price = (total_price - discount);
            $("#total_price_" + item).val(total_price);
             var ttletax = 0;
             for(var i=0;i<taxnumber;i++){
             var tax = (price) * $("#total_tax"+i+"_" + item).val();
             ttletax += Number(tax);
              $("#all_tax"+i+"_" + item).val(tax);
    }
        }
    } else {
        var n = quantity * price_item;
        var c = quantity * price_item;
        $("#total_price_" + item).val(n),
                $("#all_tax_" + item).val(c)
    }
    serviceCalculationSum();
    service_paidamount();
}
//Calculate Sum

    "use strict";
function serviceCalculationSum() {

  var taxnumber = $("#txfieldnum").val();
           
          var t = 0,          
            a = 0,
            e = 0,
            o = 0,
            p = 0,
            f = 0,
            s_cost =  $("#shipping_cost").val();

  //Total Tax
for(var i=0;i<taxnumber;i++){
      
var j = 0;
    $(".total_tax"+i).each(function () {
        isNaN(this.value) || 0 == this.value.length || (j += parseFloat(this.value))
    });
            $("#total_tax_ammount"+i).val(j.toFixed(2, 2));
             
    }
 
        //Discount part
         $(".total_discount").each(function () {
        isNaN(this.value) || 0 == this.value.length || (p += parseFloat(this.value))
    }),
            $("#total_discount_ammount").val(p.toFixed(2, 2)),

    $(".totalTax").each(function () {
        isNaN(this.value) || 0 == this.value.length || (f += parseFloat(this.value))
    }),
            $("#total_tax_amount").val(f.toFixed(2, 2)),
         
            //Total Price
            $(".total_price").each(function () {
        isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
    }),
            o = f.toFixed(2, 2),
            e = t.toFixed(2, 2);
    f = p.toFixed(2, 2);

    var test = +o + +s_cost + +e + -f;
    $("#grandTotal").val(test);

    var gt                     = Number($("#grandTotal").val());
    var invdis                 = $("#invoice_discount").val();
    var total_discount_ammount = $("#total_discount_ammount").val();
    var ttl_discount           = +total_discount_ammount+ + invdis;
    var discount               =   ttl_discount;
    $("#total_discount_ammount").val(ttl_discount);
    var grnt_totals            = test - invdis;
    service_paidamount();
    $("#grandTotal").val(grnt_totals);

}

//Invoice Paid Amount
    "use strict";
function service_paidamount() {
    var  prb = parseFloat($("#previous").val(), 10);
    var pr = 0;
    if(prb > 0){
        pr =  prb;
    }else{
        pr = 0;
    }
    var t = $("#grandTotal").val(),
            a = $("#paidAmount").val(),
            e = t - a,
            f = e + pr,
            nt = parseFloat(t, 10) + pr;
    $("#n_total").val(nt.toFixed(2, 2));      
    $("#dueAmmount").val(f.toFixed(2, 2));
     
}




//Invoice full paid
    "use strict";
function service_full_paid() {
    var grandTotal = $("#n_total").val();
    $("#paidAmount").val(grandTotal);
    service_paidamount();
}

//Delete a row of table
    "use strict";
function deleteserviceRow(t) {
    var a = $("#serviceInvoice > tbody > tr").length;

    if (1 == a)
        alert("There only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e),
                serviceCalculationSum();
        service_paidamount();

        var current = 1;
        $("#serviceInvoice > tbody > tr td input.productSelection").each(function () {
            current++;
            $(this).attr('id', 'product_name' + current);
        });
        var common_qnt = 1;
        $("#serviceInvoice > tbody > tr td input.common_qnt").each(function () {
            common_qnt++;
            $(this).attr('id', 'total_qntt_' + common_qnt);
            $(this).attr('onkeyup', 'service_calculation('+common_qnt+');');
            $(this).attr('onchange', 'service_calculation('+common_qnt+');');
        });
        var common_rate = 1;
        $("#serviceInvoice > tbody > tr td input.common_rate").each(function () {
            common_rate++;
            $(this).attr('id', 'price_item_' + common_rate);
            $(this).attr('onkeyup', 'service_calculation('+common_qnt+');');
            $(this).attr('onchange', 'service_calculation('+common_qnt+');');
        });
        var common_discount = 1;
        $("#serviceInvoice > tbody > tr td input.common_discount").each(function () {
            common_discount++;
            $(this).attr('id', 'discount_' + common_discount);
            $(this).attr('onkeyup', 'service_calculation('+common_qnt+');');
            $(this).attr('onchange', 'service_calculation('+common_qnt+');');
        });
        var common_total_price = 1;
        $("#serviceInvoice > tbody > tr td input.common_total_price").each(function () {
            common_total_price++;
            $(this).attr('id', 'total_price_' + common_total_price);
        });




    }
}
var count = 2,
        limits = 500;

/*bank payment part show\hide*/
    "use strict";
    $( document ).ready(function() {
     var elements = document.getElementsByClassName('bank_div');
    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'none';
    }
    });
    "use strict";
    function bank_payment(val){
        if(val==2){
           var style = 'block';           
        }else{
     var style ='none';
   
        }
        var elements = document.getElementsByClassName('bank_div');

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display =style;
    }    
   
    }


    



function CustomerList(sl) {
    var base_url        = $('#base_url').val();
     var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
            var customer_name = $('#customer_name').val();
        $.ajax( {
          url: base_url + "/invoice/search_customer",
          method: 'POST',
          dataType: "json",
          data: {
            term: request.term,
            customer_name:customer_name,
             app_csrf:CSRF_TOKEN,
          },
          success: function( data ) {
           
            response( data );

          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find("#customer_id").val(ui.item.value); 
           
            var customer_id          = ui.item.value;
            $(this).unbind("change");
             customer_due(customer_id);
            return false;
       }
   }

   $('body').on('keypress.autocomplete', '#customer_name', function() {
       $(this).autocomplete(options);
   });


}



 "use strict";
function service_productList(sl) {

        var priceId = 'price_item_'+sl;
        var base_url = $('#base_url').val();
        var CSRF_TOKEN  = $('[name="csrf_test_name"]').val();
    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
            var service_name = $('#service_name_'+sl).val();
        $.ajax( {
          url: base_url + "/service/search_service",
          method: 'post',
          dataType: "json",
          data: {
            term: request.term,
            service_name:service_name,
             app_csrf:CSRF_TOKEN,
          },
          success: function( data ) {
            response( data );

          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
                $(this).val(ui.item.label);
                var id=ui.item.value;
                var base_url = $('#base_url').val();
                $.ajax
                   ({
                        type: "POST",
                        url: base_url+"/service/service_details_data",
                        data: {
                            service_id:id,
                            app_csrf:CSRF_TOKEN,
                           
                        },
                        cache: false,
                        success: function(data)
                        {
                          
                       
                             var obj = jQuery.parseJSON(data);
                             //alert(obj.charge);
                          for (var i = 0; i < (obj.txnmber); i++) {
                          var txam = obj.taxdta[i];
                          var txclass = 'total_tax'+i+'_'+sl;
                           $('.'+txclass).val(obj.taxdta[i]);
                            }

                            $('#'+priceId).val(obj.charge);
                           //  service_calculation(sl);
                            
                        } 
                    });

            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keypress.autocomplete', '.serviceSelection', function() {
       $(this).autocomplete(options);
   });

}

    "use strict";
    function deleteTaxRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(i);
}


    "use strict";
function TaxinsRow()
{
    
    var x=document.getElementById('POITable');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
    x.appendChild( new_row );
} 


"use strict";
function add_columnTaxsettings(sl){
var text = "";
var i;
for (i = 0; i < sl; i++) {
    var f = i+1;
  text += '<div class="form-group row"><label for="fieldname" class="col-sm-2 col-form-label">Tax Name' + f + '*</label><div class="col-sm-2"><input type="text" placeholder="Tax Name" class="form-control" required autocomplete="off" name="taxfield[]"></div><label for="default_value" class="col-sm-1 col-form-label">Default Value<i class="text-danger">(%)</i></label><div class="col-sm-2"><input type="text" class="form-control valid_number" name="default_value[]" id="default_value"  placeholder="Default Value" /></div><label for="reg_no" class="col-sm-1 col-form-label">Reg No</label><div class="col-sm-2"><input type="text" class="form-control" name="reg_no[]" id="reg_no"  placeholder="Reg No" /></div><div class="col-sm-1"><input type="checkbox" name="is_show" class="form-control" value="1"></div><label for="isshow" class="col-sm-1 col-form-label">Is Show</label></div>';
}
document.getElementById("taxfield").innerHTML = text;

    } 

  "use strict";
function checkallcreate(sl){

   $("#checkAllcreate"+sl).change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".create"+sl).each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".create"+sl).each(function(){
         $(this).prop("checked",false);
       });
     }
   });

}

 "use strict";
function checkallread(sl){

   $("#checkAllread"+sl).change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".read"+sl).each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".read"+sl).each(function(){
         $(this).prop("checked",false);
       });
     }
   });

}

 "use strict";
function checkalledit(sl){

   $("#checkAlledit"+sl).change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".edit"+sl).each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".edit"+sl).each(function(){
         $(this).prop("checked",false);
       });
     }
   });

}

 "use strict";
function checkalldelete(sl){

   $("#checkAlldelete"+sl).change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".delete"+sl).each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".delete"+sl).each(function(){
         $(this).prop("checked",false);
       });
     }
   });

}    

 function printDiv(divName) {
  

      var restorepage  = $('body').html();
    var printcontent = $('#' + divName).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
   
    }

   $(document).ready(function() { 
      "use strict";
  var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
   var base_url  = $('#base_url').val();
    var mydatatable = $('#outofDateMedicineList').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title: " Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                        title: "Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                         title: "Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                         title: "Medicine List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/dashboard/check_expired_medicine',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'product_name' },
             { data: 'batch_id' },
             { data: 'expeire_date'},
             { data: 'stock',class:"text-center text-danger text-bold" },
          ],

    });

});


 $(document).ready(function() { 
      "use strict";
  var CSRF_TOKEN = $('[name="csrf_test_name"]').val();
  var currency = $("#currency").val();
   var base_url  = $('#base_url').val();
    var mydatatable = $('#outof_stock_check').DataTable({ 
             responsive: true,
            dom: "<'row'<'col-md-6'Bl><'col-md-6'f>>rt<'bottom'ip><'clear'>",
             "aaSorting": [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[15, 25, 50,100,250,500, -1], [15, 25, 50,100,250,500, "All"]],
 
                        buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i>',
                        titleAttr: 'Copy',
                        title: " Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i>',
                        titleAttr: 'Excel',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                        title: "Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="far fa-file-alt"></i>',
                        titleAttr: 'CSV',
                         exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                         title: "Medicine List",
                        className: 'btn-light'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                       columns: [ 0, 1, 2, 3, 4] 
                           },
                         title: "Medicine List",
                        titleAttr: 'PDF',
                        className: 'btn-light'
                    }
                ],
            'serverMethod': 'post',
            'ajax': {
               'url':base_url + '/dashboard/check_stockout_medicine',
            "data": function ( data) {
         data.app_csrf = CSRF_TOKEN;
},    
            },
          'columns': [
             { data: 'sl' },
             { data: 'product_name' },
             { data: 'manufacturer_name' },
             { data: 'generic_name'},
             { data: 'stock',class:"text-center text-danger text-bold" },
          ],

    });

});   


   $(".select2").select2();
$(document).ready(function () {
    "use strict";
    $('.datepicker').daterangepicker({
         singleDatePicker: true,
         showDropdowns: true,
         // useCurrent: false,
         minYear: 1901,
         maxYear: 2050,
         locale: {
            format: 'YYYY-MM-DD',
        },
        
    });

/*jquery ui datepicker*/
    $( function() {
    $( ".uidatepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
     } );

     $('.psdate').val('');
     $('.pedate').val('');

         $('.timepicker').daterangepicker({
              timePicker : true,
              singleDatePicker:true,
              timePicker24Hour : true,
              timePickerIncrement : 1,
              timePickerSeconds : true,
             "applyButtonClasses": "btn-success",
             "cancelClass": "btn-danger",
              startDate: moment().startOf('hour'),
              startDate: moment().startOf('minute'),
              startDate: moment().startOf('second'),
            locale : {
                format : 'HH:mm:ss'
            }
        }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find(".calendar-table").hide();
    });


         $('.monthpicker').daterangepicker({
         singleDatePicker: true,
         showDropdowns: true,
         
         locale: {
            format: 'MMMM YYYY',
        },
    });
 });   