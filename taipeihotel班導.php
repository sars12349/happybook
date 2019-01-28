<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script>
		$(function(){
			$.ajax({
				type: "GET",
				url: "http://192.168.60.150/mobileWEB/hotel_api.php",
				dataType: "json",
				success: showdata,
				error: function(){
					alert("erroe");
				}
			});
		});

		function showdata(data){
			// console.log(data.length);
			// alert(data.length);
			var regionTitle = new Array();
			var counter = new Array();
			var regionData = new Array();

			for(var i=0; i<data.length; i++){
				getRegion = data[i]["display_addr"].substring(0, data[i]["display_addr"].indexOf("區", 0)+1);

				if(counter[getRegion] == undefined){
					counter[getRegion] = regionData.length;
					regionData.push(new Array());
					regionTitle[counter[getRegion]] = getRegion;
				}
				regionData[counter[getRegion]].push(data[i]);
			}// end for
				

				$("#output").empty();


			//listview主選單
			for(var i=0; i<regionTitle.length; i++){
				var hotel_name = "";
				var hotel_addr = "";
				var hotel_tel = "";
				for(var j=0; j<regionData[i].length; j++){
					hotel_name+= regionData[i][j]["name"]+"|";
					hotel_addr+= regionData[i][j]["display_addr"]+"|";
					hotel_tel+= regionData[i][j]["tel"]+"|";
				}//end for j

				strHTML = '<li data-icon="star"><a href="#hotel" regionTitle="'+regionTitle[i]+'" hotel_name="'+hotel_name+'" hotel_addr="'+hotel_addr+'" hotel_tel="'+hotel_tel+'">'+regionTitle[i]+'旅館資料<span class="ui-li-count">'+regionData[i].length+'</span></a></li>';

				$("#output").append(strHTML);
			}//end for i

			$("a", $("#output")).bind("click", function(){
				getItem($(this).attr("regionTitle"), $(this).attr("hotel_name"), $(this).attr("hotel_addr"), $(this).attr("hotel_tel"))
			});			

			$("#output").listview("refresh");
		}//end function showdata()

		function getItem(regionTitle, hotel_name, hotel_addr, hotel_tel){
			console.log("regionTitle:"+regionTitle);
			console.log("hotel_name:"+hotel_name);
			console.log("hotel_addr:"+hotel_addr);
			console.log("hotel_tel:"+hotel_tel);
		}




	</script>
</head>
<body>
	<div data-role="page" id="home">
		<div data-role="header" data-position="fixed" id="home" data-theme="b">
			<h1>Home</h1>
		</div>
		<div role="main" class="ui-content">
			<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="請輸入要尋找代碼??" id="output">
				<li data-icon="star">
					<a href="#" hotel_name="銀寶旅店|八方美學商旅|八方美學商旅|八方美學商旅|八方美學商旅|八方美學商旅" hotel_addr="台北市大同區延平北路1段121號|台北市中正區金山南路1段8號|台北市中正區金山南路1段8號|台北市中正區金山南路1段8號|台北市中正區金山南路1段8號" hotel_tel="2555-1130|23583500|23583500|23583500|23583500">台北市萬華區旅館資料<span class="ui-li-count">30</span></a>
				</li>
			</ul>
		</div>
		<div data-role="footer" data-position="fixed" data-theme="b">
			<h1>footer</h1>
		</div>
	</div>

	<div data-role="page" id="hotel">
		<div data-role="header" data-position="fixed" id="home" data-theme="b">
			<h1>Home</h1>
		</div>
		<div role="main" class="ui-content">
			<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="請輸入要尋找代碼??" id="output_hotel">
				<li data-icon="star">
					
				</li>
			</ul>
		</div>
		<div data-role="footer" data-position="fixed" data-theme="b">
			<h1>footer</h1>
		</div>
	</div>	
</body>
</html>		