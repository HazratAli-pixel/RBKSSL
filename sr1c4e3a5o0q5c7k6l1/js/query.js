const m_body = document.getElementById('mbody');
const m_title = document.getElementById('Modal_title');
m_title.style.color= "magenta";
function reply_click(clicked_id) {
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			const result = Number(this.responseText);
			DisplayItem();

			if (result == 1) {
				m_title.innerHTML = "Massage";
				m_body.innerHTML = "<h3>Max Item Added..!!!</h3>";
				
				$('#exampleModal').modal('show');
			}
			else if (result == 3) {
				m_title.innerHTML = "Massage";
				m_body.innerHTML = "<h4>Item not available in stock.</h4>";
				$('#exampleModal').modal('show');
			}
			else if(result==2){
				m_title.innerHTML = "Massage";
				m_body.innerHTML = "<h2>Item out of stock</h2>";
				$('#exampleModal').modal('show');
			}
		}
	};
	xmlhttp.open('GET', `../query.php?ItemId=${clicked_id}`, true);
	xmlhttp.send();
	// xmlhttp.send("ItemId="+clicked_id+"@ItemIds");
}

function DisplayItem() {
	const tbody = document.getElementById('DisplayData');
	// let Gtotal = document.getElementById('Gtotal');
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText == '0') {
			} else {
				tbody.innerHTML = this.responseText;
				subTotal();
			}
		}
	};
	xmlhttp.open('GET', '../query.php?DataShow', true);
	xmlhttp.send();
}
function show_item(clicked_id) {
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				// alert(this.responseText);
				m_title.innerHTML = "Product Information";
				m_body.innerHTML = this.responseText;
				$('#exampleModal').modal('show');
		}
	};

	xmlhttp.open('GET', `../query.php?showinfo=${clicked_id}`, true);
	xmlhttp.send();
}

function remove_item(clicked_id) {
		//const r = confirm('Want to remove this?');
			//if (r == true) {
				const xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
				DisplayItem();
				}
			};
				xmlhttp.open('GET', `../query.php?RemoveItem=${clicked_id}`, true);
				xmlhttp.send();
	//}
					// xmlhttp.send("ItemId="+clicked_id+"@ItemIds");
}

function changeQty(clicked_id, itemvalue) {
				const xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					const result = Number(this.responseText);
					if(result==1){
						alert(result);
					}
					DisplayItem();
				}
				
			};
				xmlhttp.open('GET', `../query.php?UpItem=${clicked_id}&itemvalue=${itemvalue}`, true);
				xmlhttp.send();

					// xmlhttp.send("ItemId="+clicked_id+"@ItemIds");
}

const clearbtn = document.getElementById('ClearCard');
clearbtn.addEventListener('click', Clearfunction);
function Clearfunction() {
	swal({
		title: 'Are you sure?',
		text: 'Once deleted, you will not be able to recover this imaginary list!',
		icon: 'warning',
		buttons: true,
		dangerMode: true,
		})
	.then((willDelete) => {
		if (willDelete) {
			const xhr = new XMLHttpRequest();
			xhr.onload = function () {
			document.location = 'pos_invoice.php';
			};
			xhr.open('GET', '../query.php?ClearCard', true);
			xhr.send();
  		}
	});
}

function myFunction() {
	let input, filter, table, tr, td, i, txtValue;
	input = document.getElementById('myInput');
	filter = input.value.toUpperCase();
	table = document.getElementById('myTable');
	tr = table.getElementsByTagName('tr');
	for (i = 0; i < tr.length; i++) {
	  td = tr[i].getElementsByTagName('td')[1];
	  if (td) {
		txtValue = td.textContent || td.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
		  tr[i].style.display = '';
		} else {
		  tr[i].style.display = 'none';
		}
	  }
	}
  }
function Category_function(clicked_id){
	let filter, table, tr, td, i, txtValue;
	filter = clicked_id.toUpperCase();
	table = document.getElementById('myTable');
	tr = table.getElementsByTagName('tr');
	for (i = 0; i < tr.length; i++) {
	  td = tr[i].getElementsByTagName('td')[0];
	  if (td) {
		txtValue = td.textContent || td.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
		  tr[i].style.display = '';
		} else {
		  tr[i].style.display = 'none';
		}
	  }
	}
}

function OrderConfirm() {
	let customerid, totaldiscount, vat, grandtotal, due, paidamount,paidamount2, previousDue, msgstatus;
	// customerid = document.getElementById('')
	customerid = 0;
	totaldiscount = Number(document.getElementById('totaldiscount').value);
	grandtotal = Number(document.getElementById('Total').value);
	var x = document.getElementById("flexSwitchCheckDefault").checked;
	if(x==true){
		msgstatus = 1;
	}
	else{
		msgstatus = 0;
	}
	due = Number(document.getElementById('duelbl').innerHTML);
	vat = Number(document.getElementById('vat').value);
	previousDue = Number(document.getElementById('previousdue').value);
	paidamount = Number(document.getElementById('paidamount3').value);
	paidamount2 = Number(document.getElementById('paidamount2').value);
	// alert(msgstatus);
	if(due<0){
		due=0;
	} 
	if (grandtotal > 0) {
		if (paidamount>0){
			const xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
					swal({
						title: 'Success',
						text: 'Want to print this',
						icon: 'success',
						buttons: true,
						})
					.then((willDelete) => {
						if (willDelete) {
							// document.location = `invoice.php?invoiceid=${this.responseText}`;
							window.open(`invoice.php?invoiceid=${this.responseText}`, "_blank")
						  } 
						  else {
							document.location = 'pos_invoice.php';
						  }
					});
				}
			};
			xmlhttp.open('GET', `../query.php?customerid=${customerid}&totaldiscount=${totaldiscount}&grandtotal=${grandtotal}
			&due=${due}&vat=${vat}&paidamount=${paidamount}&predue=${previousDue}&msgstatus=${msgstatus}&ordersubmit`, true);
			xmlhttp.send();
		}
		else{
			swal({
				title: 'Pay minimum Amount',
				text: 'Want to save without payment?',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
				})
				.then((willDelete) => {
					paidamount = 0;
					due = paidamount2;
					if (willDelete) {
						const xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
								swal({
									title: 'Success',
									text: 'Want to print this',
									icon: 'success',
									buttons: true,
				
									})
								.then((willDelete) => {
									if (willDelete) {
										// document.location = `invoice.php?invoiceid=${this.responseText}`;
										window.open(`invoice.php?invoiceid=${this.responseText}`, "_blank")
									}
									else {
										document.location = 'pos_invoice.php';
									}
								});
							}
						};
						xmlhttp.open('GET', `../query.php?customerid=${customerid}&totaldiscount=${totaldiscount}&grandtotal=${grandtotal}
						&due=${due}&vat=${vat}&paidamount=${paidamount}&predue=${previousDue}&msgstatus=${msgstatus}&ordersubmit`, true);
						xmlhttp.send();
					  } 
				});		
		}
	}
	else {
		swal({
			title: 'No Item!',
			text: 'You have not select any Item.',
			icon: 'warning',
			dangerMode: true,
			});
	}
}

function edit_unit(clicked_id) {
	const m_body = document.getElementById('mbody3');
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				// alert(this.responseText);
				m_body.innerHTML = this.responseText;
				$('#exampleModal3').modal('show');
		}
	};

	xmlhttp.open('GET', `../query.php?edit_unit=${clicked_id}`, true);
	xmlhttp.send();
}

function DuePerson(clicked_id) {
	// alert(clicked_id);
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				// alert(this.responseText);
				$('#previousdue').val(this.responseText);
				FullPayment();
		}
	};

	xmlhttp.open('GET', `../query.php?DueAmount=${clicked_id}`, true);
	xmlhttp.send();
}

function clean_filed() {
	var input_filed_value = document.getElementById('exampleDataListf').value;
	var input_filed = document.getElementById('exampleDataListf');
	var cln_id = document.getElementById('cln_id');
	if(input_filed_value.length==0){
		input_filed.value = "Walking Customer";
		cln_id.innerHTML="clean";
		DuePerson();
	}else{
		input_filed.value = "";
		cln_id.innerHTML="undo";
	}
	
}
