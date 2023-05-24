<?php

session_start();
include('../../db.php');

// push array data to database //

// $dataArray = array(
//     array('name' => 'Morty', 'age' => 14),
//     array('name' => 'Summer', 'age' => 17),
//     array('name' => 'Rick', 'age' => 70),
//     array('name' => 'Rangke', 'age' => 23)
//   );

// $dataRef = $database->getReference('tryarraypush');
// $dataRef->push($dataArray);
  

// get array data from database //

// // Get a reference to the data
// $dataRef = $database->getReference('tryarraypush');

// // Sort the data by their keys
// $dataRef = $dataRef->orderByKey();

// // Get the data as a snapshot
// $dataSnapshot = $dataRef->getSnapshot();

// // Initialize an array to hold the data
// $dataArray = array();

// // Loop through the snapshot and push the data into the array
// foreach ($dataSnapshot->getValue() as $key => $value) {
//   $dataArray[] = array(
//     'key' => $key,
//     'value' => $value
//   );
// }

// // Echo the data from the array
// // foreach ($dataArray as $data) {
// //   echo "Key: " . $data['key'] . "\n";
// //   echo "Value: ";
// //   print_r($data['value']);
// //   echo "\n";
// // }

// // Echo specific data from the array
// echo "First key, first data: ";
// print_r($dataArray[0]['value'][0]);
// echo "\n";
// echo "Second key, fourth data: ";
// print_r($dataArray[1]['value'][3]);
// echo "\n";

// // Echo specific data from the array with it's specific attribute
// echo "First key, first data: ";
// print_r($dataArray[0]['value'][0]['name']);
// echo "\n";
// echo "Second key, fourth data: ";
// print_r($dataArray[1]['value'][3]['name']);
// echo "\n";


// // coba ubah attribute array //
// // Sample array of objects
// $goods = [
//     ['namegoods' => 'Product 1', 'price' => 10],
//     ['namegoods' => 'Product 2', 'price' => 20],
//     ['namegoods' => 'Product 3', 'price' => 30],
//     ['namegoods' => 'Product 4', 'price' => 40],
//     ['namegoods' => 'Product 5', 'price' => 50],
//     ['namegoods' => 'Product 6', 'price' => 60],
//     ['namegoods' => 'Product 7', 'price' => 70],
//     ['namegoods' => 'Product 8', 'price' => 80],
//     ['namegoods' => 'Product 9', 'price' => 90],
//     ['namegoods' => 'Product 10', 'price' => 100],
// ];

// // Loop through the array and change the attribute 'namegoods' to 'nama_barang'
// foreach ($goods as &$item) {
//     $item['nama_barang'] = $item['namegoods'];
//     unset($item['namegoods']);
//     $item['harga_barang'] = $item['price'];
//     unset($item['price']);
// }

// // Print the updated array
// print_r($goods);


// // coba add data //
// $dataorder1 = array(
//   array(
//       'nama_barang' => 'Widget A',
//       'harga_barang' => 10,
//       'stok_dijual' => 5
//   ),
//   array(
//       'nama_barang' => 'Widget B',
//       'harga_barang' => 15,
//       'stok_dijual' => 3
//   ),
//   array(
//       'nama_barang' => 'Widget C',
//       'harga_barang' => 20,
//       'stok_dijual' => 2
//   )
// );

// $totalPrice = 0;
// foreach ($dataorder1 as $item) {
//     $tempprice = $item['harga_barang'] * $item['stok_dijual'];
//     $totalPrice += $tempprice;
// }

// echo $totalPrice;



?>

<style type="text/css">

#form-container {
	width: 400px;
	margin: 100px auto;
}

input[type="text"] {
	border: 1px solid rgba(0, 0, 0, 0.15);
	font-family: inherit;
	font-size: inherit;
	padding: 8px;
	border-radius: 0px;
	outline: none;
	display: block;
	margin: 0 0 20px 0;
	width: 100%;
	box-sizing: border-box;
}

select {
	border: 1px solid rgba(0, 0, 0, 0.15);
	font-family: inherit;
	font-size: inherit;
	padding: 8px;
	border-radius: 2px;
	display: block;
	width: 100%;
	box-sizing: border-box;
	outline: none;
	background: none;
	margin: 0 0 20px 0;
}

.input-error {
	border: 1px solid red !important;
}

#event-date {
	display: none;
}

#create-event {
	background: none;
	width: 100%;
    display: block;
    margin: 0 auto;
    border: 2px solid #2980b9;
    padding: 8px;
    background: none;
    color: #2980b9;
    cursor: pointer;
}

</style>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>

<div id="form-container">
<input type="text" id="event-start-time" placeholder="Event Start Time" autocomplete="off" />
<input type="text" id="event-end-time" placeholder="Event End Time" autocomplete="off" />
<button id="cek">check time</button>
</div>

<script>
  // Selected time should not be less than current time
  function AdjustMinTime(ct) {
    var dtob = new Date(),
        current_date = dtob.getDate(),
        current_month = dtob.getMonth() + 1,
        current_year = dtob.getFullYear();
          
    var full_date = current_year + '-' +
            ( current_month < 10 ? '0' + current_month : current_month ) + '-' + 
              ( current_date < 10 ? '0' + current_date : current_date );

    if(ct.dateFormat('Y-m-d') == full_date)
      this.setOptions({ minTime: 0 });
    else 
      this.setOptions({ minTime: false });
  }

  // DateTimePicker plugin : http://xdsoft.net/jqplugins/datetimepicker/
  $("#event-start-time, #event-end-time").datetimepicker({ format: 'Y-m-d H:i', minDate: 0, minTime: 0, step: 5, onShow: AdjustMinTime, onSelectDate: AdjustMinTime });
  $("#event-date").datetimepicker({ format: 'Y-m-d', timepicker: false, minDate: 0 });

  $("#event-type").on('change', function(e) {
    if($(this).val() == 'ALL-DAY') {
      $("#event-date").show();
      $("#event-start-time, #event-end-time").hide();
    }
    else {
      $("#event-date").hide(); 
      $("#event-start-time, #event-end-time").show();
    }
  });

  $('#cek').click(function(){
    // alert("masuk");
    var date = $("#event-start-time").val().replace(' ', 'T') + ':00';
    alert(date);

    var dateslice = date.slice(0, 10);
    var timeslice = date.slice(11);
    // alert(dateslice);
    // alert(timeslice);

    var timetemp = new Date(`1970-01-01T${timeslice}`);
    timetemp.setMinutes(timetemp.getMinutes() + 30);
    var newTimeString = timetemp.toTimeString().slice(0, 8);
    // alert(newTimeString);

    // var newtemp = = new Date(`${dateslice.toDateString()} ${newTimeString}`).toISOString();
    var dateTimeString = `${dateslice}T${newTimeString}`;
    alert(dateTimeString);

    if (typeof date === typeof dateTimeString) {
      alert("the same");
    }

  });

</script>

<script>
  // coba datetime //
// const date = new Date('2023-05-17');
// const time = '10:30:00';
// const dateTime = new Date(`${date.toDateString()} ${time}`).toISOString();
// const newdateTime = dateTime.slice(0, -5);
// // alert("NewdateTime " + newdateTime);

// const dateslice = newdateTime.slice(0, 10);
// const timeslice = newdateTime.slice(11);
// // alert(dateslice);
// // alert(timeslice);

// const timeString = '02:40:00';
// const timetemp = new Date(`1970-01-01T${timeString}`);
// timetemp.setMinutes(timetemp.getMinutes() + 30);
// const newTimeString = timetemp.toTimeString().slice(0, 8);
// // alert(newTimeString);

// // var newtemp = = new Date(`${dateslice.toDateString()} ${newTimeString}`).toISOString();
// const dateTimeString = `${dateslice}T${newTimeString}`;
// // alert(dateTimeString);

// const dateTime1 = new Date(dateTimeString);
// dateTime1.setDate(dateTime1.getDate() + 1);
// dateTime1.setMinutes(dateTime1.getMinutes() + 10);
// const newDateTimeString = dateTime1.toISOString().slice(0, 16) + '00';
// // alert(newDateTimeString);




// var date = new Date("2023-05-17T02:30:00");
// var options = { timeZone: 'America/New_York' };
// var timeString = date.toLocaleString('en-US', options);
// alert(timeString);

// var date = new Date("2023-05-17T02:30:00");
// var timeString = date.toISOString();
// alert(timeString);

</script>