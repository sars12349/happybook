<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="device-width,initial-scale=1">
	<title>Document</title>
	<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="css/listview-grid.css">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script>
		var regionTitle=new Array();
		var counter=new Array();
		var regionData=new Array();
		$(function(){
			$.ajax({
				type:'GET',
				url:'get_hotel_info.php',
				dataType:'json',
				success:show,
				error:function(){alert('Ajax request 發生錯誤');}
			});

			function show(data){
				console.log(data.length);
				for(var i=0,cnt=data.length;i<cnt;i++){
					var getRegion=data[i]["display_addr"].substring(0,data[i]["display_addr"].indexOf("區",0)+1);
					if(counter[getRegion]==undefined){
						counter[getRegion]=regionData.length;
						regionData.push(new Array());
						regionTitle[counter[getRegion]]=getRegion;
					}
					regionData[counter[getRegion]].push(data[i]);
				}//for end

				$("#list").empty();

				// listview主選單
				for(var i=0;i<regionData.length;i++){
					var hotel_name="";
					var hotel_addr="";
					var hotel_tel="";
					for(var j=0;j<regionData[i].length;j++){
						hotel_name+=regionData[i][j]["name"]+"|";
						hotel_addr+=regionData[i][j]["display_addr"]+"|";
						hotel_tel+=regionData[i][j]["tel"]+"|";
					}					
					strHtml='<li data-icon="home"><a href="#" hotel_name="'+hotel_name+'" hotel_addr="'+hotel_addr+'" hotel_tel="'+hotel_tel+'">'+regionTitle[i]+'旅館資料<span class="ui-li-count">'+regionData[i].length+'</span></a></li>';
					$("#list").append(strHtml);
				}
				$("#list").listview("refresh");				
			}
		});
	</script>
</head>
<body>
	<div data-role="page" id="home">
		<div data-role="header" data-theme="b">
			<h2>台北市旅館資訊</h2>
		</div>

		<div data="main" class="ui-content">
			<ul data-role="listview" data-inset="true" id="list">
				<li data-icon="home">
					<a href="#">旅館資料<span class="ui-li-count">10</span></a></li>
			</ul>
			
		</div>

		<div data-role="footer" data-position="fixed">
			
		</div>
	</div>	
</body>
</html>